<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\lineainvestigacion\Lineainvestigacion */

$this->title = 'Actualizar Línea de investigación';
$this->params['breadcrumbs'][] = ['label' => 'Línea de investigación', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlinea_investigacion, 'url' => ['view', 'id' => $model->idlinea_investigacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lineainvestigacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
