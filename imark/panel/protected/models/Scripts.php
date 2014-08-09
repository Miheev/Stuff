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

    const SERVICE_GOOGLE = 0;
    const SERVICE_YANDEX = 1;
    const SERVICE_VK = 2;
    const SERVICE_FACEBOOK = 3;

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

    /**
     * @return array
     */
    public function getServices() {
        return array(
            self::SERVICE_GOOGLE => 'Google',
            self::SERVICE_YANDEX => 'Yandex',
            self::SERVICE_VK => 'VK',
            self::SERVICE_FACEBOOK => 'Facebook'
        );
    }


    public function ScriptBase($code='') {
        $sbase= file_get_contents(Yii::app()->basePath . '/data/scriptbase.html');
        $sbase= str_replace(
            '##action##',
            Yii::app()->getBaseUrl(true) . Yii::app()->createUrl('scripts/scriptout', $params = array('id'=>'')),
            $sbase);
        if (empty($code))
            $code= $this->code;
        $sbase= str_replace('##scriptid##', $code, $sbase);

        return $sbase;
    }
    public function ScriptSimpleBase($code='') {
        if (empty($code))
            $code= $this->code;
        $url= Yii::app()->getBaseUrl(true) . Yii::app()->createUrl('scripts/scriptout', $params = array('id'=>$code));
        return '<!-- Cool Manager -->
            <script async="async" src="'.$url.'"></script>
            <!-- End Cool Manager -->';
    }
    public function serviceSimpleScript($id, $text) {
        $script= file_get_contents(Yii::app()->BasePath . '/../js/service.js');
        //$script= str_replace(array("\n", "\r"), '', $script);
        $script= str_replace('##id##', $id, $script);
        $out= CJSON::encode($text);
        $script= str_replace('##text_rep##', $out, $script);
        return $script;
    }
    public function serviceScript() {
        $parr= json_decode($this->params);
        $stype= $this->getServices();

        $base_sets= "var _sbjs = _sbjs || [];
          _sbjs.push(['_setSessionLength', 15]);
          _sbjs.push(['_setBaseHost', '$parr->host']);
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
                $text= $parr->service[$i];
                $tel_sets.= "{
                    check: source,
                    when: '$itserv',
                    place: '$text'
                },";
            }
        }
        $tel_sets= rtrim($tel_sets, ',') . "] });";


//        $script= str_replace(array("\n", "\r"), '', $script);
//        $script= str_replace('##id##', $id, $script);
//        $out= CJSON::encode($text);
//        $script= str_replace('##text_rep##', $out, $script);
        return $base_sets.' ; '.$base_script . ' ; '.$jquery.' ; '.$tel_script.' ; '.$tel_sets;
    }
    public function outScript() {
        $script= str_replace(array("\n", "\r"), '', $this->script);
        return $script;
    }
    public function adminScript() {
        $script= file_get_contents(Yii::app()->BasePath . '/../js/admin.js');
        return $script;
    }
}
