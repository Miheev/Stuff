<?php

class RequestController extends Controller
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
				'actions'=>array('index','view', 'create','update'),
				'users'=>array('@'),
				'roles'=>array('requester', 'admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	public function actionCreate()
	{
		$model=new Request;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

//        $rr=0;

        if (isset($_FILES['images'])) {

            $photos = CUploadedFile::getInstancesByName('images');
            $model->request= '';
            $model->user_id= Yii::app()->user->id;


            // proceed if the images have been set
            if (isset($photos) && count($photos) > 0) {

                // go through each uploaded image
                $valid= true;
                foreach ($photos as $image => $pic) {
                    echo $pic->name.'<br />';

                    $img_name= date('H-i-s-d-m-Y') .'_'. substr(md5($pic->name), 0, 5);
                    $img_path= dirname(Yii::app()->BasePath) .'/'. Request::IMG_PATH . '/'.$img_name.'.'.$pic->extensionName;
                    $model->request.= Yii::app()->BaseUrl .'/'. Request::IMG_PATH . '/'.$img_name.'.'.$pic->extensionName."\n";
                    $model->image= $pic;
                    $valid= $model->validate();

                    if ($valid) {
                        if (!$pic->saveAs($img_path)) {
                            echo 'Cannot upload!';
                        }
                    } else
                        break;
                }
//                $rr=0;
                if ($valid)
                    if($model->save(false)) {
                        $reg=new Register;
                        $state=new RegState;

                        $reg->request_id= $model->id;
                        $reg->setNullField();
                        $state->calcState($reg);
                        if($reg->save()) {
                            $state->register_id= $reg->id;
                            if ($state->save())
                                $this->redirect(array('/site/send', 'role'=>'admin' ,'back'=>$reg->id));
                        }


                    }
            }
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

        if (isset($_FILES['images'])) {

            $photos = CUploadedFile::getInstancesByName('images');
            $model->request= '';


            // proceed if the images have been set
            if (isset($photos) && count($photos) > 0) {

                // go through each uploaded image
                $valid= true;
                foreach ($photos as $image => $pic) {
                    echo $pic->name.'<br />';

                    $img_name= date('H-i-s-d-m-Y') .'_'. substr(md5($pic->name), 0, 5);
                    $img_path= dirname(Yii::app()->BasePath) .'/'. Request::IMG_PATH . '/'.$img_name.'.'.$pic->extensionName;
                    $model->request.= Yii::app()->BaseUrl .'/'. Request::IMG_PATH . '/'.$img_name.'.'.$pic->extensionName."\n";
                    $model->image= $pic;
                    $valid= $model->validate();

                    if ($valid) {
                        if (!$pic->saveAs($img_path)) {
                            echo 'Cannot upload!';
                        }
                    } else
                        break;
                }
//                $rr=0;
                if ($valid)
                    if($model->save(false)) {
                        $this->redirect(array('view','id'=>$model->id));
                    }
            }
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $dataProvider=new CActiveDataProvider('Request', array(
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
		$model=new Request('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Request']))
			$model->attributes=$_GET['Request'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Request the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
