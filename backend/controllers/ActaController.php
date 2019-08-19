<?php

namespace backend\controllers;

use backend\models\actaelemento\ActaElemento;
use backend\models\adjunto\Adjunto;
use backend\models\elementoacta\ElementoActa;
use backend\models\tipoacta\TipoActa;

use DOMDocument;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\acta\Acta;
use backend\models\acta\ActaSearch;
use backend\models\tipoactaelemento\TipoActaElemento;
use yii\web\Response;

use kartik\mpdf\Pdf;
use backend\models\corte\CorteAsignacion;

/**
 * ActaController implements the CRUD actions for Acta model.
 */
class ActaController extends Controller
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
     * Lists all Acta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $ficheros = Adjunto::find()->where(["acta_id" => $id])->one();

        $acta_elementos = ActaElemento::findAll(["acta_idacta" => $id]);
        $elementos = array();

        foreach ($acta_elementos as $value) {
            $tae = TipoActaElemento::find()->where(['id' => $value->tipo_acta_elemento_id])->one();
            $nombreElemento = ElementoActa::find()->where(["idelemento_acta" => $tae->elemento_acta_id])->one();

            $elementos[$nombreElemento->elemento] = $value->contenido;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'adjunto' => $ficheros,
            'elementos' => $elementos
        ]);
    }

    /**
     * Creates a new Acta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipoActa, $modo)
    {
        $model = new Acta();
        $modelAdjunto = new Adjunto();
        $elementos = TipoActaElemento::findAll(["tipo_acta_id" => $tipoActa]);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $area_id = Yii::$app->user->identity->getDpto()->getAttribute("area_id");

            $model->fecha = date("Y-m-d h:i:s");
            $model->area_id = $area_id;
            $model->tipo_acta_id = $tipoActa;

            if ($modo == "online") {
                $model->load(Yii::$app->request->post());
                $model->modo = "online";
                $model->save();

                foreach ($elementos as $elemento) {
                    $modelActaElemento = new ActaElemento();
                    $modelActaElemento->acta_idacta = $model->idacta;
                    $modelActaElemento->tipo_acta_elemento_id = $elemento->id;

                    $modelActaElemento->contenido = $data["contenido" . $elemento->id];
                    $modelActaElemento->save();
                }

            } else {
                $file = UploadedFile::getInstance($modelAdjunto, 'filename');

                $model->nombre = $file->name;
                $model->modo = "offline";
                $model->save();

                $modelAdjunto->filename = $file->name;
                $modelAdjunto->filesize = $file->size;
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);

                $modelAdjunto->acta_id = $model->idacta;
                $modelAdjunto->save();
            }

            return $this->redirect(['view', 'id' => $model->idacta]);
        }

        if ($modo == "online") {

            $array = [
                'model' => $model,
                'modo' => $modo,
                'elementos' => $elementos,
                'tipoActa' => $tipoActa
            ];
        } else {
            $array = [
                'model' => $model,
                'modo' => $modo,
                'modelAdjunto' => $modelAdjunto,
                'tipoActa' => $tipoActa
            ];
        }

        return $this->render('create', $array);
    }

    public function getTema($acta_id)
    {
        $acta = $this->findModel($acta_id);
        $tipoCorte = TipoActa::find()->where(["idtipo_acta" => $acta->tipo_acta_id])->one();

        if (strtolower($tipoCorte->tipo) == "corte") {
            $corte = CorteAsignacion::find()->where(["acta_id" => $acta_id])->one();

            if (isset($corte->asignacion)) {
                return $corte->asignacion->tema;
            }
        }

        return false;
    }

    /**
     * Updates an existing Acta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->tipoActa->tipo == "corte") {
                $tema = $this->getTema($id);
            }

            $model->save();

            $elementos = TipoActaElemento::findAll(["tipo_acta_id" => $model->tipo_acta_id]);
            $data = Yii::$app->request->post();

            foreach ($elementos as $elemento) {
                $modelActaElemento = ActaElemento::find()->where(["acta_idacta" => $model->idacta, "tipo_acta_elemento_id" => $elemento->id])->one();

                if (is_null($modelActaElemento)) {
                    $modelActaElemento = new ActaElemento();
                    $modelActaElemento->acta_idacta = $model->idacta;
                    $modelActaElemento->tipo_acta_elemento_id = $elemento->id;
                }
                $modelActaElemento->contenido = $data["contenido" . $elemento->id];
                $modelActaElemento->save();
            }
            return $this->redirect(['view', 'id' => $model->idacta]);


        } else {

            if ($model->modo == "offline") {
                $modelAdjunto = Adjunto::find()->where(["acta_id" => $id])->one();
            } else {
                $elementos = TipoActaElemento::findAll(["tipo_acta_id" => $model->tipo_acta_id]);
            }

            return $this->render('update', [
                'model' => $model,
                'modo' => $model->modo,
                'elementos' => isset($elementos) ? $elementos : "",
                'modelAdjunto' => isset($modelAdjunto) ? $modelAdjunto : ""
            ]);
        }
    }


    /**
     * Deletes an existing Acta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelAdjunto = Adjunto::find()->where(["acta_id" => $id])->one();

        if (isset($modelAdjunto->filename) && file_exists(Yii::getAlias('@webroot') . '/uploads/' . $modelAdjunto->filename)) {
            unlink(Yii::getAlias('@webroot') . '/uploads/' . $modelAdjunto->filename);
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Acta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSelecttipoacta()
    {
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $tipoActa = $data['TipoActa']['idtipo_acta'];
            $modo = Yii::$app->request->post("tipo");
            $model = new Acta();

            return $this->redirect([
                'create',
                'tipoActa' => $tipoActa,
                'modo' => $modo,
                'model' => $model
            ]);
            //$this->actionCreate($tipoActa,$modo);
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new TipoActa();
        return [
            'title' => "Seleccionar tipo de acta y modo",
            'content' => $this->renderPartial('selectipoacta', [
                'model' => $model
            ]),
            'footer' => ''
        ];
    }

    public function actionDownload()
    {
        $file = Yii::$app->request->get('file');
        $path = Yii::$app->request->get('path');
        $root = Yii::getAlias('@webroot') . $path . $file;
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new \yii\web\NotFoundHttpException("{$file} is not found!");
        }
    }

    public function actionWord($idacta)
    {
        $tipoActa = TipoActa::find()->where(["idtipo_acta" => $this->findModel($idacta)->tipo_acta_id])->one();

        if ($tipoActa->tipo == "offline") {
            $adjunto = Adjunto::find()->where(["acta_id" => $idacta])->one();
            return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . "/upload/" . $adjunto->filename);
        } else {
            $this->generarActa($idacta);
        }
    }


    /**
     * @param $idacta
     * @return $this
     */
    public function generarActa($idacta)
    {
        $this->report($idacta);
    }

    public function report($idacta) {
        $acta = $this->findModel($idacta);
        $elementos = TipoActaElemento::find()->where(["tipo_acta_id" => $acta->tipo_acta_id])->orderBy(['orden' => SORT_ASC])->all();
        $array = [];

        foreach ($elementos as $elemento) {
            $contenido = ActaElemento::find()->where(["acta_idacta" => $idacta, "tipo_acta_elemento_id" => $elemento->id])->one();
            $array[$elemento->elementoActa->elemento] = $contenido->contenido;
        }

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('actadoc',["elementos" => $array,'acta' => $acta]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // Letter paper format
            'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Acta'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['SGDocs'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
