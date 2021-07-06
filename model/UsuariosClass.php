<?php
require '../coreapp/Conexion.php';
class UsuariosClass
{
	private $conn;
	
	function __construct(){
    	$conection = new Conexion();
        $this->conn= $conection->Conectar();
        return $this->conn;
    }

	public function ModificarNombre($codigo=0, $nombre='',$paterno='',$materno='')
	{
		$sql = "UPDATE involucrados1 SET Pat_inv = '$paterno', Mat_inv = '$materno', Nom_inv = '$nombre' WHERE Cod_inv = $codigo LIMIT 1;";

		if(!$result = $this->conn->query($sql)){
			echo "Error Modificando el nombre Juridico";
		}
	}

	public function AgregarOtorgante($cod_sct)
	{
		
		$sql = "SELECT COUNT(cod_rel) AS total FROM escriotor1 WHERE cod_sct = $cod_sct;";
		$result = $this->conn->query($sql);
		$datos = $result->fetch_assoc();

		$total = $datos['total'];
		echo $total;
		if($total == 0)
		{
			echo "NO TIENE NINGUN OTORGANTES REGISTRADO A ESTA ESCRITURA. Verifique el Protocolo y asegurese que la informacion es correcta";
		}
		else
		{
			$sqlinsert = "INSERT INTO escriotor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES (<{cod_rel: }>,<{cod_sct: }>,<{cod_inv: }>,<{cod_per: }>,<{cod_inv_ju: }>);";
			echo $sqlinsert;
		}
	}
        
	
}

?>
