<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $login
 * @property string $pass
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $company
 * @property string $tariff_id
 * @property string $head_id
 *
 * The followings are the available model relations:
 * @property Tree[] $trees
 * @property TreeBookmark[] $treeBookmarks
 * @property Users $head
 * @property Users[] $users
 * @property TariffInfo $tariff
 */
class Users extends CActiveRecord
{

    public $pass_repeat;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, pass, name', 'required'),
			array('login', 'length', 'max'=>15),
			array('pass, name, email, phone, company', 'length', 'max'=>100),
			array('tariff_id, head_id', 'length', 'max'=>4),
            array('pass', 'compare'),
            array('pass_repeat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, pass, name, email, phone, company, tariff_id, head_id', 'safe', 'on'=>'search'),
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
			'trees' => array(self::HAS_MANY, 'Tree', 'creator_id'),
			'treeBookmarks' => array(self::HAS_MANY, 'TreeBookmark', 'user_id'),
			'head' => array(self::BELONGS_TO, 'Users', 'head_id'),
			'users' => array(self::HAS_MANY, 'Users', 'head_id'),
			'tariff' => array(self::BELONGS_TO, 'TariffInfo', 'tariff_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'pass' => 'Pass',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'company' => 'Company',
			'tariff_id' => 'Tariff',
			'head_id' => 'Head',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('tariff_id',$this->tariff_id,true);
		$criteria->compare('head_id',$this->head_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * perform one-way encryption on the password before we store it in the database
     */
//    protected function afterValidate()
//    {
//        parent::afterValidate();
//        $this->password = $this->encrypt($this->pass);
//    }

    public function encrypt($value)
    {
        return hash('sha256', $value . Yii::app()->params['AUTH_KEY']);

    }

    public function getPass() {
        return $this->encrypt($this->pass);
    }
}
