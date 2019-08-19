<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\acta\Acta */

$this->title = 'Crear Acta';
$this->params['breadcrumbs'][] = ['label' => 'Actas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modo' => $modo,
        'modelAdjunto' => ($modo == "offline") ? $modelAdjunto : "",
        'elementos' => (isset($elementos)) ? $elementos : "",
        'tipoActa' => $tipoActa
    ]) ?>

</div>
