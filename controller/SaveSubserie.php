<?php
require '../model/ChangeSubserieClass.php';

$cod_sct = $_REQUEST['cod_sct'];
$cod_sub = $_REQUEST['codigoSubserie'];

//echo "Escritura:".$cod_sct;
//echo "Involucrado:".$cod_sub;

$sub = new ChangeSubserieClass();
$sub->ChangeSubserie($cod_sub, $cod_sct);

echo "<script type='text/javascript'> alert('Info'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";
header("Refresh:0");