<?php
session_start();

require "../model/UbicarProtocolo.php";


if(isset($_REQUEST['revisar']))
{
    $numeroProtocolo = $_REQUEST["protocolo"];

    $ubicarprotocolo = new UbicarProtocolo();
    
    $infoProyecto = $ubicarprotocolo->BuscarProyecto($numeroProtocolo);
    $infoProtocolo = $ubicarprotocolo->BuscarProtocolo($numeroProtocolo);

    echo "Con proyecto: ".$datos1[0];
    echo "Sin Proyecto: ".$datos2[0];

    if($infoProyecto){
        echo "Redireccionar a Proyecto";
        $_SESSION['proyecto'] = $infoProyecto[0];
        header("Location: ../view/changeProyecto.php");
    }
        
    if($infoProtocolo){
        echo "Redireccionar a protocolo";
        $_SESSION['protocolo'] = $numeroProtocolo;
        header("Location: ../view/changeProtocolo.php");
    }
        
    /*
    $nombre_archivo = 'protocolo.txt';
    $contenido = $numeroProtocolo;

          // Primero vamos a asegurarnos de que el archivo existe y es escribible.
          if (is_writable($nombre_archivo))
          {

              // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adición.
              // El puntero al archivo está al final del archivo
              // donde irá $contenido cuando usemos fwrite() sobre él.
              if (!$gestor = fopen($nombre_archivo, '+a')) {
                   echo "No se puede abrir el archivo ($nombre_archivo)";
                   exit;
              }

              // Escribir $contenido a nuestro archivo abierto.
              if (fwrite($gestor, $contenido) === FALSE) {
                  echo "No se puede escribir en el archivo ($nombre_archivo)";
                  exit;
              }

              echo "Se escribio ($contenido) en el archivo ($nombre_archivo)";

              fclose($gestor);

          }
          else
          {
              echo "El archivo $nombre_archivo no es escribible";
          }

    header("Location: ../changeProtocolo.php");
    */
}