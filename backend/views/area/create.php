<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\area\Area */

$this->title = 'Crear Area';
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
