<?php
require_once '../coreapp/Conexion.php';

class AddPersonaClass
{
    private $conn;
        
    function __construct(){
        $this->conn = new Conexion();
        return $this->conn;
    }
    
    public function AgregarOtorgante($cod_sct, $cod_inv, $cod_per) {
        
        $sql = "INSERT INTO escriotor1 (cod_sct, cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct, $cod_inv, $cod_per,0);";
        $this->conn->ConsultaSin($sql);
    }
    
    public function AgregarFavorecido($cod_sct, $cod_inv, $cod_per) {
        
        $sql = "INSERT INTO escrifavor1 (cod_sct, cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct, $cod_inv, $cod_per,0);";
        $this->conn->ConsultaSin($sql);
    }
    
    public function AgregarOtorganteJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escriotor1 (cod_sct,cod_per,cod_inv_ju) VALUES ($cod_sct,$cod_per,$cod_inv_ju);";
        $this->conn->ConsultaSin($sql);
    }
    
    public function AgregarFavorecidoJuridico($cod_sct,$cod_per,$cod_inv_ju) {
        
        $sql = "INSERT INTO dbarp.escrifavor1 (cod_sct,cod_per,cod_inv_ju) VALUES ($cod_sct,$cod_per,$cod_inv_ju);";
        $this->conn->ConsultaSin($sql);
    }

    public function NuevoFavorecidoJuridico($cod_sct,$cod_per,$razonsocial) {
        #echo $razonsocial;
        $sql1 = "INSERT INTO dbarp.involjuridicas1 (Raz_inv) VALUES ('$razonsocial');";
        $this->conn->ConsultaSin($sql1);

        $ultimosql = "SELECT * FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial' LIMIT 1;";
        $fila = $this->conn->ConsultaArray($ultimosql);
        #echo "Codigo Generado:" . $fila['Cod_inv'];
        $codigo_invJur = $fila['Cod_inv'];

        $sql = "INSERT INTO dbarp.escrifavor1 (cod_sct,cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$codigo_invJur);";
        $this->conn->ConsultaSin($sql);
    }

    public function NuevoOtorganteJuridico($cod_sct,$cod_per,$razonsocial) {
        #echo $razonsocial;
        $sql1 = "INSERT INTO dbarp.involjuridicas1 (Raz_inv) VALUES ('$razonsocial');";
        $this->conn->ConsultaSin($sql1);

        $ultimosql = "SELECT * FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial' LIMIT 1;";
        $fila = $this->conn->ConsultaArray($ultimosql);
        #echo "Codigo Generado:" . $fila['Cod_inv'];
        $cod_invJur = $fila['Cod_inv'];

        $sql = "INSERT INTO dbarp.escriotor1 (cod_sct,cod_inv, cod_per,cod_inv_ju) VALUES ($cod_sct,0,$cod_per,$cod_invJur);";
        $this->conn->ConsultaSin($sql);
    }

    public function ModificarJuridico($cod_inv, $razon)
	{
		$sql = "UPDATE involjuridicas1 SET Raz_inv = '$razon' WHERE Cod_inv = $cod_inv LIMIT 1;";
		$this->conn->ConsultaSin($sql);
	}
    
    public function BuscarNombre($nombre, $paterno) {
        
        $sql = "SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados1 WHERE Nom_inv LIKE '%$nombre%' AND Pat_inv LIKE '%$paterno%';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }
    
    public function BuscarCompleto($nombre, $paterno, $materno) {
        $sql = "SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados1 WHERE Nom_inv LIKE '%$nombre%' AND Pat_inv LIKE '%$paterno%' AND Mat_inv LIKE '%$materno%';";
        $res = $this->conn->ConsultaArray($sql);
        return $res;
    }
    
    public function BuscarJuridico($razonSocial) {
        
        $sql = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$razonSocial%';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }
    
    public function Duplicados($nombre='',$paterno='',$materno='') {
        $sql="SELECT Cod_inv FROM involucrados1 WHERE nom_inv = '$nombre' and pat_inv = '$paterno' and mat_inv = '$materno';";
        $res = $this->conn->ConsultaArray($sql);
        return $res;
    }
        
    public function DuplicadosJuridicos($razonsocial)
    {
        $sql = "SELECT Cod_inv, Raz_inv FROM dbarp.involjuridicas1 WHERE Raz_inv = '$razonsocial';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }

    public function NuevaPersona($Pat_inv, $Mat_inv, $Nom_inv){
        $sql = "INSERT INTO dbarp.involucrados1 (Pat_inv,Mat_inv,Nom_inv) VALUES ('$Pat_inv', '$Mat_inv', '$Nom_inv')";
        $this->conn->ConsultaSin($sql);
    }

}
