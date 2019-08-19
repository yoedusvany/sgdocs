<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\departamento\Departamento;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-lg-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
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
            <?= $form->field($model, 'email') ?>
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
    </div>
</div>
