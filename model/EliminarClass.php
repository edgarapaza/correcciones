<?php
require '../coreapp/Conexion.php';
class EliminarClass 
{
    private $conn;
        
        function __construct(){
            
            $conection = new Conexion();
            $this->conn= $conection->Conectar();
            return $this->conn;
    }

    public function BorrarOtorgante($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escriotor1 WHERE cod_inv = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        if(!$this->conn->query($sql)){
            echo "Error Borrando el Otorgante.";
        }
        
    }
    
    public function BorrarFavorecido($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escrifavor1 WHERE cod_inv = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        if(!$this->conn->query($sql)){
            echo "Error borrando el Favorecido";
        }
    }
    
    public function BorrarOtorganteJuridico($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escriotor1 WHERE cod_inv_ju = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        if($this->conn->query($sql)){
            echo "Error Eliminando el Otorgante Juridico";
        }
    }
    
    public function BorrarFavorecidoJuridico($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escrifavor1 WHERE cod_inv_ju = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        if(!$this->conn->query($sql))
        {
            echo "Error Eliminando el Favorecido Juridico";
        }
    }
}