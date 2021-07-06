<?php
require "../coreapp/Conexion.php";

class UbicarProtocolo
{
    private $conn;
    function __construct(){
        
        $conection = new Conexion();
        $this->conn= $conection->Conectar();
        return $this->conn;
    }

    public function BuscarProyecto($protocolo){
       $sql = "SELECT proy_id, proy_nombre, not_id, num_protocolo, cod_usu, observaciones, estado FROM proyectos WHERE num_protocolo = $protocolo;";
       $result = $this->conn->query($sql);
       $data = $result->fetch_array();

       return $data;
    }
    public function BuscarProtocolo($protocolo){
        $sql = "SELECT cod_pro FROM escrituras1 WHERE cod_pro = $protocolo LIMIT 1;";
        $result = $this->conn->query($sql);
        $data = $result->fetch_array();

       return $data;
     }
}
/*
$ubicarprotocolo = new UbicarProtocolo();
$datos1 = $ubicarprotocolo->BuscarProyecto(281);
$datos2 = $ubicarprotocolo->BuscarProtocolo(281);

echo "Con proyecto: ".$datos1[0];
echo "Sin Proyecto: ".$datos2[0];
*/
?>