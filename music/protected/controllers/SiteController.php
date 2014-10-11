<?php

class SiteController extends Controller
{

    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules()
    {
        return array(
            array('deny',  // deny all users
                'actions'=>array('contact'),
                'users'=>array('?'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionFindmusic()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
            $this->render('findmusic');
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    /**
     * Displays the contact page
     */
    public function actionSend($role, $back)
    {
        $subject= '';
        $body= '';

        switch($role) {
            case 'admin':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
            case 'supplier':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
            case 'accountant':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
            case 'financier':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
            case 'techdir':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
            case 'gendir':
                $subject= 'Новая запись в реестре';
                $body= 'Новая запись в реестре доступна для редактирования';
                break;
        }
        $link= $this->createUrl('/register/update',array('id'=>$back));
        $link= CHtml::link('Перейти к объекту', $link);
        $body.="\n\r\n\r".$link;

//        $users= Users::model()->findAllByAttributes(array('role'=>$role));
        if ($role != 'signer')
            $users= Users::model()->findAllByAttributes(array(),'role=:role1 || role=:role2', array(':role1'=>$role,':role2'=>'root'));
        $emails= '';
        if ($role != 'techdir' && $role != 'gendir' && $role != 'signer') {
            foreach ($users as $user)
                $emails.=$user->login.',';
        } else if ($role == 'techdir') {
            foreach ($users as $user)
                if (intval($user->available))
                    $emails.=$user->login.',';
            if (empty($emails)) {
                $this->redirect(array('/site/send','role'=>'gendir', 'back'=>$back));
            }
        } else if ($role == 'gendir') {
            foreach ($users as $user)
                if (intval($user->available))
                    $emails.=$user->login.',';
            if (empty($emails)) {
                $this->redirect(array('/site/send','role'=>'techdir', 'back'=>$back));
            }
        } else if ($role == 'signer') {
            $users= Users::model()->findAllByAttributes(array(),'role=:role1 || role=:role2', array(':role1'=>'accountant',':role2'=>'root'));
            foreach ($users as $user)
                $emails.=$user->login.',';
        }
//        var_dump($emals);
        $emails= rtrim($emails, ',');

        $name='=?UTF-8?B?'.Yii::app()->user->fname.'?=';
        $subject='=?UTF-8?B?'.base64_encode($subject).'?=';
        $un= Yii::app()->user->name;
        $headers="From: $name <{$un}>\r\n".
            "Reply-To: {$emails}\r\n".
            "MIME-Version: 1.0\r\n".
            "Content-Type: text/plain; charset=UTF-8";

        //if (mail($emails,$subject,$body,$headers)) {
            if ($role != 'signer')
                $this->redirect(array('/register/view','id'=>$back, 'msg'=>'Уведомление по почте успешно отправлено!')); //$role
            else
                $this->redirect(array('/site/send','role'=>'supplier', 'back'=>$back));
//    }
//        Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//        $this->refresh();

    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}