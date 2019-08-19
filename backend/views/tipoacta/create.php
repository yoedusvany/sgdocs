<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\tipoacta\TipoActa */

$this->title = 'Crear Tipo de Acta';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Actas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
