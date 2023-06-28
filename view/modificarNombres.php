<?php
require "../model/AddPersonaClass.php";
$addpersona = new AddPersonaClass();

$codigo = $_REQUEST['cod_usu'];
$datos = $addpersona->ShowPersona($codigo);
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
  <div class="general">
      <form id="form1" name="form1" method="post" action="Usuarios.php">
          <div class="formulario">
            <input type="hidden" name="codigo" value="<?php echo $datos['Cod_inv'];?>" />
              <table class="table table-hover">
                  <tr>
                    <td width="100">Nombres:</td>
                    <td><input name="nombres" type="text" class="form-control" id="nombres" value="<?php echo $datos['Nom_inv'];?>" /></td>
                  </tr>
                  <tr>
                    <td>Paterno:</td>
                    <td><input name="paterno" type="text" id="paterno" value="<?php echo $datos['Pat_inv'];?>" class="form-control" /></td>
                  </tr>
                  <tr>
                    <td>Materno:</td>
                    <td><input name="materno" type="text" id="materno" value="<?php echo $datos['Mat_inv'];?>" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td><button class="button" type="submit" name="btnGuardar" value="Guardar Cambios" >Guardar Cambios</button></td>
                  </tr>
              </table>
          </div>
      </form>
  </div>
</body>
</html>
