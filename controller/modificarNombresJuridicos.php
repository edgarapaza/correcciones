<?php
require "../model/changeJuridico.controller.php";

echo $cod_juridico = $_REQUEST['cod_juridico'];
echo $institucion = trim(strtoupper($_REQUEST['Raz_inv']));
echo $otros   = trim(strtoupper($_REQUEST['otros_juri']));

$changeJuri = new Changejuridico();
$changeJuri->ChangeNombreJuridico($cod_juridico, $institucion, $otros);

//header("Location: ../view/changeProyecto.php");
?>