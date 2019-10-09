<?php
$escritura = $_REQUEST['cod_sct'];
$involucrado = $_REQUEST['involucrado'];
$personal = $_REQUEST['cod_per'];

//echo "Escritura:".$escritura;
//echo "Involucrado:".$involucrado;
//echo "Personal:".$personal;
echo "Nombre Agregado. CIERRE LA VENTANA";

AddFavorecido( $escritura, $involucrado, $personal);
        
function AddFavorecido($cod_sct, $cod_inv, $cod_per) {
    
    require '../model/AddPersonaClass.php';
    $add = new AddPersonaClass();
    $add->AgregarFavorecido($cod_sct, $cod_inv, $cod_per);
}

