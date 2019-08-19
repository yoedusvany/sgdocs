<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\tipoacta\TipoActa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-acta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?php
        if(isset($modificar) && $modificar == true){
            echo Html::a('<i class="fa fa-hand-pointer-o"></i> Modificar elementos', ['tipoacta/asignar?id='.$model->idtipo_acta], ['title'=>'Modificar elementos','class' => 'btn btn-default']);
        }
        ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
