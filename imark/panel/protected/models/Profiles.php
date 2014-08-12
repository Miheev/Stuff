<?php

/**
 * This is the model class for table "profiles".
 *
 * The followings are the available columns in table 'profiles':
 * @property string $id
 * @property string $domain
 * @property string $code
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property ScrExt[] $scrExts
 * @property ScrTelrep[] $scrTelreps
 */
class Profiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain', 'required'),
			array('domain, code', 'length', 'max'=>100),
			array('user_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, domain, code, user_id', 'safe', 'on'=>'search'),
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
			'scrExts' => array(self::HAS_MANY, 'ScrExt', 'profile_id'),
			'scrTelreps' => array(self::HAS_MANY, 'ScrTelrep', 'profile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'domain' => 'Domain',
			'code' => 'Code',
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
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function ScriptBase($code='') {
        $sbase= file_get_contents(Yii::app()->basePath . '/data/scriptbase.html');
        $sbase= str_replace(
            '##action##',
            Yii::app()->getBaseUrl(true) . Yii::app()->createUrl('profiles/scriptout', $params = array('id'=>'')),
            $sbase);
        if (empty($code))
            $code= $this->code;
        $sbase= str_replace('##scriptid##', $code, $sbase);

        return $sbase;
    }
    public function ScriptSimpleBase($code='') {
        if (empty($code))
            $code= $this->code;
        $url= Yii::app()->getBaseUrl(true) . Yii::app()->createUrl('profiles/scriptout', $params = array('id'=>$code));
        return '<!-- Cool Manager -->
            <script async="async" src="'.$url.'"></script>
            <!-- End Cool Manager -->';
    }

    public function outScript() {
        $script= str_replace(array("\n", "\r"), '', $this->script);
        return $script;
    }
}
