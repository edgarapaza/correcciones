<?php
function Listado($protocolo){
    require '../model/ListadoProtocoloClass.php';
    
    $test = new ListadoProtocoloClass();
    $result = $test->Listado($protocolo);
    
    return $result;
}





        