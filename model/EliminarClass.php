<?php
require '../coreapp/Conexion.php';
class EliminarClass 
{
    private $conn;
        
        function __construct(){
            
            $this->conn = new Conexion();
            return $this->conn;
    }

    public function BorrarOtorgante($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escriotor1 WHERE cod_inv = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }
    
    public function BorrarFavorecido($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escrifavor1 WHERE cod_inv = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }
    
    public function BorrarOtorganteJuridico($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escriotor1 WHERE cod_inv_ju = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }
    
    public function BorrarFavorecidoJuridico($codEscritura, $codInvolucrado) {
        $sql= "DELETE FROM escrifavor1 WHERE cod_inv_ju = $codInvolucrado AND cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }
}