<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\rol\Rol */

$this->title = 'Update Rol:';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrol, 'url' => ['view', 'id' => $model->idrol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
