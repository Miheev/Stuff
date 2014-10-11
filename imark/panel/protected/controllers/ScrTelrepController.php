<?php

class ScrTelrepController extends Controller
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
    public function actionAppend($id, $name='') {
        $model=ScrTelrep::model()->findByAttributes(array('profile_id'=>$id));
        if($model===null)
            $this->redirect(array('create', 'id'=>$id, 'name'=>$name));
        else
            $this->redirect(array('update', 'id'=>$model->id));
    }

    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate($id, $name='')
	{
		$model=new ScrTelrep;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ScrTelrep']))
		{
			$model->attributes=$_POST['ScrTelrep'];
            $model->profile_id= $id;
			if($model->save())
				$this->redirect(array('/profiles/view','id'=>$id, 'msg'=>'Скрипт успешно создан!'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['ScrTelrep']))
		{
			$model->attributes=$_POST['ScrTelrep'];
			if($model->save())
                $this->redirect(array('/profiles/view','id'=>$model->profile_id, 'msg'=>'Изменения внесены успешно!'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id='', $pid='')
	{
		if (!empty($id))
            $this->loadModel($id)->delete();
        else {
            $this->loadByProfile($pid)->delete();
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
            if (Users::isAdmin())
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            else
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/profiles/view', 'id'=>$pid));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        if (Users::isAdmin())
            $dataProvider=new CActiveDataProvider('ScrTelrep', array(
                'criteria'=>array(
                    'order'=>'id DESC',
                )));
        else
            $dataProvider=new CActiveDataProvider('ScrTelrep', array(
                'criteria'=>array(
                    'condition'=>'profile.user_id = :uid',
                    'order'=>'t.id DESC',
                    'with'=>array('profile'),
                    'params'=>array(':uid'=>Yii::app()->user->id)
                )));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ScrTelrep('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ScrTelrep']))
			$model->attributes=$_GET['ScrTelrep'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ScrTelrep the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ScrTelrep::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    public function loadByProfile($pid)
	{
		$model=ScrTelrep::model()->findByAttributes(array('profile_id'=>$pid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ScrTelrep $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='scr-telrep-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
