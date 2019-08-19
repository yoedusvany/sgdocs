<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\estudiante\Estudiante */

$this->title = 'Crear Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
