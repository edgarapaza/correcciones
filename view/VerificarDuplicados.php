<?php
require '../model/AddPersonaClass.php';

$nombre = strtoupper(trim($_REQUEST['nombre']));
$paterno = strtoupper(trim($_REQUEST['paterno']));
$materno = strtoupper(trim($_REQUEST['materno']));
$cod_sct = $_REQUEST['cod_sct'];
$cod_per = $_REQUEST['cod_per'];

$ver = new AddPersonaClass();
$resp = $ver->Duplicados($nombre, $paterno, $materno);

if ($resp['Cod_inv'] > 0)
{
    echo "El nombre ya existe VERIFIQUE EN LA BASE DE DATOS. ";
}
else
{
    #echo "Agregamos a la persona";
    $ver->NuevaPersona($paterno, $materno, $nombre);
    
    #Cod_inv, Nom_inv, Pat_inv, Mat_inv
    $involucrado = $ver->BuscarCompleto($nombre, $paterno, $materno);
    $cod_inv = $involucrado['Cod_inv'];
    //echo " Codigo del Involucrado ".$cod_inv;

    $ver->AgregarOtorgante($cod_sct, $cod_inv, $cod_per);

    echo "<script type='text/javascript'> alert('Info'); </script>";
    echo "<script type='text/javascript'> window.close(); </script>";
}