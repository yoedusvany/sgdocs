<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\acuerdos\Acuerdos */

$this->title = $model->idacuerdos;
$this->params['breadcrumbs'][] = ['label' => 'Acuerdos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acuerdos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idacuerdos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idacuerdos], [
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
            'idacuerdos',
            'acuerdo',
            'no_acuerdo',
            'acta_id',
        ],
    ]) ?>

</div>
