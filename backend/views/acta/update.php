<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\acta\Acta */

$this->title = 'Actualizar Acta';
$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idacta, 'url' => ['view', 'id' => $model->idacta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modo' => $modo,
        'tipoActa' => $model->tipo_acta_id,
        'elementos' => isset($elementos) ? $elementos : "",
        'modelAdjunto' => isset($modelAdjunto) ? $modelAdjunto : ""
    ]) ?>

</div>
