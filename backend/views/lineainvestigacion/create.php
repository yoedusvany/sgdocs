<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\lineainvestigacion\Lineainvestigacion */

$this->title = 'Crear Línea de Inestigación';
$this->params['breadcrumbs'][] = ['label' => 'Línea de Inestigación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lineainvestigacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
