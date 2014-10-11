<?php

class RegisterController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','update', 'trace'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','delete'),
                'users'=>array('@'),
				'roles'=>array('admin'),
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
	public function actionView($id, $msg='')
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($rid='')
    {
        $model=new Register;
        $state=new RegState;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Register']))
        {
            $model->attributes=$_POST['Register'];
            $model->setNullField();
            $state->calcState($model);
            if($model->save()) {
                $state->register_id= $model->id;
                if ($state->save())
                    $this->redirect(array('update','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'state'=>$state
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
		$state=RegState::model()->findByPk($model->regStates[0]->id);
        $spares=new Spares;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
//        $this->performAjaxValidation($spares);

		if(isset($_POST['Register']) || isset($_POST['RegState']))
		{
            $model->attributes=$_POST['Register'];
            $model->setNullField();
$yy=0;
            if (isset($_POST['RegState']['in_store']))
                $state->in_store= $_POST['RegState']['in_store'];
            if (isset($_POST['RegState']['sign_exec']))
                $state->sign_exec= $_POST['RegState']['sign_exec'];
            if (isset($_POST['RegState']['sign_general']))
                $state->sign_general= $_POST['RegState']['sign_general'];
//            if (isset($_POST['RegState']['sign_fin']))
//                $state->sign_fin= $_POST['RegState']['sign_fin'];
            $state->calcState($model);

            if($model->save()) {
                if ($state->save()) {
                    $url= $state->sendStatus($model->id);
                    $state->save(false);
                    $rr=0;
                    if (empty($url))
                        $this->redirect(array('view','id'=>$model->id));
                    else
                        header('Location: '.$url);
                }
            }
		}

        if(isset($_POST['Spares']))
        {
            $spares->attributes=$_POST['Spares'];
            $spares->register_id= $model->id;
            if($spares->save())
                $this->redirect(array('update','id'=>$model->id));
        }

        $sparesData=new CActiveDataProvider('Spares', array(
            'criteria'=>array(
                'condition'=>'register_id=:rel_id',
                'order'=>'id DESC',
                'params'=>array(':rel_id'=>$model->id)
            ),
        ));

        $this->render('update',array(
            'model'=>$model,
            'state'=>$state,
            'spares'=>$spares,
            'sparesData'=>$sparesData
        ));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $dataProvider=new CActiveDataProvider('Register', array(
            'criteria'=>array(
                'order'=>'id DESC',
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
		$model=new Register('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Register']))
			$model->attributes=$_GET['Register'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
     * Manages all models.
     */
    public function actionTrace()
    {
        if (!isset($_GET['page_count']))
            $_GET['page_count']= '';

        $model=new Register('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Register']))
            $model->attributes=$_GET['Register'];

        $this->render('trace',array(
            'model'=>$model,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Register the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Register::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Register $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
