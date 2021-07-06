<?php

	/**
	*
	*/
	class Validacion
	{

		private $conn;
        function __construct(){
            require '../coreapp/Conexion.php';
            $conection = new Conexion();
            $this->conn= $conection->Conectar();
            return $this->conn;
        }

		function ValidacionCuenta($user, $pass){
			$sql = "SELECT cod_usu, niv_usu FROM usuarios WHERE log_usu='$user' AND psw_usu ='$pass' LIMIT 1";
			$rpta = $this->conn->query($sql);
            $data = $rpta->fetch_assoc();
            return $data;

            $mysqli->close();
		}
	}


 ?>