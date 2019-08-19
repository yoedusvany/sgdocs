<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\area\Area */

$this->title = 'Actualizar Area';
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idarea, 'url' => ['view', 'id' => $model->idarea]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
