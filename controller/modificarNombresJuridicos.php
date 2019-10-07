<?php
require '../coreapp/conection.php';

$codigo = $_REQUEST['cod_inv'];

$sql = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = $codigo;";
$valores = $mysqli->query($sql);
$datos = $valores->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/styleform.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<h3>Modificar Datos del Sistema</h3>
<div class="general">
      <form id="form1" name="form1" method="post" action="Juridicos.php">
          <div class="formulario">
              <ul>
                <li><span class="required">Datos requeridos</span>
                </li>
                <input type="hidden" name="cod_inv" value="<?php echo $datos['Cod_inv'];?>" />
                <li> <label for="razonsocial">Razon Social:</label> <textarea name="razonsocial" id="nombres" cols="80" rows="10" /><?php echo $datos['Raz_inv'];?> </textarea> </li>
                
                <li> <button class="submit" type="submit" name="btnGuardar" value="Guardar Cambios">Guardar Cambios</button>
              </ul>
          </div>
      </form>
  </div>
</body>
</html>
