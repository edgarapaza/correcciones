<?php
require '../coreapp/Conexion.php';

class ChangeSubserieClass 
{
    private $conn;
        
    function __construct(){        
        $conection = new Conexion();
        $this->conn= $conection->Conectar();
        return $this->conn;
    }

    public function ListadoSubseries($valor) {
        $sql = "SELECT cod_sub, des_sub FROM subseries WHERE des_sub LIKE '%$valor%';";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function ChangeSubserie($cod_sub, $cod_sct) {
                
        $sql="UPDATE escrituras1 SET cod_sub = $cod_sub WHERE cod_sct = $cod_sct LIMIT 1;";
        if(!$this->conn->query($sql)){
            echo "Error cambiando la subserie";
        }
    }
}
