<?php
require_once "../coreapp/Conexion.php";

class UbicarProtocolo
{
    private $conn;
    function __construct(){
        $this->conn = new Conexion();
    }

    public function BuscarProyecto($protocolo)
    {
        $sql = "SELECT proy_id, proy_nombre, not_id, num_protocolo, cod_usu, observaciones, estado FROM proyectos WHERE num_protocolo = $protocolo;";
        $data = $this->conn->ConsultaArray($sql);
        return $data;
    }
    public function BuscarProtocolo($protocolo){
        $sql = "SELECT cod_pro FROM escrituras1 WHERE cod_pro = $protocolo LIMIT 1;";
        $data = $this->conn->ConsultaArray($sql);
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