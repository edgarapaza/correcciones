<?php
require '../model/AddPersonaClass.php';

$razonsocial = strtoupper(trim($_REQUEST['razonsocial']));

$cod_sct = $_REQUEST['cod_sct'];
$cod_per = $_REQUEST['cod_per'];



$ver = new AddPersonaClass();
$resp = $ver->DuplicadosJuridicos($razonsocial);

if ($resp)
{
    echo "Agregamo a la persona";
    $ver->NuevoFavorecidoJuridico($cod_sct,$cod_per,$razonsocial);
}

echo "<script type='text/javascript'> alert('Info'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";