<?php
$nombre = strtoupper(trim($_REQUEST['nombre']));
$paterno = strtoupper(trim($_REQUEST['paterno']));
$materno =  strtoupper(trim($_REQUEST['materno']));
$cod_sct = $_REQUEST['cod_sct'];
$cod_per = $_REQUEST['cod_per'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nueva Persona</title>
	<link rel="stylesheet" href="./css/formulario.css">
</head>
<body>
	<div class="general">
	    <form action="VerificarDuplicados.php" method="post">
			<input type="hidden" name="cod_sct" value="<?php echo $cod_sct;?>">
			<input type="hidden" name="cod_per" value="<?php echo $cod_per;?>">
			
	    	<div class="formulario">
				<table>
					<tr> 
						<td>Nombre:</td>
						<td><input type="text" name="nombre" value="<?php echo $nombre;?>"></td>
					</tr>
					<tr>
						<td>Paterno:</td>
						<td><input type="text" name="paterno" value="<?php echo $paterno;?>"> </td>
					</tr>
					<tr>
						<td>Materno:</td>
						<td><input type="text" name="materno" value="<?php echo $materno;?>"></td>
					</tr>
					<tr>
						<td><button class="button" type="submit" name="Verificar" value="Agregar Persona">Agregar</button></td>
					</tr>		
				</table>
					
			</div>
	    </form>
	</div>
</body>
</html>