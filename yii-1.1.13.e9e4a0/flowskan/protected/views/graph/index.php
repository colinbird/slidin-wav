<?php
/* @var $this GraphController */

$this->breadcrumbs=array(
	"Graph",
);
?>
<?
$flow_arr = $flowDataProvider->getData();
$flow_data = array();
foreach ($flow_arr as $flow) {
	$flow_data[] = array($flow->getUnixDate()*1000, $flow->value);
}
$level_arr = $levelDataProvider->getData();
$level_data = array();
foreach ($level_arr as $level) {
	$level_data[] = array($level->getUnixDate()*1000, $level->value);
}
$surflog_arr = $surfLogDataProvider->getData();
$surflog_data = array();
$js_notes = "[";
foreach ($surflog_arr as $surflog) {
	$surflog_data[] = array($surflog->getUnixDate()*1000, $surflog->flow);
	$mainwave_data[] = array($surflog->getUnixDate()*1000, ($surflog->rating/3)-1);
	$rightsides_data[] = array($surflog->getUnixDate()*1000, ($surflog->right_rating/3)-1);

	$notes = "Flow:".$surflog->flow." <BR>Main:" . $surflog->rating ."/10 (".$surflog->whiteness."% whiteness)" . "<BR>RS: " . $surflog->right_rating . "/10 (" . $surflog->right_whiteness ."% whiteness)" . "<BR><BR>" . $surflog->notes;
    $js_notes .= "[\"" . ($surflog->getUnixDate()*1000) . "\",\"".$notes."\"],";

}
$js_notes = rtrim($js_notes,",");
$js_notes .= "]";

$this->widget("application.extensions.EFlot.EFlotGraphWidget", 
    array(
	"id"=>"graphclick",
        "data"=>array(
				array(
						"label"=> "Flow", 
						"data"=>$flow_data,
						"yaxis"=>1,
						"lines"=>array("show"=>true),
				),
				array(
						"label"=> "Level", 
						"yaxis"=>2,
						"data"=>$level_data,
						"lines"=>array("show"=>true),
				),
				array (
						"label"=>"Main Wave Rating",
						"yaxis"=>2,
						"data"=>$mainwave_data,
				),
				array (
						"label"=>"Right Sides Rating",
						"yaxis"=>2,
						"data"=>$rightsides_data,
				),
				array(
					"label"=> "Observations",
					"yaxis"=>1,
					"data"=>$surflog_data,
					"lines"=>array("show"=>false),
					"points"=>array("show"=>true),
				),
			),
			"options"=>array(
            "legend" => array("noColumns" => 6, "position" => "nw" ),
            "xaxis" => array("mode"=>"time", "timeformat" => "%y/%m/%d"),
			"grid"=>array("hoverable"=>"true","clickable"=>"true"),
			"zoom"=>array("interactive"=>"false","trigger"=>"dblclick","amount"=>"1.5"),
        ),
        "htmlOptions"=>array(
            "style"=>"width:800px;height:400px;",
        ),
    )
);
?>
<script lang="javascript">

 function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }


$(document).ready(function() {
var notes = <?=$js_notes?>;
var graphclick = $("#graphclick");
graphclick.bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickmessage").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
        }
    });

	var previousPoint = null;
    graphclick.bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

		if (item) {
	        if (item.series.label = "Observations") {
				x = item.datapoint[0].toFixed(2),
				$("#tooltip").remove();
				var d= new Date(parseFloat(x)); if (d != null) { d = d.toString()} 
				var noteStr = "";
				for ( var i=0, len=notes.length; i<len; ++i ){
					if (item.datapoint[0] == notes[i][0]) {
						noteStr = notes[i][1];
						break;
					}
				}
				if (noteStr != "") {
					showTooltip(item.pageX, item.pageY, "Date:" + d + " Notes:" + noteStr) ;
				}
            }
        }
	});
});


</script>
<div id="clickmessage">
</div>
X:<div id="x"></div>
Y:<div id="y"></div>
