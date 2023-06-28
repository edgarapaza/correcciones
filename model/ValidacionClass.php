<?php
require_once "../coreapp/Conexion.php";

class Validacion
	{

		private $conn;
		function __construct(){
            $this->conn = new Conexion();
            
        }

		function ValidacionCuenta($user, $pass){
			$sql = "SELECT cod_usu, niv_usu FROM usuarios WHERE log_usu='$user' AND psw_usu ='$pass' LIMIT 1";
			$data = $this->conn->ConsultaArray($sql);
            return $data;
		}
	}


 ?>