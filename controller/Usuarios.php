<?php
require '../model/UsuariosClass.php';

$codigo =$_REQUEST['codigo'];
$nombres =strtoupper($_REQUEST['nombres']);
$paterno =strtoupper($_REQUEST['paterno']);
$materno =strtoupper($_REQUEST['materno']);

$edgar = new UsuariosClass();
$edgar->ModificarNombre($codigo,$nombres,$paterno,$materno);

?>
