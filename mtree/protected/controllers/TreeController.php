<?php

class TreeController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'createtree', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $qid = '', $nodeway = '')
    {
        if (!empty($qid)) {
            $qids = explode(',', $qid);
            $quest = array();
            foreach ($qids as $item) {
                $tmp = TreeData::model()->findByPk($item);
                if (isset($tmp))
                    $quest[] = $tmp;
            }
            if (count($quest)) {
                $this->render('view', array(
                    'model' => $this->loadModel($id),
                    'quest' => $quest
                ));
                $rr = 0;
            } else {
                $this->render('view', array(
                    'model' => $this->loadModel($id)
                ));
                $rr = 0;
            }
        } else {
            $this->render('view', array(
                'model' => $this->loadModel($id)
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tree the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Tree::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Tree;
        $quest = TreeData::model()->findAllByAttributes(array('creator_id' => Yii::app()->user->id));
        $qout = TreeData::getAllAttr($quest);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Tree'])) {
            $output = & $_POST['Tree'];
            $output['creator_id'] = Yii::app()->user->id;
            $model->attributes = $output;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
            'quest' => $qout
        ));
    }

    public function actionCreatetree()
    {
        $model = new Tree;
        $quest = TreeData::model()->findAllByAttributes(array('creator_id' => Yii::app()->user->id));
        $qout = TreeData::getAllAttr($quest);

        $qc_model = new TreeData;
        $valid = false;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($qc_model);
        if (isset($_POST['TreeData'])) {
            if (isset($_POST['TreeData']['update_node'])) {
                $qmodel = TreeData::model()->findByPk($_POST['TreeData']['qid']);

                if ($_POST['TreeData']['update_node'] == 'get_data') {
                    if ($qmodel) {
                        echo CJSON::encode(array(
                            'message' => 'success',
                            'id' => $qmodel->id,
                            'question' => $qmodel->question,
                            'answers' => $qmodel->answers
                        ));
                    } else {
                        echo CJSON::encode(array(
                            'message' => 'Get Failed or Object not found'
                        ));
                    }
                    Yii::app()->end();
                } else
                    if ($_POST['TreeData']['update_node'] == 'update') {
                    $qmodel->attributes = $_POST['TreeData'];

                    $valid = $qmodel->validate();
                    if ($valid) {
                        if ($qmodel->save(false)) {
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'qid' => $qmodel->id
                            ));
                        } else {
                            echo CJSON::encode(array(
                                'status' => 'error',
                                'message' => 'Save Failed'
                            ));
                        }
                    } else {
                        $error = CActiveForm::validate($qc_model);
                        if ($error != '[]')
                            echo $error;
                    }
                    Yii::app()->end();
                }
            } else {

                $output = & $_POST['TreeData'];
                $output['creator_id'] = Yii::app()->user->id;
                $qc_model->attributes = $output;

                $valid = $qc_model->validate();
                if ($valid) {
                    if ($qc_model->save(false)) {
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'qid' => $qc_model->id
                        ));
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'message' => 'Save Failed'
                        ));
                    }
                    Yii::app()->end();
                } else {
                    $error = CActiveForm::validate($qc_model);
                    if ($error != '[]')
                        echo $error;
                    Yii::app()->end();
                }
            }
        }

        if (isset($_POST['Tree'])) {
            if (!$valid) {
                $output = & $_POST['Tree'];
                $output['creator_id'] = Yii::app()->user->id;
                $model->attributes = $output;
                $valid = $model->validate();
                if ($valid) {
                    if ($model->save(false))
                        $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('createtree', array(
            'model' => $model,
            'quest' => $qout,
            'qc_model' => $qc_model
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param Tree $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tree-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tree'])) {
            $model->attributes = $_POST['Tree'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Tree', array(
            'criteria' => array(
                'order' => 'id DESC',
            )));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Tree('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Tree']))
            $model->attributes = $_GET['Tree'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
}
