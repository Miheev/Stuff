<?php

/**
 * This is the model class for table "spares".
 *
 * The followings are the available columns in table 'spares':
 * @property string $id
 * @property string $mark
 * @property string $model
 * @property integer $count
 * @property string $cat_id
 * @property string $cat_date
 * @property string $register_id
 *
 * The followings are the available model relations:
 * @property Register $register
 */
class Spares extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spares';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model, count, cat_id', 'required'),
			array('count', 'numerical', 'integerOnly'=>true),
			array('count', 'length', 'max'=>5),
			array('model', 'length', 'max'=>100),
			array('cat_id', 'length', 'max'=>50),
			array('register_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model, count, cat_id, register_id', 'safe', 'on'=>'search'),
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
			'register' => array(self::BELONGS_TO, 'Register', 'register_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
//			'mark' => 'Марка',
			'model' => 'Марка/модель',
			'count' => 'Количество',
			'cat_id' => 'Каталожный номер',
//			'cat_date' => 'дата присвоения каталожных номеров',
			'register_id' => 'Register',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
//		$criteria->compare('mark',$this->mark,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('cat_id',$this->cat_id,true);
//		$criteria->compare('cat_date',$this->cat_date,true);
		$criteria->compare('register_id',$this->register_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Spares the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
