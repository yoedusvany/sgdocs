<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\trabajador\Trabajador */

$this->title = 'Actualizar Trabajador';
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtrabajador, 'url' => ['view', 'id' => $model->idtrabajador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trabajador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
        'action' => 'update'
    ]) ?>

</div>
