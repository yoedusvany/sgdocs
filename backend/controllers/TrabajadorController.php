<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use backend\models\trabajador\Trabajador;
use backend\models\trabajador\TrabajadorSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrabajadorController implements the CRUD actions for Trabajador model.
 */
class TrabajadorController extends Controller
{
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
     * Lists all Trabajador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrabajadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trabajador model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Trabajador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trabajador();
        $modelUser = new User();

        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelUser])) {
            //datos para la tabla trabajador
            $model->save(false);

            $request = Yii::$app->request;
            $param = $request->getBodyParam('User');

            $modelUser->username = $param["username"];
            $modelUser->email = $param["email"];
            $modelUser->setPassword($param["password_hash"]);
            $modelUser->generateAuthKey();
            $modelUser->rol_id = '2';
            $modelUser->trabajador_id = $model->idtrabajador;
            $modelUser->save();

            return $this->redirect(['view', 'id' => $model->idtrabajador]);
        }else{
            $create = true;
        }

        return $this->render('create', [
            'model' => $model,
            'modelUser' => $modelUser,
            'create' => $create
        ]);
    }

    /**
     * Updates an existing Trabajador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUser = Yii::$app->user->identity->findIdentityByTrabajadorId($model->idtrabajador);

        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post()) && $model->save()) {

            $request = Yii::$app->request;
            $param = $request->getBodyParam('User');

            $modelUser->username = $param["username"];
            $modelUser->email = $param["email"];
            $modelUser->setPassword($param["password_hash"]);
            $modelUser->generateAuthKey();
            $modelUser->rol_id = '2';
            $modelUser->trabajador_id = $model->idtrabajador;
            $modelUser->save();

            return $this->redirect(['view', 'id' => $model->idtrabajador]);
        }

        $modelUser->password_hash = "";

        return $this->render('update', [
            'model' => $model,
            'modelUser' => $modelUser
        ]);
    }

    /**
     * Deletes an existing Trabajador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trabajador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trabajador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trabajador::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
