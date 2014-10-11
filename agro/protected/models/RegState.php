<?php

/**
 * This is the model class for table "reg_state".
 *
 * The followings are the available columns in table 'reg_state':
 * @property string $id
 * @property string $admin
 * @property string $accountant
 * @property integer $in_store
 * @property string $supplier
 * @property string $financier
 * @property integer $sign_fin
 * @property string $signer
 * @property integer $sign_exec
 * @property integer $sign_general
 * @property string $register_id
 *
 * The followings are the available model relations:
 * @property Register $register
 */
class RegState extends CActiveRecord
{
    const STATE_INIT= 0;
    const STATE_EDIT= 1;
    const STATE_DONE= 100;

    /**Admin**/
    const STATE_SPARES= 2;
    /**Accountant**/
    const STATE_INSTORE= 3;
    const STATE_DATEIN_FACT= 4;
    /**Supplier**/
    const STATE_ACCOUNT= 5;
    /**Financier**/
    const STATE_PAYDATE= 6;
    /**Signer**/
    const STATE_SIGN_TECH= 10;
    const STATE_SIGN_GEN= 20;
    const STATE_AFTER_SIGN= 30;
    /**Mail Send Const**/
    const STATE_SEND= 1000;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reg_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('in_store, sign_exec, sign_general', 'numerical', 'integerOnly'=>true),
			array('admin, accountant, supplier, financier, signer', 'length', 'max'=>10),
			array('register_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, admin, accountant, in_store, supplier, financier, signer, sign_exec, sign_general, register_id', 'safe', 'on'=>'search'),
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
			'admin' => 'Admin',
			'accountant' => 'Accountant',
			'in_store' => 'Наличие на складе',
			'supplier' => 'Supplier',
			'financier' => 'Financier',
//			'sign_fin' => 'Подпись бухгалтера',
			'sign_exec' => 'Подпись тех. директора',
			'sign_general' => 'Подпись генерального директора',
			'register_id' => 'Register',
            'signer' => 'Signer',
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
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('accountant',$this->accountant,true);
		$criteria->compare('in_store',$this->in_store);
		$criteria->compare('supplier',$this->supplier,true);
		$criteria->compare('financier',$this->financier,true);
//		$criteria->compare('sign_fin',$this->sign_fin,true);
		$criteria->compare('sign_exec',$this->sign_exec,true);
        $criteria->compare('signer',$this->signer,true);
		$criteria->compare('sign_general',$this->sign_general,true);
		$criteria->compare('register_id',$this->register_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function calcState($model) {
        if (Yii::app()->user->checkAccess('admin')) {
            $send= $this->issend($this->admin);
            if ($send)
                $delta= self::STATE_SEND * $send;
            else
                $delta= 0;
            $this->admin= self::STATE_INIT + $delta;
$rr=0;
            $sp= empty($model->spares);
            $fl= $model->hasEmptyField();
            if ($sp)
                $this->admin= self::STATE_EDIT + $delta;
            else {
                if ($fl)
                    $this->admin= self::STATE_SPARES + $delta;
                else
                    $this->admin= self::STATE_DONE + $delta;
            }
        }
        if (Yii::app()->user->checkAccess('supplier')) {
            $send= $this->issend($this->supplier);
            if ($send)
                $delta= self::STATE_SEND * $send;
            else
                $delta= 0;
            $this->supplier= self::STATE_INIT + $delta;

            $sp= empty($model->account_id) || !(boolean)intval($model->account_date) || !(boolean)intval($model->account_sum);
            $fl= $model->hasEmptyField();
            if ($sp)
                $this->supplier= self::STATE_EDIT + $delta;
            else {
                if ($fl)
                    $this->supplier= self::STATE_ACCOUNT + $delta;
                else
                    $this->supplier= self::STATE_DONE + $delta;
            }
        }
        if (Yii::app()->user->checkAccess('accountant')) {
            $send= $this->issend($this->accountant);
            if ($send)
                $delta= self::STATE_SEND * $send;
            else
                $delta= 0;
            $this->accountant= self::STATE_INIT + $delta;

            $sp= is_null($this->in_store);
            $date_in= !(boolean)intval($model->date_in_real);
            $fl= $model->hasEmptyField();
            if ($sp)
                $this->accountant= self::STATE_EDIT + $delta;
            else {
                if ($fl) {
                    if ($date_in)
                        $this->accountant= self::STATE_INSTORE + $delta;
                    else
                        $this->accountant= self::STATE_DATEIN_FACT + $delta;
                }
                else
                    $this->accountant= self::STATE_DONE + $delta;
            }
        }
        if (Yii::app()->user->checkAccess('financier')) {
            $send= $this->issend($this->financier);
            if ($send)
                $delta= self::STATE_SEND * $send;
            else
                $delta= 0;
            $this->financier= self::STATE_INIT + $delta;


            $sp= !(boolean)intval($model->pay_date);
            $fl= $model->hasEmptyField();
            if ($sp)
                $this->financier= self::STATE_EDIT + $delta;
            else {
                if ($fl)
                    $this->financier= self::STATE_PAYDATE + $delta;
                else
                    $this->financier= self::STATE_DONE + $delta;
            }
        }
        if (Yii::app()->user->checkAccess('signer')) {
            $send= $this->issend($this->signer);
            if ($send)
                $delta= self::STATE_SEND * $send;
            else
                $delta= 0;
            $this->signer= self::STATE_INIT + $delta;

            if ( $this->sign_exec) {
                $this->signer+= self::STATE_SIGN_TECH;
            }
            if ( $this->sign_general) {
                $this->signer+= self::STATE_SIGN_GEN;
            }
        }
    }
    public function sendStatus($back) {
        $red_url= '';
        if (Yii::app()->user->checkAccess('admin')) {
            if ($this->admin > self::STATE_EDIT && $this->admin < self::STATE_SEND) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'accountant' ,'back'=>$back));
                $this->admin+= self::STATE_SEND;
            }
        }
        if (Yii::app()->user->checkAccess('supplier')) {
            if ($this->supplier > self::STATE_EDIT && $this->supplier < self::STATE_SEND) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'financier' ,'back'=>$back));
                $this->supplier+= self::STATE_SEND;
            }
        }
        if (Yii::app()->user->checkAccess('accountant')) {
            $uu=0;
            if ($this->accountant > self::STATE_EDIT && $this->accountant < self::STATE_SEND) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'techdir' ,'back'=>$back));
                $this->accountant+= self::STATE_SEND;
            } else
            if ($this->accountant > (self::STATE_SEND + self::STATE_INSTORE) && $this->accountant < 2 * self::STATE_SEND) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'requester' ,'back'=>$back));
                $this->accountant+= self::STATE_SEND;
            }
        }
        if (Yii::app()->user->checkAccess('financier')) {
            if ($this->financier > self::STATE_EDIT && $this->financier < self::STATE_SEND) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'supplier' ,'back'=>$back));
                $this->financier+= self::STATE_SEND;
            }
        }
        if (Yii::app()->user->checkAccess('signer')) {
            $rr=0;
            if ( $this->signer == self::STATE_SIGN_TECH ) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'gendir' ,'back'=>$back));
            }
            else if ( $this->signer == self::STATE_SIGN_GEN) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'techdir' ,'back'=>$back));
            }
            else if ($this->signer == self::STATE_AFTER_SIGN) {
                $red_url= Yii::app()->createUrl('/site/send', array('role'=>'signer' ,'back'=>$back));
                $this->signer+= self::STATE_SEND;
            }
        }
        $ii=0;

        return $red_url;
    }
    public static function issend($role) {
        return ($role > self::STATE_SEND)? ($role - $role % self::STATE_SEND) / self::STATE_SEND : false;
    }
}
