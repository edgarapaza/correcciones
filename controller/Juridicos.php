<?php
require '../model/AddPersonaClass.php';

$cod_inv =$_REQUEST['cod_inv'];
$razon =strtoupper(trim($_REQUEST['razonsocial']));

$mod = new AddPersonaClass();
$mod->ModificarJuridico($cod_inv, $razon);

echo "<script type='text/javascript'> alert('Info'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";