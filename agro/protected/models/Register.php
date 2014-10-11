<?php

/**
 * This is the model class for table "register".
 *
 * The followings are the available columns in table 'register':
 * @property string $id
 * @property string $sp
 * @property string $fio_req
 * @property string $reg_id
 * @property string $reg_date
 * @property string $comment
 * @property string $mark
 * @property string $model
 * @property string $inv_id
 * @property string $fio_exec
 * @property string $pact_id
 * @property string $pact_date
 * @property string $city
 * @property string $agent_name
 * @property string $account_id
 * @property string $account_date
 * @property string $account_sum
 * @property string $date_out_real
 * @property string $date_out_plan
 * @property string $date_in_plan
 * @property string $date_in_real
 * @property string $date_in_real_sp
 * @property string $pay_date
 * @property string $trust_id
 * @property string $request_id
 *
 * The followings are the available model relations:
 * @property RegState[] $regStates
 * @property Request $request
 * @property Spares[] $spares
 */
class Register extends CActiveRecord
{
    public $sp_model;
//    public $sp_mark;
    public $sp_count;
    public $cat_id;
//    public $cat_date;

    public $in_store;
//    public $sign_fin;
    public $sign_exec;
    public $sign_general;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'register';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('request_id', 'required'),
            array('inv_id, request_id', 'length', 'max'=>6),
            array('request_id', 'length', 'max'=>4),
            array('sp, account_sum', 'length', 'max'=>10),
            array('fio_req, model, fio_exec, city, agent_name', 'length', 'max'=>100),
            array('pact_id, account_id, trust_id', 'length', 'max'=>50),
            array('reg_date, comment, pact_date, account_date, date_out_real, date_out_plan, date_in_plan, date_in_real, date_in_real_sp, pay_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sp, fio_req, reg_date, comment, model, inv_id, fio_exec, pact_id, pact_date, city, agent_name, account_id, account_date, account_sum, date_out_real, date_out_plan, date_in_plan, date_in_real, date_in_real_sp, pay_date, trust_id, request_id', 'safe', 'on'=>'search'),
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
			'regStates' => array(self::HAS_MANY, 'RegState', 'register_id'),
			'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
			'spares' => array(self::HAS_MANY, 'Spares', 'register_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№ ПП заявки',
			'sp' => 'CП заявитель',
			'fio_req' => 'ФИО заявителя',  //*!!!**/
//			'reg_id' => 'Регистрационный номер заявки',
			'reg_date' => 'Дата регистрации заявки',
            'comment' => 'Примечание',
//			'mark' => 'Марка',
			'model' => 'Марка/Модель',
			'inv_id' => 'инвентарный номер',
			'fio_exec' => 'ФИО исполнителя',
			'pact_id' => 'Договор номер',
			'pact_date' => 'Договор дата',
			'city' => 'Город поставщика',
			'agent_name' => 'Наименование контрагента',
			'account_id' => 'Счет номер',
			'account_date' => 'Счет дата',
			'account_sum' => 'Счет сумма',
			'date_out_real' => 'Дата отгрузки факт',
			'date_out_plan' => 'Дата отгрузки план',
			'date_in_plan' => 'Дата поступления на ЦС план',
			'date_in_real' => 'Лата поступления на ЦС факт',
			'date_in_real_sp' => 'Дата поступления в СП факт',
			'pay_date' => 'Дата оплаты счета',
			'trust_id' => 'Номер доверенности',
			'request_id' => 'Регистрационный номер заявки',

//            'sp_mark' => 'Марка Запчасти',
            'sp_model' => 'Марка/модель',
            'sp_count' => 'Количество',
            'cat_id' => 'Каталожный номер',
//            'cat_date' => 'дата присвоения каталожных номеров',

            'in_store' => 'Наличие на складе',
//            'sign_fin' => 'Подпись бухгалтера',
            'sign_exec' => 'Подпись тех. директора',
            'sign_general' => 'Подпись генерального директора',
		);
	}
    public function cutNames() {
        return array(
            'request_id' => 'Заявка',
            'pact_id' => 'номер',
            'pact_date' => 'дата',
            'account_id' => 'номер',
            'account_date' => 'дата',
            'account_sum' => 'сумма',
            'date_out_real' => 'факт',
            'date_out_plan' => 'план',
            'date_in_plan' => 'план',
            'date_in_real' => 'факт',
        );
    }
    public function cutHeads() {
        return array(
            'object' => 'Объект использования',
            'pact' => 'Договор',
            'account' => 'Счёт',
            'date_out' => 'Дата отгрузки',
            'date_in' => 'Дата поступления на ЦС',
        );
    }
    public function getCutName($attr) {
        $tmp= $this->cutNames();
        return $tmp[$attr];
    }
    public function getCutHead($attr) {
        $tmp= $this->cutHeads();
        return $tmp[$attr];
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
	public function search($page_count='')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select='reg.*, sp.model as sp_model, sp.count as sp_count, sp.cat_id, st.in_store, st.sign_exec, st.sign_general';
//        $criteria->select='reg.*';
        $criteria->alias='reg';
        $criteria->join='LEFT JOIN spares sp ON sp.register_id=reg.id';
        $criteria->join.=' LEFT JOIN reg_state st ON st.register_id=reg.id';
//        $criteria->order= 'id desc';
//        $criteria->with= 'spares';

		$criteria->compare('reg.id',$this->id,true);
		$criteria->compare('reg.sp',$this->sp,true);
        $criteria->compare('reg.fio_req',$this->fio_req,true);
//		$criteria->compare('reg.reg_id',$this->reg_id,true);
		$criteria->compare('reg.reg_date',$this->reg_date,true);
        $criteria->compare('reg.comment',$this->comment,true);
//		$criteria->compare('reg.mark',$this->mark,true);
		$criteria->compare('reg.model',$this->model,true);
		$criteria->compare('reg.inv_id',$this->inv_id,true);
		$criteria->compare('reg.fio_exec',$this->fio_exec,true);
		$criteria->compare('reg.pact_id',$this->pact_id,true);
		$criteria->compare('reg.pact_date',$this->pact_date,true);
		$criteria->compare('reg.city',$this->city,true);
		$criteria->compare('reg.agent_name',$this->agent_name,true);
		$criteria->compare('reg.account_id',$this->account_id,true);
		$criteria->compare('reg.account_date',$this->account_date,true);
		$criteria->compare('reg.account_sum',$this->account_sum,true);
		$criteria->compare('reg.date_out_real',$this->date_out_real,true);
		$criteria->compare('reg.date_out_plan',$this->date_out_plan,true);
		$criteria->compare('reg.date_in_plan',$this->date_in_plan,true);
		$criteria->compare('reg.date_in_real',$this->date_in_real,true);
		$criteria->compare('reg.date_in_real_sp',$this->date_in_real_sp,true);
		$criteria->compare('reg.pay_date',$this->pay_date,true);
		$criteria->compare('reg.trust_id',$this->trust_id,true);
//		$criteria->compare('request_id',$this->request_id,true);

//        $criteria->compare('sp.mark',$this->sp_mark,true);
        $criteria->compare('sp.model',$this->sp_model,true);
        $criteria->compare('sp.count',$this->sp_count,true);
        $criteria->compare('sp.cat_id',$this->cat_id,true);
//        $criteria->compare('sp.cat_date',$this->cat_date,true);
//
        $criteria->compare('st.in_store',$this->in_store,true);
//        $criteria->compare('st.sign_fin',$this->sign_fin,true);
        $criteria->compare('st.sign_exec',$this->sign_exec,true);
        $criteria->compare('st.sign_general',$this->sign_general,true);

		$pagesize= empty($page_count) ? 150 : $page_count;

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id desc',
            ),
            'pagination'=>array(
                'pageSize'=>$pagesize,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Register the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function setNullField() {
        foreach ($this->attributes as $item) {
            if (empty($item)) $item= null;
        }
    }
    public function hasEmptyField() {
        foreach ($this->attributes as $item) {
            if (empty($item)) return true;
        }
    }
    public static function boolOut($boolvar) {
        if (isset($boolvar))
            return (($boolvar) ? '+' : '-' );
        return $boolvar;
    }
    public static function storeOut($boolvar) {
        if (isset($boolvar))
            return (($boolvar) ? $boolvar : '-' );
        return $boolvar;
    }
}
