<?php
require '../model/AddPersonaClass.php';

$cod_sct = $_REQUEST['cod_sct'];
$cod_inv_ju = $_REQUEST['codigojuridico'];
$cod_per = $_REQUEST['cod_per'];
/*
echo "Escritura:".$cod_sct;
echo "Involucrado:".$cod_inv_ju;
echo "Personal:".$cod_per;
*/

$addJuridico= new AddPersonaClass();
$addJuridico->AgregarOtorganteJuridico($cod_sct, $cod_per, $cod_inv_ju);

echo "<script type='text/javascript'> alert('Info'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";