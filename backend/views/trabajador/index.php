<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\departamento\Departamento;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\trabajador\TrabajadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trabajadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Trabajador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'apellidos',
            [
                'value' => 'categoria_docente',
                'attribute' => 'categoria_docente',
                'filter'=>[
                    "Instructor"=>"Instructor",
                    "Asistente"=> "Asistente",
                    "Auxiliar"=>"Auxiliar",
                    "Titular"=>"Titular"
                ]
            ],
            [
                'value' => 'categoria_cientifica',
                'attribute' => 'categoria_cientifica',
                'filter'=>[
                    "Licenciado"=>"Licenciado",
                    "Ingeniero"=>"Ingeniero",
                    "Máster"=>"Máster",
                    "Doctor"=>"Doctor"
                ]
            ],

            [
                'label' => 'Departamento',
                'value' => 'departamento.nombre',
                'attribute' => 'departamento_id',
                'filter' => Html::activeDropDownList($searchModel, 'departamento_id',
                    ArrayHelper::map(Departamento::find()->asArray()->all(),
                        'iddepartamento',
                        'nombre'
                    ),
                    ['class'=>'form-control','prompt' => 'Todos']),
            ],
            [
                'label' => 'Username',
                'value' => 'users.username',
                'attribute' => 'username',
            ],
            [
                'label' => 'Correo',
                'value' => 'users.email',
                'attribute' => 'email',
            ],

            //'departamento_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
