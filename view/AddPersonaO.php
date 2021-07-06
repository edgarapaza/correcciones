<?php
require '../model/AddPersonaClass.php';

$escritura = $_REQUEST['cod_sct'];
$involucrado = $_REQUEST['involucrado'];
$personal = 1101;

/*echo "Escritura:".$escritura;
echo "Involucrado:".$involucrado;
echo "Personal:".$personal;
*/
$add = new AddPersonaClass();
$add->AgregarOtorgante($escritura, $involucrado, $personal);

echo "<script type='text/javascript'> alert('Nombre Agregado'); </script>";
echo "<script type='text/javascript'> window.close(); </script>";
