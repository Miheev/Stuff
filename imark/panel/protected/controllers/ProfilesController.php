<?php

class ProfilesController extends Controller
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
                'actions'=>array('scriptout', 'scriptcode'),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view', 'delete', 'padmin'),
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
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPadmin($id)
	{
		$this->render('padmin',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Profiles;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profiles']))
		{
            $outdata= &$_POST['Profiles'];
            $outdata['user_id']= Yii::app()->user->id;
//            $outdata['code']= uniqid(Yii::app()->user->id, true);
//            $outdata['code']= str_replace(array('#', '?', '&'), '_', $outdata['code']);

            $model->attributes=$outdata;
			if($model->save())
				$this->redirect(array('padmin','id'=>$model->id));
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

		if(isset($_POST['Profiles']))
		{
			$model->attributes=$_POST['Profiles'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
            $dataProvider=new CActiveDataProvider('Profiles', array(
                'criteria'=>array(
                    'order'=>'id DESC',
                )));
        else
            $dataProvider=new CActiveDataProvider('Profiles', array(
                'criteria'=>array(
                    'condition'=>'user_id=' . Yii::app()->user->id,
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
		$model=new Profiles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profiles']))
			$model->attributes=$_GET['Profiles'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profiles the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Profiles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profiles $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profiles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    /**
     * Outputs a generated script
     */
    public function actionScriptout($id)
    {
        $this->layout= '//layouts/scriptout';
        $out_scripts= array();
//        $model=Profiles::model()->findByAttributes(array('code'=>$id));
        $model=Profiles::model()->findByPk($id);
//
//        //Scripts for out
        $out_scripts[]= ScrTelrep::model()->serviceScript($model->id, $model->domain);
        $out_scripts[]= ScrExt::model()->getScript($model->id);
        $out_scripts[]= ScrExt::adminScript();


        if(!isset($out_scripts))
            throw new CHttpException(404,'The requested page does not exist.');
        else {
            $this->render('scriptout',array(
                'out_scripts'=>$out_scripts,
            ));
        }
    }
    public function actionScriptcode(){
        $this->layout= '//layouts/scriptout';
        $this->render('scriptcode');
    }
}
