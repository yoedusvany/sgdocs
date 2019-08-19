<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\elementoacta\ElementoActa */

$this->title = 'Actualizar elemento-acta';
$this->params['breadcrumbs'][] = ['label' => 'Elemento-acta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idelemento_acta, 'url' => ['view', 'id' => $model->idelemento_acta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elemento-acta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
