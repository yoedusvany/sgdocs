<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\trabajador\Trabajador;
use backend\models\tema\Tema;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\estudiante\Estudiante;
use cenotia\components\modal\RemoteModal;


/* @var $this yii\web\View */
/* @var $model backend\models\asignacion\Asignacion */
/* @var $form ActiveForm */



$this->title = 'Asignación';
$this->params['breadcrumbs'][] = ['label' => 'Temas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<br>
<div class="asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Datos de la asignaci&oacute;n</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <?= Html::a('<i class="fa fa-plus"></i> Adicionar estudiante','addestudiante?tema_id='.$tema_id,['role'=>"XXXXXXXXXID",'class'=>'btn btn-success','id'=>'modalButton'])?>
                </div>


            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    $temas = Tema::find()->all();
                    $listData=ArrayHelper::map($temas,'idtema','nombre');
                    $model->tema_id = $tema_id;
                    ?>
                    <?= $form->field($model, 'tema_id')->dropDownList($listData,['prompt'=>'Seleccione...']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <?php
                    $workers = Trabajador::find()->all();
                    $listData=ArrayHelper::map($workers,'idtrabajador','nombre');

                    if(isset($tutores) && (count($tutores) > 0 && $tutores != "")){
                        $model->tutor_id = array_keys($tutores);
                    }
                    ?>
                    <?=
                    $form->field($model, 'tutor_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione Tutores ...','multiple' => true,]
                    ]);
                    ?>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <?php
                    $estudiantes = Estudiante::find()->all();
                    $listData=ArrayHelper::map($estudiantes,'idestudiante',function($estudiantes){
                        return $estudiantes->nombre.' '.$estudiantes->apellidos;
                    });

                    if(isset($est) && (count($est) > 0 && $est != "") && $modelTema->estado == "asignado"){
                        $model->estudiante_id = array_keys($est);
                    }
                    ?>
                    <?=
                    $form->field($model, 'estudiante_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione Estudiantes ...','multiple' => true,],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>



        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- asignacion-form -->

<?php RemoteModal::begin([
    "id"=>"XXXXXXXXXID",
    "options"=> [ "class"=>"fade slide-right "],
    "footer"=>"", // always need it for jquery plugin
])?>
<?php RemoteModal::end(); ?>