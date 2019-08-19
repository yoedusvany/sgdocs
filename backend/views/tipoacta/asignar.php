<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/05/18
 * Time: 12:22
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TouchSpin;
use kartik\widgets\SwitchInput;
use backend\assets\AppAsset1;


AppAsset1::register($this);

function buscar($id, $array){
    foreach ($array as $value){
        if($value->elemento_acta_id == $id)
            return $value->orden;
    }
    return false;
}

/* @var $this yii\web\View */
/* @var $model backend\models\tipoacta\TipoActa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-acta-form">




    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">TIPO DE ACTA: <?= $tipoActa->tipo?> </h3>


            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

                <?php
                $i = 1;
                foreach ($elementos as $elemento){
                    $disable1 = ($variante == 'actualizar' && buscar($elemento->idelemento_acta, $elementosTipoActa))
                        ? true
                        : false;

                    $disable = ($variante == 'actualizar' && buscar($elemento->idelemento_acta, $elementosTipoActa))
                        ? ['class'=>'form-control','placeholder' => 'Establece el orden...']
                        : ["disabled"=>true,'class'=>'form-control','placeholder' => 'Establece el orden...'];

                    $disable2 = ($variante == 'actualizar' && buscar($elemento->idelemento_acta, $elementosTipoActa))
                        ? ['id'=> 'hidden'.$i]
                        : ['id'=> 'hidden'.$i, 'disabled'=>true];

                ?>
                <div class="row">
                    <div class="col-lg-3 text-right">
                        <?= $elemento->elemento ?>


                    </div>
                    <div class="col-lg-3 text-right">
                        <?= SwitchInput::widget([
                            'name' => 'activar',
                            'id' => 'sw'.$i,
                            'value' => $disable1,
                            'pluginOptions' => ['size' => 'large']
                        ]);?>
                    </div>
                    <div class="col-lg-6">
                        <?= TouchSpin::widget([
                            'name' => 'TipoActaElemento[][orden]',
                            'id' => 'tspin'.$i,
                            'value' => ($variante == 'actualizar' && buscar($elemento->idelemento_acta, $elementosTipoActa)) ? buscar($elemento->idelemento_acta, $elementosTipoActa) : 1,
                            'options' => $disable,
                            'pluginOptions' => ['step' => 1, 'min'=> 1]
                        ]); ?>

                        <?= Html::hiddenInput('TipoActaElemento[][elemento_acta_id]', $elemento->idelemento_acta,$disable2);?>
                    </div>
                </div>
            <?php
                    $i++;
            }
            ?>


            <?= Html::hiddenInput('cantidadCampos', $i-1);?>
            <?= Html::hiddenInput('tipoActa', $tipo_acta_id);?>
            <?= Html::hiddenInput('variante', $variante);?>

            <br>

            <div class="form-group text-right">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.box-body -->
    </div>


</div>
