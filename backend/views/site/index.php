<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center">
        <h1>BIENVENIDOS</h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">TEMAS</span>
                        <span class="info-box-number"><?= count($temas)?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ACTAS</span>
                        <span class="info-box-number"><?= count($actas)?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!--<div class="col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Uploads</span>
                        <span class="info-box-number">13,648</span>
                    </div>
                </div>
            </div>-->
        </div>

    </div>
</div>
