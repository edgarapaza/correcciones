<?php
require "../model/AddPersonaClass.php";
$addpersona = new AddPersonaClass();

$codigo_juridico = $_REQUEST['cod_inv'];
# echo $codigo_juridico;
$datos = $addpersona->ShowInstitucion($codigo_juridico);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Modificar Nombres</title>
  <link rel="stylesheet" type="text/css" href="./css/formulario.css">
</head>
<body>

  <h3>Modificar Nombres del Sistema</h3>
  <div class="">
      <form id="form1" name="form1" method="post" action="../controller/modificarNombresJuridicos.php">
          <div class="">
            <input type="hidden" name="cod_juridico" id="cod_juridico" value="<?php echo $datos['Cod_inv'];?>" />
              <table class="table">
                  <tr>
                    <td>Nombre de la Institución:</td>
                    <td><input name="Raz_inv" id="Raz_inv" type="text" class="form-control"  size="120px" value="<?php echo $datos['Raz_inv'];?>" /></td>
                  </tr>
                  <tr>
                    <td>Otros:</td>
                    <td><input name="otros_juri" type="text" id="otros_juri" size="120px" value="<?php echo $datos['otros_juri'];?>" class="form-control" /></td>
                  </tr>
                  
                    <td><button class="button" type="submit" name="btnGuardar" value="Guardar Cambios" >Guardar Cambios</button></td>
                  </tr>
              </table>
          </div>
      </form>
  </div>
</body>
</html>

