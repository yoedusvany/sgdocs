<?php


use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SGDocs';
?>
<div class="site-index">

    <div class="jumbotron" style="text-align: center;">
        <h1>REPORTES</h1>

        <p class="lead">Aqu&iacute; usted podr&aacute; visualizar informaci&oacute;n proveniente del sistema.</p>

    </div>

    <div class="body-content">

        <?php
        //AREAS
        $dataProvider = new ArrayDataProvider([
            'allModels' => $areas,
        ]);
         $content = GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'area'
            ],
        ]);


         //DEPARTAMENTOS
        $dataProvider1 = new ArrayDataProvider([
            'allModels' => $departamentos,
        ]);
        $content1 = GridView::widget([
            'dataProvider' => $dataProvider1,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'area.area',
            ],
        ]);


        //TEMAS
        $dataProvider2 = new ArrayDataProvider([
            'allModels' => $temas,
        ]);
        $content2= GridView::widget([
            'dataProvider' => $dataProvider2,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'desc:html',
                'estado',
                'lineaInvestigacion.nombre_linea_inv',
                'area.area',
            ],
        ]);


        //TUTORES
        $dataProvider3 = new ArrayDataProvider([
            'allModels' => $tutores,
        ]);
        $content3 = GridView::widget([
            'dataProvider' => $dataProvider3,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'apellidos',
                'categoria_docente',
                'categoria_cientifica',
                'departamento.nombre',
            ],
        ]);


        //ESTUDIANTES
        $dataProvider4 = new ArrayDataProvider([
            'allModels' => $estudiantes,
        ]);
        $content4 = GridView::widget([
            'dataProvider' => $dataProvider4,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'apellidos',
            ],
        ]);

        $items = [
            [
                'label'=>'<i class="glyphicon glyphicon-home"></i> &Aacute;reas',
                'content'=>$content,
                'active'=>true
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-calendar"></i> Departamentos',
                'content'=>$content1,
                'active'=>false
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-file"></i> Temas',
                'content'=>$content2,
                'active'=>false
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-user"></i> Tutores',
                'content'=>$content3,
                'active'=>false
            ], [
                'label'=>'<i class="glyphicon glyphicon-user"></i> Estudiantes',
                'content'=>$content4,
                'active'=>false
            ],
        ];
        ?>

      <?= TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false
        ]);
      ?>

    </div>
</div>
