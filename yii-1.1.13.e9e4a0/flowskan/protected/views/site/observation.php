<?php
/* @var $this SurflogController */
/* @var $model Surflog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'surflog-observation-form',
	'enableAjaxValidation'=>false,
)); 

$numeric_options = array();
for ($i=0;$i<30;$i++) {
	$numeric_options[$i] = $i;
}

$wave_options = array();
$wave_options[1] = "Main Wave";
$wave_options[2] = "Right Sides";

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'wave'); ?>
		<?php echo $form->dropDownList($model,'wave',$wave_options); ?>
		<?php echo $form->error($model,'wave'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'runs'); ?>
		<?php echo $form->dropDownList($model,'runs',$numeric_options); ?>
		<?php echo $form->error($model,'runs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catch'); ?>
		<?php echo $form->dropDownList($model,'catch',$numeric_options); ?>
		<?php echo $form->error($model,'catch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flow'); ?>
		<?php echo $form->textField($model,'flow'); ?>
		<?php echo $form->error($model,'flow'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'whiteness'); ?>
		<?php echo $form->textField($model,'whiteness'); ?>
		<?php echo $form->error($model,'whiteness'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'right_whiteness'); ?>
		<?php echo $form->textField($model,'right_whiteness'); ?>
		<?php echo $form->error($model,'right_whiteness'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->dropDownList($model,'rating',array_slice($numeric_options,0,11)); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'right_rating'); ?>
		<?php echo $form->dropDownList($model,'right_rating',array_slice($numeric_options,0,11)); ?>
		<?php echo $form->error($model,'right_rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array("cols"=>70,"rows"=>"5")); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'board'); ?>
		<?php echo $form->textField($model,'board'); ?>
		<?php echo $form->error($model,'board'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dateField($model,'date',array('value'=>date("Y-m-d"))); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
