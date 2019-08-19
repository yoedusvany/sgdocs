<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\area\Area;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\tema\TemaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Temas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tema-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Tema', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'linea_investigacion_id',
                'value' => 'lineaInvestigacion.nombre_linea_inv',
                'label' => 'Línea de investigación',
                'filter' => Html::activeDropDownList($searchModel, 'linea_investigacion_id',
                    ArrayHelper::map(\backend\models\lineainvestigacion\Lineainvestigacion::find()->asArray()->all(),
                        'idlinea_investigacion',
                        'nombre_linea_inv'
                    ),
                    ['class'=>'form-control','prompt' => 'Todas']),

            ],

            //'linea_investigacion_id',
            'nombre',
            'desc:html',
            [
                'attribute' => 'estado',
                'value' => 'estado',
                'label' => 'Estado',
                'filter'=>array("banco"=>"banco","asignado"=>"asignado","terminado"=>"terminado")
            ],
            //'create_at',
            [
                'attribute'=>'create_at',
                'value' =>'create_at',
                'format' =>'raw',

                'filter'=>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'create_at',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true
                    ]
                ])
            ],

            [
                'attribute' => 'area_id',
                'value' => 'area.area',
                'filter' => Html::activeDropDownList($searchModel, 'area_id',
                    ArrayHelper::map(Area::find()->asArray()->all(),
                        'idarea',
                        'area'
                    ),
                    ['class'=>'form-control','prompt' => 'Todas']),
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {myButton}',  // the default buttons + your custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a('<i class="fa fa-hand-pointer-o"></i>', ['tema/asignar?id='.$model->idtema], ['title'=>'Asignar','class' => '', 'data-pjax' => 0]);
                }
                ]

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
