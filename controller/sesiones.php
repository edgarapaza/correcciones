<?php
session_start();
	include "../model/ValidacionClass.php";

	$user = trim($_REQUEST['usuario']);
	$pass = trim($_REQUEST['password']);

	$validacion = new Validacion();
	$data = $validacion->ValidacionCuenta($user,$pass);

	if($data['niv_usu'] == 1){
	    $_SESSION['administrator'] = $data['cod_usu'];
	    header("Location: ../view/index.php");
	}
	else
	{
	    header("Location: ../login.html");
	}

?>