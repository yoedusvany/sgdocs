<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\acta\Acta */

$this->title = $model->idacta;
$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if($model->modo != "offline"){
                echo Html::a('Update', ['update', 'id' => $model->idacta], ['class' => 'btn btn-primary']);
            }
        ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idacta], [
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
            'fecha',
            'nombre',
            'tipoActa.tipo',
            'area.area',
        ],
    ]) ?>

    <?php
        if(isset($adjunto->filename)){
    ?>
            <a href="<?= Yii::$app->urlManager->createUrl(['acta/download','path'=>'/uploads/','file'=>$adjunto->filename])?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Fichero</span>
                                <span class="info-box-number"><?= $adjunto->filename?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
            </a>

            <?php
        }else{

            foreach ($elementos as $key => $elemento) {


                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-default box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?=$key?></h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?=$elemento?>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
                <?php
            }
        }
    ?>

</div>
