<?php
require '../model/UsuariosClass.php';

$codigo =$_REQUEST['codigo'];
$nombres =strtoupper($_REQUEST['nombres']);
$paterno =strtoupper($_REQUEST['paterno']);
$materno =strtoupper($_REQUEST['materno']);

$edgar = new UsuariosClass();
$edgar->ModificarNombre($codigo,$nombres,$paterno,$materno);

echo "<script type='text/javascript'> alert('Nombre Corregido'); </script>";
echo "<script type='text/javascript'> javascript:history.back(1) </script>";

?>