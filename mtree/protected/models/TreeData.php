<?php

/**
 * This is the model class for table "tree_data".
 *
 * The followings are the available columns in table 'tree_data':
 * @property string $id
 * @property string $question
 * @property string $answers
 * @property string $creator_id
 *
 * The followings are the available model relations:
 * @property TreeBookmark[] $treeBookmarks
 * @property Users $creator
 */
class TreeData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tree_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, answers', 'required'),
			array('creator_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, answers, creator_id', 'safe', 'on'=>'search'),
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
			'treeBookmarks' => array(self::HAS_MANY, 'TreeBookmark', 'question_id'),
			'creator' => array(self::BELONGS_TO, 'Users', 'creator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'answers' => 'Answers',
			'creator_id' => 'Creator',
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
		$criteria->compare('question',$this->question,true);
		$criteria->compare('answers',$this->answers,true);
		$criteria->compare('creator_id',$this->creator_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TreeData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getQOptions($questions)
    {
        $qarr = CHtml::listData($questions, 'id', 'question');
        return $qarr;
    }
    public static function getAllAttr($models)
    {
        $tmp= array();
        foreach($models as $model) {
            $tmp[$model->id]= $model->attributes;
            //$tmp[]= $model;
        }
        return $tmp;
    }
    public function getAnswers() {
        $tmp= str_replace(array("\n", "\r"), '###', $this->answers);
        $tmp= str_replace('######', '###', $tmp);
        $tmp= explode('###', $tmp);
        return $tmp;
    }
}
