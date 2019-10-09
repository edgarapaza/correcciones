<?php
require '../coreapp/Conexion.php';

class AddPersonaClass
{
    private $conn;
        
    function __construct(){
        $conection = new Conexion();
        $this->conn= $conection->Conectar();
        return $this->conn;
    }
    
    public function AgregarOtorgante($cod_sct, $cod_inv, $cod_per) {
        
        $sql = "INSERT INTO escriotor1 (cod_sct, cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct, $cod_inv, $cod_per,0);";
        if(!$result = $this->conn->query($sql)){
            echo "Error Agregando Otorgante";
        }
        
    }
    
    public function AgregarFavorecido($cod_sct, $cod_inv, $cod_per) {
        
        $sql = "INSERT INTO escrifavor1 (cod_sct, cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct, $cod_inv, $cod_per,0);";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function AgregarOtorganteJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escriotor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$cod_inv_ju);";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function AgregarFavorecidoJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escrifavor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$cod_inv_ju);";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function BuscarNombre($nombre, $paterno) {
        
        $sql = "SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados1 WHERE Nom_inv LIKE '%$nombre%' AND Pat_inv LIKE '%$paterno%';";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function BuscarCompleto($nombre, $paterno, $materno) {
        $sql = "SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados1 WHERE Nom_inv LIKE '%$nombre%' AND Pat_inv LIKE '%$paterno%' AND Mat_inv LIKE '%$materno%';";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function BuscarJuridico($razonSocial) {
        
        $sql = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$razonSocial%';";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    
    public function Duplicados($nombre='',$paterno='',$materno='') {
        $sql="SELECT cod_inv FROM involucrados1 WHERE nom_inv = '$nombre' and pat_inv = '$paterno' and mat_inv = '$materno';";
        
        $dato = $this->conn->query($sql);
        $numero = $dato->num_rows;
     
        if($numero > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function NuevaPersona($Pat_inv, $Mat_inv, $Nom_inv){
        $sql = "INSERT INTO dbarp.involucrados1 (Pat_inv,Mat_inv,Nom_inv) VALUES ('$Pat_inv', '$Mat_inv', '$Nom_inv')";
        $this->conn->query($sql);   
    }

}
