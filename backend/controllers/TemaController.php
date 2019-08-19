<?php

namespace backend\controllers;

use backend\models\estudiante\Estudiante;
use backend\models\trabajador\Trabajador;
use Yii;
use backend\models\tema\Tema;
use backend\models\tema\TemaSearch;
use backend\models\asignacion\Asignacion;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * TemaController implements the CRUD actions for Tema model.
 */
class TemaController extends Controller
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
     * Lists all Tema models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TemaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tema model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = new Query;
        $query->select(['trabajador.idtrabajador','trabajador.nombre', 'trabajador.apellidos'])
            ->distinct()
            ->from('trabajador')
            ->leftJoin('asignacion', 'asignacion.tutor_id = trabajador.idtrabajador')
            ->where('tema_id ='.$id);
        $command = $query->createCommand();
        $trabajadores = $command->queryAll();


        $query = new Query;
        $query->select(['estudiante.idestudiante','estudiante.nombre', 'estudiante.apellidos'])
            ->distinct()
            ->from('estudiante')
            ->leftJoin('asignacion', 'asignacion.estudiante_id = estudiante.idestudiante')
            ->where('tema_id ='.$id);
        $command = $query->createCommand();
        $estudiantes = $command->queryAll();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'trabajadores' => $trabajadores,
            'estudiantes' => $estudiantes,
            'id' => $id
        ]);
    }

    /**
     * Creates a new Tema model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tema();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_at = date("Y-m-d h:i:s");
            $model->estado = 'banco';
            $model->save();
            return $this->redirect(['view', 'id' => $model->idtema]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tema model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtema]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tema model.
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
     * Finds the Tema model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tema the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tema::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAsignar($id = -1)
    {

        if (Yii::$app->request->post()) {
            $tutores = $_POST['Asignacion']['tutor_id'];
            $estudiantes = $_POST['Asignacion']['estudiante_id'];
            $modelAsignacion = Asignacion::findAll(["tema_id"=> $id]);

            foreach ($modelAsignacion as $item){
                $item->delete();
            }

            foreach ($tutores as $tutor) {
                foreach ($estudiantes as $estudiante){
                    $model = new Asignacion();
                    $model->load(Yii::$app->request->post());
                    $model->fecha = date("Y-m-d h:i:s");
                    $model->tutor_id = $tutor;
                    $model->estudiante_id = $estudiante;
                    $model->save();
                }
            }

            $modelTema = Tema::find()->where(["idtema"=>$id])->one();
            $modelTema->estado = "asignado";
            $modelTema->save();


            return $this->redirect(['index']);
        }

        $model = new Asignacion();

        $modelTema = Tema::find()->where(["idtema"=> $id])->one();
        if($modelTema->estado == "asignado"){
            $asignaciones =  Asignacion::find()->where(["tema_id"=>$id])->all();
            $estudiantes = [];
            $tutores = [];

            foreach ($asignaciones as $item){
                $estudiante = Estudiante::find()->where(["idestudiante"=> $item->estudiante_id])->one();
                $estudiantes[$estudiante->idestudiante] = $estudiante->nombre." ".$estudiante->apellidos;

                $tutor = Trabajador::find()->where(["idtrabajador"=> $item->tutor_id])->one();
                $tutores[$tutor->idtrabajador] = $tutor->nombre." ".$tutor->apellidos;
            }
        }


        return $this->render('asignacion/form', [
            'model' => $model,
            'tema_id' => $id,
            'modelTema' => $modelTema,
            'est' => isset($estudiantes) ? $estudiantes : "",
            'tutores' => isset($tutores) ? $tutores : ""
        ]);
    }

    public function actionAddestudiante($tema_id)
    {
        $modelEstudiante = new Estudiante();

        if(Yii::$app->request->post()){
            $modelEstudiante->load(Yii::$app->request->post());

            \Yii::$app->response->format = Response::FORMAT_JSON;
            $modelEstudiante->save();
            return $this->redirect('asignar?id='.$tema_id);
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;


        return [
            'title'=> "Adicionar estudiante",
            'content'=>$this->renderPartial('asignacion/estudiante', [
                'modelEstudiante' => $modelEstudiante,
                'tema_id' => $tema_id,
            ]),
            'footer'=> ''
        ];


    }

    public function actionDeletetrabajador(){
        $trabajadorId = Yii::$app->request->get('trabajador_id');
        $id = Yii::$app->request->get('id');

        $models = Asignacion::find()
            ->where('tutor_id ='.$trabajadorId)
            ->andWhere('tema_id ='.$id)
            ->all();

        foreach ($models as $model) {
            $model->delete();
        }

        return $this->actionView($id);
    }

    public function actionDeleteestudiante(){
        $estudianteId = Yii::$app->request->get('estudiante_id');
        $id = Yii::$app->request->get('id');

        $models = Asignacion::find()
            ->where('estudiante_id ='.$estudianteId)
            ->andWhere('tema_id ='.$id)
            ->all();

        foreach ($models as $model) {
            $model->delete();
        }

        return $this->actionView($id);
    }
}
