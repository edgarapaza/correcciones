<?php
session_start();
require "../model/UbicarProtocolo.php";

if(isset($_REQUEST['revisar']))
{
    $numeroProtocolo = $_REQUEST["protocolo"];

    $ubicarprotocolo = new UbicarProtocolo();
    
    $infoProyecto = $ubicarprotocolo->BuscarProyecto($numeroProtocolo);
    # buscarProyecto: proy_id, proy_nombre, not_id, num_protocolo, cod_usu, observaciones, estado
    $infoProtocolo = $ubicarprotocolo->BuscarProtocolo($numeroProtocolo);
    # Buscar Protocolo: cod_pro

    echo "con proyecto".$infoProyecto['proy_id'];
    echo "sin proyecto".$infoProtocolo['cod_pro'];

    if(isset($infoProyecto))
    {
        echo "Redireccionar a Proyecto";
        $_SESSION['proyecto'] = $infoProyecto['proy_id'];
        header("Location: ../view/changeProyecto.php");
    }else{

    }
        
    if(isset($infoProtocolo))
    {
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