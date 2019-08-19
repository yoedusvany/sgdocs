<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\acuerdos\AcuerdosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuerdos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idacuerdos') ?>

    <?= $form->field($model, 'acuerdo') ?>

    <?= $form->field($model, 'no_acuerdo') ?>

    <?= $form->field($model, 'acta_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
