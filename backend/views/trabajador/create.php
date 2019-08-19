<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\trabajador\Trabajador */

$this->title = 'Crear Trabajador';
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="trabajador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]) ?>

</div>