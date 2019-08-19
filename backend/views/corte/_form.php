<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TouchSpin;
use vova07\imperavi\Widget;
use \yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\corte\CorteAsignacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corte-asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-5">
            <?= $form->field($model, 'asignacion_id')->dropDownList($asignaciones,['prompt'=>'Seleccione...'])->label("Tema") ?>

        </div>
        <div class="col-lg-5">
            <label>Nota</label>
            <?= TouchSpin::widget([
                'model' => $model,
                'attribute' => 'nota',
                'options' => ['placeholder' => 'Adjust ...'],
                'pluginOptions' => ['step' => 1, 'min' => 2, 'max' => 5, 'initval' => 5]
            ]);
            ?>
        </div>

        <div class="col-lg-2">
            <label>Finalizar?</label>
            <?php

            if((isset($update)) || $cortes > 0){
                $disable = false;
            }else{
                $disable = true;
            }
                echo SwitchInput::widget([
                    'name' => 'finalizar',
                    'disabled' => $disable,
                    'pluginOptions' => ['size' => 'medium']
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?=
            $form->field($model, 'observaciones')->widget(Widget::className(), [
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


    <?= Html::hiddenInput('CorteAsignacion[acta_id]', $idacta); ?>

    <?php

    if(isset($update) && $update){
        echo Html::hiddenInput('CorteAsignacion[no_orden]', $model->no_orden);
    }

    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
