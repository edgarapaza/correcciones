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
        if(!$result = $this->conn->query($sql)){
            echo "Error Registrando Favorecido";
        }
    }
    
    public function AgregarOtorganteJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escriotor1 (cod_sct,cod_per,cod_inv_ju) VALUES ($cod_sct,$cod_per,$cod_inv_ju);";
        if(!$result = $this->conn->query($sql)){
            echo "Error Agregando Otorgante Juridico";
        }
        
    }
    
    public function AgregarFavorecidoJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escrifavor1 (cod_sct,cod_per,cod_inv_ju) VALUES ($cod_sct,$cod_per,$cod_inv_ju);";
        if(!$result = $this->conn->query($sql)){
            echo "Error Agregando Favorecido Juridico";
        }
        
    }

    public function NuevoFavorecidoJuridico($cod_sct,$cod_per,$razonsocial) {
        echo $razonsocial;
        $sql1 = "INSERT INTO dbarp.involjuridicas1 (Raz_inv) VALUES ('$razonsocial');";
        if(!$this->conn->query($sql1)){
            echo "Error Agregando Nuevo Favorecido Juridico";
        }

        $ultimosql = "SELECT * FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial';";
        $data = $this->conn->query($ultimosql);
        $fila = $data->fetch_array();
        echo "Codigo Generado:" . $fila[0];

        $sql = "INSERT INTO dbarp.escrifavor1 (cod_sct,cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$fila[0]);";
        if(!$this->conn->query($sql)){
            echo "Error Agregando Codigo de Favorecido Juridico";
        }
    }

    public function NuevoOtorganteJuridico($cod_sct,$cod_per,$razonsocial) {
        echo $razonsocial;
        $sql1 = "INSERT INTO dbarp.involjuridicas1 (Raz_inv) VALUES ('$razonsocial');";
        if(!$this->conn->query($sql1)){
            echo "Error Agregando Nuevo Favorecido Juridico";
        }

        $ultimosql = "SELECT * FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial';";
        $data = $this->conn->query($ultimosql);
        $fila = $data->fetch_array();
        echo "Codigo Generado:" . $fila[0];

        $sql = "INSERT INTO dbarp.escriotor1 (cod_sct,cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$fila[0]);";
        if(!$this->conn->query($sql)){
            echo "Error Agregando Codigo de Favorecido Juridico";
        }
    }

    public function ModificarJuridico($cod_inv, $razon)
	{
		$sql = "UPDATE involjuridicas1 SET Raz_inv = '$razon' WHERE Cod_inv = $cod_inv LIMIT 1;";
		if(!$result = $this->conn->query($sql)){
			echo "Error Modificando el Datos Juridico";
		}
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
        
        if(!$dato = $this->conn->query($sql)){
            echo "Error buscando en lista de involiucrados";
        }

        //$numero = $dato->num_rows;
        return $dato;
    }
        
    public function DuplicadosJuridicos($razonsocial)
    {
        $sql = "SELECT Cod_inv, Raz_inv FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial';";

        if(!$dato = $this->conn->query($sql)){
            echo "Error buscando en lista de involiucrados";
        }

        //$numero = $dato->num_rows;
        return $dato;
    }

    public function NuevaPersona($Pat_inv, $Mat_inv, $Nom_inv){
        $sql = "INSERT INTO dbarp.involucrados1 (Pat_inv,Mat_inv,Nom_inv) VALUES ('$Pat_inv', '$Mat_inv', '$Nom_inv')";
        if(!$this->conn->query($sql)){
            echo "Error Agregando Nueva Persona a Base de Datos";
        }
    }

}
