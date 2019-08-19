<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\tipoacta\TipoActa */

$this->title = $model->idtipo_acta;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de acta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idtipo_acta], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idtipo_acta], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipo',
        ],
    ]) ?>


    <?php
        if($elementos) {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Elementos del tipo de acta</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            foreach ($elementos as $elemento) {
                                ?>
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><?= $elemento->orden ?></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $elemento->elementoActa->elemento ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>

                                <?php
                            }
                            ?>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

            <?php
        }
    ?>

</div>
