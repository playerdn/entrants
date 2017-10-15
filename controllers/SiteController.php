<?php

namespace app\controllers;

use Yii;
use app\models\EntrantsRecord;
use app\models\EntrantsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntrantsController implements the CRUD actions for EntrantsRecord model.
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EntrantsRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
       
        $searchModel = new EntrantsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $cookies = Yii::$app->request->cookies;
        $val = $cookies->getValue('cookie_id', '0');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cookie_id' => $val,
        ]);
    }

    /**
     * Displays a single EntrantsRecord model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EntrantsRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntrantsRecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // setup cookie
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
              'name' => 'cookie_id',
              'value' => $model->cookie_id,
              'expire' => time() + (10 * 365 * 24 *3600),
            ]));
            
//            return $this->redirect(['success', 'id' => $model->id]);
            return $this->render('success', [
                'model' => $model,
            ]);
        } else {
            return $this->render('createUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntrantsRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $dbSecretHash = $model->secret;
        
        
        if ($model->load(Yii::$app->request->post())) {
            if(! Yii::$app->security->validatePassword($model->secret, $dbSecretHash)) {
                $model->addError ('secret', 'Incorrect code');
                return $this->render('createUpdate', [
                    'model' => $model,
                ]);
            }
            
            if($model->save()) {
                return $this->render('success', [
                'model' => $model,
            ]);
            } else {
                return $this->render('createUpdate', [
                'model' => $model,
            ]);
            }
        } else {
            return $this->render('createUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EntrantsRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntrantsRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntrantsRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntrantsRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
