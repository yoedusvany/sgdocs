<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use cenotia\components\modal\RemoteModal;
use backend\models\tipoacta\TipoActa;
use backend\models\corte\CorteAsignacion;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\acta\ActaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Crear Acta','/acta/selecttipoacta',['role'=>"XXXXXXXXXID",'class'=>'btn btn-success','id'=>'modalButton'])?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'tipo_acta_id',
                'value' => 'tipoActa.tipo',
                'label' => 'Tipo de acta',
                'filter' => Html::activeDropDownList($searchModel, 'tipo_acta_id',
                    ArrayHelper::map(TipoActa::find()->asArray()->all(),
                        'idtipo_acta',
                        'tipo'
                    ),
                    ['class'=>'form-control','prompt' => 'Todas']),
            ],

            'fecha',
            'nombre',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {myButton} {myButton1}',  // the default buttons + your custom button
                'buttons' => [
                    'update' => function($url, $model, $key) {

                        if($model->tipoActa->tipo == "corte"){
                            $tipoCorte = TipoActa::find()->where(["idtipo_acta"=> $model->tipo_acta_id])->one();
                            if(strtolower($tipoCorte->tipo) == "corte"){
                                $corte = CorteAsignacion::find()->where(["acta_id"=>$model->idacta])->one();

                                if(isset($corte->asignacion)){
                                    $tema = $corte->asignacion->tema;

                                    if($tema->estado != "finalizado"){
                                        return Html::a('<i class="fa fa-pencil"></i>', ['update?idacta='.$model->idacta], ['title'=>'Actualizar','class' => '', 'data-pjax' => 0]);
                                    }
                                }else{

                                    return Html::a('<i class="fa fa-pencil"></i>', ['update?idacta='.$model->idacta], ['title'=>'Actualizar','class' => '', 'data-pjax' => 0]);
                                }


                            }
                        }elseif($model->modo != "offline"){
                            return Html::a('<i class="fa fa-pencil"></i>', ['update?id='.$model->idacta], ['title'=>'Actualizar','class' => '', 'data-pjax' => 0]);
                        }


                    },
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        if(strtolower($model->tipoActa->tipo) == "corte"){
                            return Html::a('<i class="fa fa-cut"></i>', ['corte/index?idacta='.$model->idacta], ['title'=>'Adicionar corte','class' => '', 'data-pjax' => 0]);
                        }
                    },
                    'myButton1' => function($url, $model, $key) {     // render your custom button
                        if($model->modo != "offline"){
                            return Html::a('<i class="fa fa-file-pdf-o"></i>', ['word?idacta='.$model->idacta], ['title'=>'Exportar a word','class' => '', 'data-pjax' => 0]);
                        }
                    }
                ]

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>


<?php RemoteModal::begin([
    "id"=>"XXXXXXXXXID",
    "options"=> [ "class"=>"fade stick-up"],
    "footer"=>"", // always need it for jquery plugin
])?>
<?php RemoteModal::end(); ?>
