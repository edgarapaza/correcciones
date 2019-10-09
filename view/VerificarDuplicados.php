<?php

$nombre = strtoupper(trim($_REQUEST['nombre']));
$paterno = strtoupper(trim($_REQUEST['paterno']));
$materno = strtoupper(trim($_REQUEST['materno']));

$cod_sct = $_REQUEST['cod_sct'];
$cod_per = $_REQUEST['cod_per'];

require '../model/AddPersonaClass.php';

$ver = new AddPersonaClass();
$resp = $ver->Duplicados($nombre, $paterno, $materno);

if ($resp == TRUE)
{
    echo "El nombre ya existe VERIFIQUE EN LA BASE DE DATOS. ";
}
else
{
    echo "Agregamo a la persona";
    $ver->NuevaPersona($paterno, $materno, $nombre);
    
}

$res = $ver->BuscarCompleto($nombre, $paterno, $materno);
$involucrado = $res->fetch_assoc();
$cod_inv = $involucrado['Cod_inv'];
//echo " Codigo del Involucrado ".$cod_inv;

$ver->AgregarOtorgante($cod_sct, $cod_inv, $cod_per);