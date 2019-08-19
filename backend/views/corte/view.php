<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\corte\CorteAsignacion */

$this->title = $model->idcorte_asignacion;
$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['acta/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cortes', 'url' => ['index?idacta='.$idacta]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corte-asignacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idcorte_asignacion, 'idacta'=> $idacta], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idcorte_asignacion, 'idacta'=> $idacta], [
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
            'no_orden',
            [
                'attribute' => 'acta.nombre',
                //'value' => 'acta.nombre',
                'label'=> 'Nombre de acta'
            ],
            [

                'attribute' => 'asignacion.tema.nombre',
                //'value' => 'asignacion.tema.nombre',
                'label'=> 'Nombre de tema'
            ],
            'nota',
            'observaciones:html',
        ],
    ]) ?>

</div>
