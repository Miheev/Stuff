<?php

/**
 * This is the model class for table "scr_telrep".
 *
 * The followings are the available columns in table 'scr_telrep':
 * @property string $id
 * @property string $params
 * @property string $profile_id
 *
 * The followings are the available model relations:
 * @property Profiles $profile
 */
class ScrTelrep extends CActiveRecord
{
    const SERVICE_GOOGLE = 0;
    const SERVICE_YANDEX = 1;
    const SERVICE_VK = 2;
    const SERVICE_FACEBOOK = 3;
    const SERVICE_GOOGLE_ADWORDS = 4;
    const SERVICE_YANDEX_DIRECT = 5;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scr_telrep';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('params', 'required'),
			array('profile_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, params, profile_id', 'safe', 'on'=>'search'),
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
			'profile' => array(self::BELONGS_TO, 'Profiles', 'profile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'params' => 'Params',
			'profile_id' => 'Profile',
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
		$criteria->compare('params',$this->params,true);
		$criteria->compare('profile_id',$this->profile_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ScrTelrep the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return array
     */
    public function getServices() {
        return array(
            self::SERVICE_GOOGLE => 'Google',
            self::SERVICE_YANDEX => 'Yandex',
            self::SERVICE_VK => 'VK',
            self::SERVICE_FACEBOOK => 'Facebook',
            self::SERVICE_GOOGLE_ADWORDS => 'Google AdWords',
            self::SERVICE_YANDEX_DIRECT => 'Yandex Direct'
        );
    }
    public function serviceSimpleScript($id, $text) {
        $script= file_get_contents(Yii::app()->BasePath . '/../js/service.js');
        //$script= str_replace(array("\n", "\r"), '', $script);
        $script= str_replace('##id##', $id, $script);
        $out= CJSON::encode($text);
        $script= str_replace('##text_rep##', $out, $script);
        return $script;
    }
    public function serviceScript($pid, $domain) {
        $model=$this->findByAttributes(array('profile_id'=>$pid));
        if($model===null)
            return '';

        $parr= json_decode($model->params);
        $stype= $model->getServices();

        $base_sets= "var _sbjs = _sbjs || [];
          _sbjs.push(['_setSessionLength', 15]);
          _sbjs.push(['_setBaseHost', '$domain']);
          _sbjs.push(['_addOrganicSource', 'vk.com', 'to']);
        ";
        $base_script= file_get_contents(Yii::app()->BasePath . '/../assets/sbplacer/js/sourcebuster.min.js');
        $tel_script= file_get_contents(Yii::app()->BasePath . '/../assets/sbplacer/js/sb-placer.js');
        $jquery= '';
        if ($parr->jquery)
            $jquery= file_get_contents(Yii::app()->BasePath . '/../js/vendor/jquery-1.8.1.min.js');
        $tel_sets= "var source = get_sbjs.current.src,
                    medium = get_sbjs.current.mdm,
                    campaign = get_sbjs.current.cmp;
        $('$parr->id').sb_placer({
          default_value: '',
          conditions: [";
        for ($i=0; $i<count($parr->service); $i++) {
            if (isset($parr->service[$i])) {
                $itserv= strtolower($stype[$i]);
                $servar= explode(' ', $itserv);
                $text= $parr->service[$i];
                if (count($servar) == 1) {
                    $tel_sets.= "{
                        check: source,
                        when: '$itserv',
                        place: '$text'
                    },";
                } else {
                    $tel_sets.= "{
                        check: [source, medium],
                        when: ['$servar[0], cpc'],
                        place: '$text'
                    },";
                }
            }
        }
        $tel_sets= rtrim($tel_sets, ',') . "] });";


//        $script= str_replace(array("\n", "\r"), '', $script);
//        $script= str_replace('##id##', $id, $script);
//        $out= CJSON::encode($text);
//        $script= str_replace('##text_rep##', $out, $script);
        return $base_sets.' ; '.$base_script . ' ; '.$jquery.' ; '.$tel_script.' ; '.$tel_sets;
    }
}
