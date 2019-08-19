<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\departamento\Departamento */

$this->title = 'Actualizar Departamento:';
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddepartamento, 'url' => ['view', 'id' => $model->iddepartamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
