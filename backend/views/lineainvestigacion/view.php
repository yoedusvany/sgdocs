<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\lineainvestigacion\Lineainvestigacion */

$this->title = $model->idlinea_investigacion;
$this->params['breadcrumbs'][] = ['label' => 'Línea de Inestigación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lineainvestigacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idlinea_investigacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idlinea_investigacion], [
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
            'nombre_linea_inv',
            'desc:ntext',
        ],
    ]) ?>

</div>
