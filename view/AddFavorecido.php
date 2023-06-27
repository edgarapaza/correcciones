<?php
require '../model/AddPersonaClass.php';
$codEscritura = $_REQUEST['codigoEscritura'];
$codPersonal = $_REQUEST['codigoPersonal'];

$addpersona = new AddPersonaClass();
//$datos = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);

if(isset($_REQUEST['btnBuscar']))
{
	
	$nombre   = $_REQUEST['nombre'];
	$paterno1 = $_REQUEST['paterno'];
	$materno1 = $_REQUEST['materno'];

	if(empty($nombre) && empty($paterno1) && empty($materno1)){
		$nom_corregido = "%";
		$datos = $addpersona->BuscarCompleto($nom_corregido,'','');
	}else{
		echo "nombre envoado";
		$nexo          = "%";
		$sinEspacios   = trim($nombre);
		$nom_temp      = explode(" ", $sinEspacios);
		$nom_corregido = implode($nexo, $nom_temp);

		$paterno = trim($paterno1);
		$materno = trim($materno1);

		$datos = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);
	}

	
	/*
	if($materno != null)
	{
	    $result = $obj->BuscarCompleto($nom_corregido, $paterno, $materno);
	}else
	{
	    $result = $obj->BuscarNombre($nom_corregido, $paterno);
	}
	*/
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Agregar Favorecido</title>
	<link rel="stylesheet" type="text/css" href="./css/formulario.css"/>
</head>
<body>
	<form>
        <input type="hidden" name="codigoEscritura" value="<?php echo $codEscritura; ?>" />
        <input type="hidden" name="codigoPersonal" value="<?php echo $codPersonal; ?>" />
		<div class="formulario">
            <h2>Agregar Favorecido</h2>
            <table class="table">
                <tr>
                    <td>Nombres</td>
                    <td><input type="text" name="nombre" placeholder="Escriba el Nombre"></td>
                </tr>
                <tr>
                    <td>Paterno</td>
                    <td><input type="text" name="paterno" placeholder="Escriba Apellido Paterno"></td>
                </tr>
                <tr>
                    <td>Materno</td>
                    <td><input type="text" name="materno" placeholder="Escriba Apellido Materno"></td>
                </tr>
                <tr>
                    <td><button class="button" type="button" name="btnCancelar" >Cancelar</button></td>
                    <td><button class="button" type="submit" name="btnBuscar" >Buscar Persona</button></td>
                </tr>
            </table>
        </div>
	
	</form>

    <form action="AddPersonaF.php" method="post" name="frmGuardar" id="frmGuardar">
	<div class="CSSTableGenerator" >
		<table width="600" class="imagetable">
			<tr>
				<th>Nombre</th>
				<th>Apellido Paterno</th>
				<th>Apellido Materno</th>
				<th width="80">Opciones</th>
			</tr>
				
			<tr>
				<td><?php echo $datos['Nom_inv'];?></td>
				<td><?php echo $datos['Pat_inv'];?></td>
				<td><?php echo $datos['Mat_inv'];?></td>
				<td>
	             	<input type="hidden" name="involucrado" value="<?php echo $datos['Cod_inv']; ?>" />
	                <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
	                <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />
	                <a href="AddPersonaF.php?codigoEscritura=<?php echo $codEscritura; ?>&codigoInvolucrado=<?php echo $datos['Cod_inv']; ?>&codigoPersonal=<?php echo $codPersonal; ?>" onclick="Confirmar()">Agregar >></a>            
	            </td>
	            </tr>
					<?php
						if(empty($datos)){
							#echo "Vacio";
					?>
						<div class="alert">
							<h4>El nombre no existe.  Desea agregarlo a la Base de Datos?</h4>
							<a href="NewPerson_f.php?nombre=<?php echo $nombre; ?>&paterno=<?php echo $paterno; ?>&materno=<?php echo $materno; ?>&cod_sct=<?php echo $codEscritura; ?>&cod_per=<?php echo $codPersonal; ?>"> PRESIONE AQUI </a>
						</div>
					<?php						
						}
					?>

		</table>
	</div>
	</form>
	
</body>
</html>