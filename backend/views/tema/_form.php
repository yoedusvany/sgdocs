<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\lineainvestigacion\Lineainvestigacion;
use yii\helpers\ArrayHelper;
use backend\models\area\Area;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model backend\models\tema\Tema */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tema-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?php
            $areas = Area::find()->all();
            $listData=ArrayHelper::map($areas,'idarea','area');
            ?>
            <?= $form->field($model, 'area_id')->dropDownList($listData,['prompt'=>'Seleccione...']) ?>
        </div>
        <div class="col-lg-6">
            <?php
            $tipos = Lineainvestigacion::find()->all();
            $listData=ArrayHelper::map($tipos,'idlinea_investigacion','nombre_linea_inv');
            ?>
            <?= $form->field($model, 'linea_investigacion_id')->dropDownList($listData,['prompt'=>'Seleccione...'])->label("Línea de investigación") ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?=
            $form->field($model, 'desc')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'es',
                    'minHeight' => 200,
                    'plugins' => [
                        'fullscreen',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php
            $tipos = ["banco", "asignado", "terminado"];
            ?>
            <?= $form->field($model, 'estado')
                ->dropDownList($tipos,['value'=>0,'prompt'=>'Seleccione...','disabled' => 'true'])
                ->label("Estado") ?>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
