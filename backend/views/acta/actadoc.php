<p align="right">
    <?= $acta->fecha?>
</p>

<p>
    <h2 style="text-align: center">ACTA</h2>
<br>
<b>Nombre:</b> <?= $acta->nombre?>
<br>
<b>Tipo de acta:</b> <?= $acta->tipoActa->tipo?>
</p>




<?php
    foreach ($elementos as $key => $item){
?>
        <h3 style="text-align: center"><?= $key ?></h3>
        <div>
            <?= $item?>
        </div>
<?php
    }
?>

<br>
<br>
