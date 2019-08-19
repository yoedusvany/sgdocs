<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\tipoacta\TipoActaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Actas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Tipo de Acta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tipo',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {myButton}',  // the default buttons + your custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a('<i class="fa fa-hand-pointer-o"></i>', ['tipoacta/asignar?id='.$model->idtipo_acta], ['title'=>'Asignar elementos','class' => '', 'data-pjax' => 0]);
                    }
                ]

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
