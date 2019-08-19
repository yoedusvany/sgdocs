<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\area\Area;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\departamento\Departamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $tipos = Area::find()->all();
    $listData=ArrayHelper::map($tipos,'idarea','area');
    ?>
    <?= $form->field($model, 'area_id')->dropDownList($listData,['prompt'=>'Seleccione...'])->label("Área") ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
