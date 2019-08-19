<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\departamento\Departamento */

$this->title = 'Crear Departamento';
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
