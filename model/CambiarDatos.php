<?php
require_once "../coreapp/Conexion.php";
class CambiarDatos
{
    private $conn;
        
    function __construct(){
        $this->conn = new Conexion();
        return $this->conn;
    }

    public function CambiarFolio ($codEscritura, $numeroFolio) {
        $sql= "UPDATE dbarp.escrituras1 SET num_fol = '$numeroFolio' WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

    public function CambiarNumeroEscritura ($codEscritura, $numeroEscritura) {
        $sql= "UPDATE dbarp.escrituras1 SET num_sct = $numeroEscritura WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

    public function CambiarCantidadFolios ($codEscritura, $cantidadFolios) {
        $sql= "UPDATE dbarp.escrituras1 SET can_fol = $cantidadFolios WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

    public function CambiarFechaDocumento ($codEscritura, $fechaDocumento) {
        $sql= "UPDATE dbarp.escrituras1 SET fec_doc = '$fechaDocumento' WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

    public function CambiarSubSerie ($codEscritura, $codigoSubSerie) {
        $sql= "UPDATE dbarp.escrituras1 SET cod_sub = $codigoSubSerie WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

    public function CambiarNombreBien($codEscritura, $nombreBien) {
        $bien = strtoupper($nombreBien);
        $sql= "UPDATE dbarp.escrituras1 SET nom_bie = '$bien' WHERE cod_sct = $codEscritura LIMIT 1;";
        $this->conn->ConsultaSin($sql);
    }

}

#$cambiarDatos = new CambiarDatos();
#$cambiarDatos->CambiarFolio(2,5);
