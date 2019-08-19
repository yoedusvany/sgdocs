<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\tema\Tema */

$this->title = $model->idtema;
$this->params['breadcrumbs'][] = ['label' => 'Temas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<br>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del tema "<?= Html::encode($model->nombre) ?>"</h3>

        <div class="box-tools pull-right">
                <?= Html::a('Asignar', ['asignar', 'id' => $model->idtema], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Actualizar', ['update', 'id' => $model->idtema], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Borrar', ['delete', 'id' => $model->idtema], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'area.area',
                'lineaInvestigacion.nombre_linea_inv',
                'desc:html',
                'estado',
                'create_at',
            ],
        ]) ?>
    </div>
    <!-- /.box-body -->
</div>


<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Datos adicionales </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-lg-6">


                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">TUTORES</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                        <?php
                            foreach ($trabajadores as $trabajador){
                        ?>
                            <div class="row">
                                <div class="col-lg-10">
                                    <?= $trabajador['nombre']." ".$trabajador['apellidos']?>
                                </div>
                                <div class="col-lg-2">
                                    <?= Html::a('<i class="fa fa-minus"></i>', ['deletetrabajador', 'trabajador_id' => $trabajador['idtrabajador'],'id' => $id],['title' => 'Eliminar','style'=>'color:red']) ?>
                                </div>
                            </div>
                        <?php
                            }
                        ?>

                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
            <div class="col-lg-6">


                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">ESTUDIANTES</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                        <?php
                        foreach ($estudiantes as $estudiante){
                            ?>
                            <div class="row">
                                <div class="col-lg-10">
                                    <?= $estudiante['nombre']." ".$estudiante['apellidos']?>
                                </div>
                                <div class="col-lg-2">
                                    <?= Html::a('<i class="fa fa-minus"></i>', ['deleteestudiante', 'estudiante_id' => $estudiante['idestudiante'],'id' => $id],['title' => 'Eliminar','style'=>'color:red']) ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
