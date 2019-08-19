<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-6"><?= $form->field($modelEstudiante, 'nombre')->textInput(['maxlength' => true]) ?></div>
    <div class="col-lg-6"><?= $form->field($modelEstudiante, 'apellidos')->textInput(['maxlength' => true]) ?></div>

    <?= Html::hiddenInput('tema_id', $tema_id);?>
</div>
<br>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    <?= Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])?>
</div>
<?php ActiveForm::end(); ?>