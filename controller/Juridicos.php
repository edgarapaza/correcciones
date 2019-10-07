<?php
require '../model/UsuariosClass.php';

$cod_inv =$_REQUEST['cod_inv'];
$razon =strtoupper(trim($_REQUEST['razonsocial']));

$mod = new UsuariosClass();
$mod->ModificarJuridico($cod_inv, $razon);
?>