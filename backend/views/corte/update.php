<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\corte\CorteAsignacion */

$this->title = 'Actualizar Corte';
$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['acta/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cortes', 'url' => ['index?idacta='.$idacta]];
$this->params['breadcrumbs'][] = ['label' => $model->idcorte_asignacion, 'url' => ['view', 'id' => $model->idcorte_asignacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="corte-asignacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idacta' => $idacta,
        'asignaciones' => $asignaciones,
        'update' => true
    ]) ?>

</div>
