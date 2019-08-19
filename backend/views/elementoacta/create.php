<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\elementoacta\ElementoActa */

$this->title = 'Crear Elemento-acta';
$this->params['breadcrumbs'][] = ['label' => 'Elemento-acta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elemento-acta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
