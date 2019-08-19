<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\estudiante\Estudiante */

$this->title = 'Update Estudiante: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idestudiante, 'url' => ['view', 'id' => $model->idestudiante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estudiante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
