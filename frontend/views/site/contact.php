<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use frontend\assets\AppAsset;

AppAsset::register($this);

$this->title = 'Contactenos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    if (Yii::$app->session->getFlash("success") != ""){
        echo Yii::$app->session->get("success");
?>
        <span class="alert alert-success"><?= Yii::$app->session->get("success") ?></span>
<?php
    }

    if(Yii::$app->session->getFlash("error") != ""){
?>
        <span class="alert alert-danger"><?= Yii::$app->session->get("error")?></span>
<?php
    }
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Si usted tiene alguna sugerencia, queja o duda puede contactarnos a trav&eacute;s del siguiente formulario.
    </p>

    <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'email') ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'subject') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
