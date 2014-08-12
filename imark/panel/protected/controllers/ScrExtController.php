<?php

class ScrExtController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('append','create','update','delete', 'index','view'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin'),
                'users'=>array('admin@admin.admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    /**append Model
     * @param id -> profile_id
     **/
    public function actionAppend($id) {
        $model=ScrTelrep::model()->findByAttributes(array('profile_id'=>$id));
        if($model===null)
            $this->redirect(array('create', 'id'=>$id));
        else
            $this->redirect(array('update', 'id'=>$model->id));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
     * @params profile_id $id
	 */
	public function actionCreate($id)
	{
		$model=new ScrExt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ScrExt']))
		{
            if (Users::isAdmin()) {
                file_put_contents(Yii::app()->BasePath . '/../js/admin.js', $_POST['ext_script']);
            }

			$model->attributes=$_POST['ScrExt'];
            $model->profile_id= $id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        if (Users::isAdmin()) {
            $admin_script= file_get_contents(Yii::app()->BasePath . '/../js/admin.js');
            $this->render('create',array(
                'model'=>$model,
                'admin_script'=>$admin_script
            ));
        } else {
            $this->render('create',array(
                'model'=>$model
            ));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ScrExt']))
		{
            if (Users::isAdmin()) {
                file_put_contents(Yii::app()->BasePath . '/../js/admin.js', $_POST['ext_script']);
            }

			$model->attributes=$_POST['ScrExt'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        if (Users::isAdmin()) {
            $admin_script= file_get_contents(Yii::app()->BasePath . '/../js/admin.js');
            $this->render('update',array(
                'model'=>$model,
                'admin_script'=>$admin_script
            ));
        } else {
            $this->render('update',array(
                'model'=>$model
            ));
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
            if (Users::isAdmin())
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            else
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        if (Users::isAdmin())
            $dataProvider=new CActiveDataProvider('ScrExt', array(
                'criteria'=>array(
                    'order'=>'id DESC',
                )));
        else {
            $dataProvider=new CActiveDataProvider('ScrExt', array(
                'criteria'=>array(
                    'condition'=>'profile.user_id = :uid',
                    'order'=>'t.id DESC',
                    'with'=>array('profile'),
                    'params'=>array(':uid'=>Yii::app()->user->id)
                )));

//        $criteria = new CDbCriteria;
//        $criteria->select = '*';
//        $criteria->condition = 'profile.user_id = :uid';
//        $criteria->with = array('profile'=>array('select'=>'id'));
//        $criteria->order = 't.  id DESC';
//        $criteria->params= array(':uid'=>Yii::app()->user->id);
//        $dataProvider = new CActiveDataProvider('ScrExt',
//            array('criteria' => $criteria,
//            ));
        }
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ScrExt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ScrExt']))
			$model->attributes=$_GET['ScrExt'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ScrExt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ScrExt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ScrExt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='scr-ext-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
