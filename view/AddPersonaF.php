<?php
require '../model/AddPersonaClass.php';

$escritura   = $_REQUEST['codigoEscritura'];
$involucrado = $_REQUEST['codigoInvolucrado'];
$personal    = $_REQUEST['codigoPersonal'];

//echo "Escritura:".$escritura;
//echo "Involucrado:".$involucrado;
//echo "Personal:".$personal;

$add = new AddPersonaClass();
$add->AgregarFavorecido($escritura, $involucrado, $personal);

echo "<script type='text/javascript'> alert('Nombre Agregado'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";