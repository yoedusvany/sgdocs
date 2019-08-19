<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\tipoacta\TipoActa */

$this->title = 'Actualizar Tipo de Acta';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de acta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipo_acta, 'url' => ['view', 'id' => $model->idtipo_acta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-acta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modificar' => true
    ]) ?>

</div>
