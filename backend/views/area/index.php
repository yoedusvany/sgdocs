<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\area\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        'area',

        ['class' => 'yii\grid\ActionColumn'],
    ];

?>
<div class="area-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= Html::a('Crear Area', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-2">
            <?=
            // Renders a export dropdown menu
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]);
            ?>
        </div>
        <div class="col-lg-8">
        </div>

    </div>
    <br>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
