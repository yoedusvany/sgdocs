<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\tema\Tema */

$this->title = 'Actualizar Tema';
$this->params['breadcrumbs'][] = ['label' => 'Temas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtema, 'url' => ['view', 'id' => $model->idtema]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tema-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
