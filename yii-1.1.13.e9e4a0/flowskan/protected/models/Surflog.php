<?php

/**
 * This is the model class for table "surflog".
 *
 * The followings are the available columns in table 'surflog':
 * @property integer $id
 * @property string $date
 * @property integer $runs
 * @property integer $catch
 * @property string $notes
 * @property integer $flow
 * @property integer $whiteness
 * @property double $rating
 * @property string $board
 * @property integer $right_whiteness
 * @property double $right_rating
 * @property integer $wave
 */
class Surflog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Surflog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'surflog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wave', 'required'),
			array('runs, catch, flow, whiteness, right_whiteness, wave', 'numerical', 'integerOnly'=>true),
			array('rating, right_rating', 'numerical'),
			array('notes', 'length', 'max'=>255),
			array('board', 'length', 'max'=>16),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, runs, catch, notes, flow, whiteness, rating, board, right_whiteness, right_rating, wave', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'runs' => 'Runs',
			'catch' => 'Catch',
			'notes' => 'Notes',
			'flow' => 'Flow',
			'whiteness' => 'Whiteness',
			'rating' => 'Rating',
			'board' => 'Board',
			'right_whiteness' => 'Right Whiteness',
			'right_rating' => 'Right Rating',
			'wave' => 'Wave',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('runs',$this->runs);
		$criteria->compare('catch',$this->catch);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('flow',$this->flow);
		$criteria->compare('whiteness',$this->whiteness);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('board',$this->board,true);
		$criteria->compare('right_whiteness',$this->right_whiteness);
		$criteria->compare('right_rating',$this->right_rating);
		$criteria->compare('wave',$this->wave);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUnixDate() {
		return strtotime($this->date);
	}
}
