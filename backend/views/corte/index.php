<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\corte\CorteAsignacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cortes del acta '.$idacta;

$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['acta/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corte-asignacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear corte', ['create?idacta='.$idacta], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nota',
            'observaciones:html',
            'no_orden',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',  // the default buttons + your custom button
                'buttons' => [
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a('<i class="fa fa-eye"></i>', ['corte/view?id='.$model->idcorte_asignacion."&idacta=".$model->acta_id], ['title'=>'Ver','class' => '', 'data-pjax' => 0]);
                    },
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a('<i class="fa fa-pencil"></i>', ['corte/update?id='.$model->idcorte_asignacion."&idacta=".$model->acta_id], ['title'=>'Actualizar','class' => '', 'data-pjax' => 0]);
                    },
                    'delete' => function ($url) {
                        return Html::a('<i class="fa fa-trash"></i>', $url, [
                            'title' => 'Borrar',
                            'data-confirm' => Yii::t('yii', 'Está seguro?'),
                            'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    }
                ], 'urlCreator' => function ($action, $model) {
                    if ($action === 'delete') {
                        $url = Url::to(['corte/delete', 'id' => $model->idcorte_asignacion, 'idacta' => $model->acta_id]);
                        return $url;
                    }
                }


            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
