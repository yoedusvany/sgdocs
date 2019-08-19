<?php

namespace backend\controllers;

use backend\models\elementoacta\ElementoActa;
use backend\models\tipoactaelemento\TipoActaElemento;
use backend\models\tipoacta\TipoActa;
use backend\models\tipoacta\TipoActaSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoactaController implements the CRUD actions for TipoActa model.
 */
class TipoactaController extends Controller
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
     * Lists all TipoActa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoActaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoActa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $elementos = TipoActaElemento::findAll(["tipo_acta_id" => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'elementos' => $elementos
        ]);
    }

    /**
     * Creates a new TipoActa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoActa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_acta]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoActa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_acta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TipoActa model.
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
     * Finds the TipoActa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoActa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoActa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAsignar($id)
    {

        if(Yii::$app->request->post()){
            $data = Yii::$app->request->post();
            TipoActaElemento::deleteAll(["tipo_acta_id" => $data["tipoActa"]]);
            for($i = 0; $i < count($data["TipoActaElemento"]); $i=$i+2){
                $model = new TipoActaElemento();
                $model->tipo_acta_id = $data["tipoActa"];
                $model->elemento_acta_id = (isset($data["TipoActaElemento"][$i]["elemento_acta_id"]))
                    ? $data["TipoActaElemento"][$i]["elemento_acta_id"]
                    : $data["TipoActaElemento"][$i+1]["elemento_acta_id"];
                $model->orden = (isset($data["TipoActaElemento"][$i]["orden"]))
                    ? $data["TipoActaElemento"][$i]["orden"]
                    : $data["TipoActaElemento"][$i+1]["orden"];
                $model->save();
            }

            return $this->redirect(['index']);
        }



        $elementosTipoActa = TipoActaElemento::findAll(['tipo_acta_id' => $id]);
        $elementos = ElementoActa::find()->all();
        $variante = 'actualizar';

        if(!$elementosTipoActa){
            $variante = 'asignar';
        }

        $tipoActa = TipoActa::find()->where('idtipo_acta='.$id)->one();
        return $this->render('asignar', [
            'tipo_acta_id' => $id,
            'tipoActa' =>$tipoActa,
            'elementos' => $elementos,
            'elementosTipoActa' => $elementosTipoActa,
            'variante' => $variante
        ]);
    }
}
