<?php
require '../coreapp/Conexion.php';

class Changejuridico
{
    private $conn;
        
    function __construct(){        
        $this->conn = new Conexion();
    }

    public function ChangeNombreJuridico($cod_juridico, $institucion, $otros)
    {
        $sql = "UPDATE dbarp.involjuridicas1 SET Raz_inv = '$institucion', otros_juri = '$otros' WHERE Cod_inv = '".$cod_juridico."';";
        echo $sql;
        $this->conn->ConsultaSin($sql);
    }
    
}
