<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\acta\ActaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idacta') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'tipo_acta_id') ?>

    <?= $form->field($model, 'area_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
