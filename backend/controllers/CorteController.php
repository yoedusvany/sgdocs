<?php

namespace backend\controllers;

use backend\models\acta\Acta;
use backend\models\asignacion\Asignacion;
use backend\models\tema\Tema;
use Yii;
use backend\models\corte\CorteAsignacion;
use backend\models\corte\CorteAsignacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CorteAsignacionController implements the CRUD actions for CorteAsignacion model.
 */
class CorteController extends Controller
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
     * Lists all CorteAsignacion models.
     * @return mixed
     */
    public function actionIndex($idacta)
    {
        if($this->esEditable($idacta)){
            $searchModel = new CorteAsignacionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $idacta);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'idacta' => $idacta
            ]);
        }else{
            return $this->redirect(['acta/index']);
        }

    }

    /**
     * Displays a single CorteAsignacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$idacta)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'idacta' => $idacta
        ]);
    }

    /**
     * Creates a new CorteAsignacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idacta)
    {
        if($this->esEditable($idacta)){
            $no_orden = CorteAsignacion::find()->where(["acta_id" => $idacta])->count();
            $model = new CorteAsignacion();

            if ($model->load(Yii::$app->request->post())) {
                $model->no_orden = $no_orden+1;
                $model->save();

                $data = Yii::$app->request->post();

                if(isset($data["finalizar"]) && $data["finalizar"]){
                    $corte = CorteAsignacion::find()->where(["acta_id"=> $idacta])->one();
                    $asignacion = $corte->asignacion;//Asignacion::find()->where(["idasignacion" => $corte->asignacion_id])->one();
                    $tema = $asignacion->tema;
                    $tema->estado = "finalizado";
                    $tema->save();

                    return $this->redirect(['acta/index']);
                }
                return $this->redirect(['corte/view', 'id' => $model->idcorte_asignacion, "idacta" => $idacta]);
            }

            $asignaciones = Asignacion::find()->all();
            $array = [];
            $arrayTemas = [];

            foreach ($asignaciones as $item){
                if(!array_key_exists($item->tema_id,$arrayTemas)){
                    $array[$item->idasignacion] =  $item->tema->nombre;
                    $arrayTemas[$item->tema_id] =  $item->tema->nombre;
                }
            }

            $cortes = CorteAsignacion::find()->where(["acta_id" => $idacta])->count();

            return $this->render('create', [
                'model' => $model,
                'cortes' => $cortes,
                'idacta' => $idacta,
                'asignaciones' => $array
            ]);
        }else{
            return $this->render('acta/index');
        }

    }

    /**
     * Updates an existing CorteAsignacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $idacta)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            if(isset($data["finalizar"]) && $data["finalizar"]){
                $corte = CorteAsignacion::find()->where(["acta_id"=> $idacta])->one();
                $asignacion = $corte->asignacion;//Asignacion::find()->where(["idasignacion" => $corte->asignacion_id])->one();
                $tema = $asignacion->tema;
                $tema->estado = "finalizado";
                $tema->save();

                return $this->redirect(['acta/index']);
            }
            return $this->redirect(['corte/view', 'id' => $model->idcorte_asignacion, "idacta" => $idacta]);
        }

        $asignaciones = Asignacion::find()->all();
        $array = [];
        $arrayTemas = [];

        foreach ($asignaciones as $item){
            if(!array_key_exists($item->tema_id,$arrayTemas)){
                $array[$item->idasignacion] =  $item->tema->nombre;
                $arrayTemas[$item->tema_id] =  $item->tema->nombre;

            }
        }

        return $this->render('update', [
            'model' => $model,
            'idacta' => $idacta,
            'asignaciones' => $array,
        ]);
    }

    /**
     * Deletes an existing CorteAsignacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$idacta)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index?idacta='.$idacta]);
    }

    /**
     * Finds the CorteAsignacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CorteAsignacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CorteAsignacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function esEditable($actaId){
        $acta = Acta::find()->where(["idacta"=> $actaId])->one();

        if($acta->tipoActa->tipo == "corte"){
            $corte = CorteAsignacion::find()->where(["acta_id"=> $actaId])->one();
            $asignacion = $corte->asignacion;//Asignacion::find()->where(["idasignacion" => $corte->asignacion_id])->one();
            $tema = $asignacion->tema;

            if($tema->estado == "finalizado"){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }


    }
}
