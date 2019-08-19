<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\lineainvestigacion\Lineainvestigacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lineainvestigacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_linea_inv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
