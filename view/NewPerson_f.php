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
	<link rel="stylesheet" href="css/styleform.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="general">
            <form action="VerificarDuplicados_f.php" method="post">
	    	<div class="formulario">
				<ul>
					<li><h2>Agregar Persona</h2></li>
					<li> <label for="name">Nombres:</label> <input type="text" name="nombre" value="<?php echo $nombre;?>"></li>
					<li> <label for="name">Paterno:</label> <input type="text" name="paterno" value="<?php echo $paterno;?>"> </li>
					<li> <label for="name">Materno:</label> <input type="text" name="materno" value="<?php echo $materno;?>"> </li>
					<li> <button class="submit" type="submit" name="Verificar" value="Agregar Persona">Agregar</button></li>
					<input type="hidden" name="cod_sct" value="<?php echo $cod_sct;?>">
	                <input type="hidden" name="cod_per" value="<?php echo $cod_per;?>">
				</ul>
			</div>
	    </form>
	</div>
</body>
</html>