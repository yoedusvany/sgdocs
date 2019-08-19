<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\elementoacta\ElementoActa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elemento-acta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'elemento')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
