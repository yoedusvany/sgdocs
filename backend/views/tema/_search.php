<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\tema\TemaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tema-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idtema') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'linea_investigacion_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
