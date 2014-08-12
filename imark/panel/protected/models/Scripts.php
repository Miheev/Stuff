<?php

/**
 * This is the model class for table "scripts".
 *
 * The followings are the available columns in table 'scripts':
 * @property string $id
 * @property string $script
 * @property string $code
 * @property string $domain
 * @property string $params
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Scripts extends CActiveRecord
{



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scripts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain, code', 'length', 'max'=>100),
            array('user_id', 'length', 'max'=>4),
            array('script, params', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, script, code, domain, params, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'script' => 'Script',
			'code' => 'Code',
            'domain' => 'Domain',
            'params' => 'Params',
            'user_id' => 'User',
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
		$criteria->compare('script',$this->script,true);
		$criteria->compare('code',$this->code,true);
        $criteria->compare('domain',$this->domain,true);
        $criteria->compare('params',$this->params,true);
        if (Yii::app()->params['admin_name'] == Yii::app()->user->name)
            $criteria->compare('user_id',$this->user_id,true);
        else
            $criteria->compare(Yii::app()->user->id,$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Scripts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
