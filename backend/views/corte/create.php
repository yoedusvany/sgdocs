<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\corte\CorteAsignacion */

$this->title = 'Adicionar información de corte';
$this->params['breadcrumbs'][] = ['label' => 'Cortes', 'url' => ['index?idacta='.$idacta]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corte-asignacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idacta' => $idacta,
        'asignaciones' => $asignaciones,
        'cortes' => $cortes
    ]) ?>

</div>
