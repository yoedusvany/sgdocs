<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\acuerdos\Acuerdos */

$this->title = 'Update Acuerdos: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Acuerdos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idacuerdos, 'url' => ['view', 'id' => $model->idacuerdos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acuerdos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
