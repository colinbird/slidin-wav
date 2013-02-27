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

		$surfLogDataProvider=new CActiveDataProvider('SurfLog',$criteria);

		$this->render('index',array(
				'flowDataProvider'=>$flowDataProvider,
				'levelDataProvider'=>$levelDataProvider,
				'surfLogDataProvider'=>$surfLogDataProvider,
		));

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(

		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
