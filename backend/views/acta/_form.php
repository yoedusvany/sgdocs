<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\actaelemento\ActaElemento;

use kartik\file\FileInput;
use backend\assets\AppAsset1;
use vova07\imperavi\Widget;


AppAsset1::register($this);


/* @var $this yii\web\View */
/* @var $model backend\models\acta\Acta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acta-form">

    <?php
    $options = ($model->modo == "offline") ? ['options' => ['enctype' => 'multipart/form-data']] : [];
    $form = ActiveForm::begin($options); ?>

    <?php
    if ($modo != "offline") {
        ?>
        <?= Html::hiddenInput('Acta[tipo_acta_id]', $tipoActa); ?>


        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>
        </div>


        <div id="content-elements">

            <?php
            $i = 0;
            foreach ($elementos as $elemento) {
                $contenido = ActaElemento::find()->where(["acta_idacta" => $model->idacta, "tipo_acta_elemento_id" => $elemento->id])->one();
                ?>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2> <?= $elemento->elementoActa->elemento ?> </h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?=

                        Widget::widget([
                            'name' => 'contenido' . $elemento->id,
                            'value' => (isset($contenido->contenido) ? $contenido->contenido : ""),
                            "options" => [
                                'id' => 'myCustomId' . $i,
                            ],
                            "settings" => [
                                "lang" => "es",
                                "minHeight" => 200,
                                "plugins" => [
                                    "fullscreen",
                                    "fontcolor",
                                    "fontfamily",
                                    "fontsize",
                                    "table"
                                ],
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>


        </div>
        <?php
    } else {

            echo $form->field($modelAdjunto, 'filename')->widget(FileInput::classname(), [
                'options' => ['accept' => 'pdf, doc, docx, odt'],
                'pluginOptions' => [
                    'initialPreviewAsData' => false,
                ]
            ]);
        }
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
