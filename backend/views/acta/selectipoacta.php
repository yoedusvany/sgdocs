<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\tipoacta\TipoActa;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php
            $tipos = TipoActa::find()->all();
            $listData=ArrayHelper::map($tipos,'idtipo_acta','tipo');
            ?>
            <?=
                $form->field($model, 'idtipo_acta')->dropDownList($listData,['prompt'=>'Seleccione...'])->label("Tipo de Acta");
            ?>
        </div>
        <div class="col-lg-6">
            <label>Modo</label>
            <?= Html::dropDownList('tipo','Seleccione modo',['online'=>'Online', 'offline'=>'Offline'],['class'=>'form-control']) ?>
        </div>
    </div>
    <br>
    <div class="form-group text-center">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Close',['class'=>'btn btn-default pull-center','data-dismiss'=>"modal"]) ?>
    </div>
<?php ActiveForm::end(); ?>