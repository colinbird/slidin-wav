<?php

class GraphController extends Controller
{
	public function actionIndex()
	{

		$criteria = array("criteria"=>array("limit"=>10000),'pagination'=>false);

		$flowDataProvider=new CActiveDataProvider('Flow',$criteria);
		$flowDataProvider->criteria->condition = "value>0";

		$levelDataProvider=new CActiveDataProvider('PortLevel',$criteria);
		$levelDataProvider->criteria->select = "id,date,DATE(date) as day_date,avg(value) as value";
		$levelDataProvider->criteria->group = "day_date";

		$surfLogDataProvider=new CActiveDataProvider('Surflog',$criteria);

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

		$this->render('index',array(
					'flow_data' => $flow_data,
					'level_data' => $level_data,
					'surflog_data' => $surflog_data,
					'mainwave_data' => $mainwave_data,
					'rightsides_data' => $rightsides_data,
					'js_notes' => $js_notes,
					));

	}

}
