<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $login
 * @property string $pass
 * @property string $name
 * @property string $role
 *
 * The followings are the available model relations:
 * @property Chat[] $chats
 * @property Profile[] $profiles
 * @property Sharelist[] $sharelists
 * @property Userlist[] $userlists
 * @property Shareurl[] $shareurls
 * @property Userurl[] $userurls
 */
class Users extends CActiveRecord
{
    const ROLE_USER = 'user';
    const ROLE_ADMINISTRATOR = 'admin';

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
            array('login', 'email'),
            array('login', 'unique', 'className' => 'Users',
                'attributeName' => 'login',
                'message'=>'This Email is already in use'),
            array('login, pass, name, role', 'length', 'max'=>100),
            array('pass', 'compare'),
            array('pass_repeat', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, login, pass, name, role', 'safe', 'on'=>'search'),
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
            'chats' => array(self::HAS_MANY, 'Chat', 'user_id'),
            'profiles' => array(self::HAS_MANY, 'Profile', 'user_id'),
            'sharelists' => array(self::HAS_MANY, 'Sharelist', 'user_id'),
            'shareurls' => array(self::HAS_MANY, 'Shareurl', 'user_id'),
            'userlists' => array(self::HAS_MANY, 'Userlist', 'user_id'),
            'userurls' => array(self::HAS_MANY, 'Userurl', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Email',
            'pass' => 'Pass',
            'name' => 'Name',
            'role' => 'Role',
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
        $criteria->compare('role',$this->role,true);

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

    public static function getRoles() {
        return array (
            self::ROLE_USER => 'Пользователь',
            self::ROLE_ADMINISTRATOR => 'Администратор',
        );
    }
}
