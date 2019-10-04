<?php
class ListadoProtocoloClass {

    public function Listado($protocolo) {

        require_once '../coreapp/Conexion.php';
        $conection = new Conexion();
        $mysqli= $conection->Conectar();
        $sql = "SELECT cod_sct FROM escrituras1 WHERE cod_pro = $protocolo;";
        $result = $mysqli->query($sql);
        return $result;
    }
}




