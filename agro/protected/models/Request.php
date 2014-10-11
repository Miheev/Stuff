<?php

/**
 * This is the model class for table "request".
 *
 * The followings are the available columns in table 'request':
 * @property string $id
 * @property string $request
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Register[] $registers
 * @property Users $user
 */
class Request extends CActiveRecord
{

    const IMG_PATH= 'images/request';
    public $image;
    private $assign;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('request', 'required'),
			array('request', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>4),
            array('image', 'file', 'types'=>'jpg, jpeg, gif, png'/*,'maxSize' => 2*1048576*/),
//        array('image', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request, user_id', 'safe', 'on'=>'search'),
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
			'registers' => array(self::HAS_MANY, 'Register', 'request_id'),
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
			'request' => 'Заявка',
			'user_id' => 'User',
			'user' => 'ФИО отправителя',
            'assign' => 'Запись в реестре'
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
		$criteria->compare('request',$this->request,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('assign',$this->assign,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getNewReqs($id=-1) {
        if (!isset($id) || $id == null) $id= -1;
        $reqs= Request::model()->findAll();
        $out= array();
        foreach ($reqs as $item) {
            if(empty($item->registers))
                $out[$item->id]= $item->request;
            else if ($id != -1 && $item->id == $id)
                $out[$id]= $item->request;
        }
        $rr=0;
        return $out;
    }
    public static function getNewReqImgs($id=-1) {
        $img_list= Request::getNewReqs($id);
        foreach ($img_list as $id => $item) {
            $img_list[$id]= "<a href='$item' target='_blank'><img src='$item' style='width:100px; height: auto;' /></a>";
        }
        return $img_list;
    }

    public static function getAllReqs() {
        if (!isset($id) || $id == null) $id= -1;
        $criteria=new CDbCriteria();
        $criteria->order='id desc';
        $criteria->limit=10;
        $reqs= Request::model()->findAll($criteria);
        return $reqs;
    }
    public static function getAllReqImgs() {
        $img_list= Request::getAllReqs();
        $out= array();
        foreach ($img_list as $id => $item) {
            $tmp= explode("\n", $item->request);
            $out[$item->id]= "";
            foreach($tmp as $str)
                $out[$item->id].="<a href='$str' target='_blank'><img src='$str' style='width:100px; height: auto;' /></a>";
        }
        return $out;
    }

    public static function getReqImg($id) {
        $req= Request::model()->findByPk($id);
        $tmp= explode("\n", $req->request);
        $out='';
        foreach($tmp as $item)
            $out.="<a href='$item' target='_blank'><img src='$item' style='width:100px; height: auto;' /></a>";
        return $out;
    }
    public function getImg() {
        $tmp= explode("\n", $this->request);
        $out='';
        foreach($tmp as $item)
            $out.="<a href='$item' target='_blank'><img src='$item' style='width:100px; height: auto;' /></a>";
        return $out;
    }

    public function getAssign() {
        return empty($this->registers);
    }
    public function getAssignText() {
        return empty($this->registers) ? 'Не создана' : 'Создана';
    }

}
