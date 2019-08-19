<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\acuerdos\Acuerdos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuerdos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'acuerdo')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    //'imageUpload' => ['/redactor/upload/image'],
                    //'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                ]
            ])?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'no_acuerdo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'acta_id')->textInput() ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
