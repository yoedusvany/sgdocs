<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\lineainvestigacion\Lineainvestigacion;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\lineainvestigacion\LineainvestigacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Línea de Inestigación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lineainvestigacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear  Línea de Inestigación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'value' => 'nombre_linea_inv',
                'attribute' => 'nombre_linea_inv',
                'filter' => Html::activeDropDownList($searchModel, 'idlinea_investigacion',
                    ArrayHelper::map(Lineainvestigacion::find()->asArray()->all(),
                        'idlinea_investigacion',
                        'nombre_linea_inv'
                    ),
                    ['class'=>'form-control','prompt' => 'Todas']),
            ],
            'desc:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
