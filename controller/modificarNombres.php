<?php
require '../coreapp/Conexion.php';
$conexion = new Conexion();
$conn = $conexion->Conectar();

$codigo = $_REQUEST['cod_usu'];

$sql = "SELECT Cod_inv, Pat_inv, Mat_inv, Nom_inv FROM involucrados1 WHERE Cod_inv = $codigo;";
$valores = $conn->query($sql);
$datos = $valores->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Corregir Nombres</title>
</head>
<body>
  <h3>Modificar Nombres del Sistema</h3>
  <div class="general">
      <form id="form1" name="form1" method="post" action="Usuarios.php">
          <div class="formulario">
              <ul>
                <li><span class="required">Datos requeridos</span>
                </li>
                <input type="hidden" name="codigo" value="<?php echo $datos['Cod_inv'];?>" />
                <li> <label for="nombres">Nombres:</label> <input name="nombres" type="text" id="nombres" value="<?php echo $datos['Nom_inv'];?>" size="40" /></li>
                <li> <label for="paterno">Paterno:</label> <input name="paterno" type="text" id="paterno" value="<?php echo $datos['Pat_inv'];?>" size="40" /></li>
                <li> <label for="materno">Materno:</label> <input name="materno" type="text" id="materno" value="<?php echo $datos['Mat_inv'];?>" size="40"/></li>
                <li> <button class="submit" type="submit" name="btnGuardar" value="Guardar Cambios" >Guardar Cambios</button>
              </ul>
          </div>
      </form>
  </div>
</body>
</html>
