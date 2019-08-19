<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\departamento\Departamento;
use yii\helpers\ArrayHelper;

?>
<div class="trabajador-create">
    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-6">
            <?php
                if(isset($create)){
                    $options = [
                        'autofocus' => true,
                        'readOnly'=> true
                    ];
                }else{
                    $options = [
                        'autofocus' => true,
                    ];
                }
            ?>
            <?= $form->field($modelUser, 'username')->textInput($options) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($modelUser, 'password_hash')->passwordInput(['minlength'=>5])->label('Password') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'nombre')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'apellidos')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($modelUser, 'email') ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <?php
            $tipos = [
                "Instructor"=>"Instructor",
                "Asistente"=> "Asistente",
                "Auxiliar"=>"Auxiliar",
                "Titular"=>"Titular"
            ];
            ?>
            <?= $form->field($model, 'categoria_docente')
                ->dropDownList($tipos,['prompt'=>'Seleccione...'])
                ->label("Categoría docente") ?>
        </div>
        <div class="col-lg-4">
            <?php
            $tipos1 = [
                "Licenciado"=>"Licenciado",
                "Ingeniero"=>"Ingeniero",
                "Máster"=>"Máster",
                "Doctor"=>"Doctor"
            ];
            ?>
            <?= $form->field($model, 'categoria_cientifica')
                ->dropDownList($tipos1,['prompt'=>'Seleccione...'])
                ->label("Categoría científica") ?>


        </div>
        <div class="col-lg-4">
            <?php
            $dptos = Departamento::find()->all();
            $listData=ArrayHelper::map($dptos,'iddepartamento','nombre');
            ?>
            <?= $form->field($model, 'departamento_id')->dropDownList($listData,['prompt'=>'Seleccione...'])->label("Departamento") ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
