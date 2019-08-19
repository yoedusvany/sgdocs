<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\trabajador\Trabajador */

$this->title = $model->idtrabajador;
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idtrabajador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idtrabajador], [
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
            'nombre',
            'apellidos',
            'categoria_docente',
            'categoria_cientifica',
            [
                'label' => 'Departamento',
                'attribute' => 'departamento.nombre',
            ],
            [
                'label' => 'Username',
                'attribute' => 'users.username',
            ],
            [
                'label' => 'Correo',
                'attribute' => 'users.email',
            ]

        ],
    ]) ?>

</div>
