<?php
require '../model/EliminarClass.php';

$codEscritura=$_REQUEST['codigoEscritura'];
$codInvolucrado =$_REQUEST['codigoInvolucrado'];
$tipo =$_REQUEST['opcion'];


if($tipo == "otorgante")
{
        echo $tipo." Eliminado";
        $del = new EliminarClass();
        
        $del->BorrarOtorgante($codEscritura, $codInvolucrado);
        echo "<script type='text/javascript'> alert('Nombre Excluido de la Escritura como otorgante'); </script>";
        echo "<script type='text/javascript'> window.close(); </script>";
}

if($tipo == "favorecido")
{
        echo $tipo." Eliminado";
        $del = new EliminarClass();
        
        $del->BorrarFavorecido($codEscritura, $codInvolucrado);
        echo "<script type='text/javascript'> alert('Nombre Excluido de la Escritura como Favorecido'); </script>";
        echo "<script type='text/javascript'> window.close(); </script>";
}

if($tipo == "otorganteJuridico")
{
        echo $tipo." Eliminado";
        $del = new EliminarClass();
        
        $del->BorrarOtorganteJuridico($codEscritura, $codInvolucrado);
        echo "<script type='text/javascript'> alert('Nombre Excluido de la Escritura como Otorgante Juridico'); </script>";
        echo "<script type='text/javascript'> window.close(); </script>";
}

if($tipo == "favorecidoJuridico")
{
        echo $tipo." Eliminado";
        $del = new EliminarClass();
        
        $del->BorrarFavorecidoJuridico($codEscritura, $codInvolucrado);
        echo "<script type='text/javascript'> alert('Nombre Excluido de la Escritura como Favorecido Juridico'); </script>";
        echo "<script type='text/javascript'> window.close(); </script>";
}