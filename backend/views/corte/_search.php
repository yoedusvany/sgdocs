<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\corte\CorteAsignacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corte-asignacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idcorte_asignacion') ?>

    <?= $form->field($model, 'nota') ?>

    <?= $form->field($model, 'observaciones') ?>

    <?= $form->field($model, 'no_orden') ?>

    <?= $form->field($model, 'acta_id') ?>

    <?php // echo $form->field($model, 'asignacion_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
