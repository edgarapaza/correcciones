<?php
$codEscritura = $_REQUEST['cod_sct'];
$codPersonal = $_REQUEST['cod_per'];

if(isset($_REQUEST['btnBuscar']))
{
	$nombre = $_REQUEST['nombre'];
	$paterno1 = $_REQUEST['paterno'];
	$materno1 = $_REQUEST['materno'];

	$nexo = "%";
	$sinEspacios = trim($nombre);
	$nom_temp = explode(" ", $sinEspacios);
	$nom_corregido = implode($nexo, $nom_temp);

	$paterno = trim($paterno1);
	$materno = trim($materno1);

	require '../model/AddPersonaClass.php';

	$obj = new AddPersonaClass();
	if($materno != null)
	{
	    $result = $obj->BuscarCompleto($nom_corregido, $paterno, $materno);
	}else
	{
	    $result = $obj->BuscarNombre($nom_corregido, $paterno);
	}
        
        
        
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Agregar Otorgante</title>
	<link rel="stylesheet" href="css/styleform.css">
	<link rel="stylesheet" href="css/styletable.css">
</head>
<body>
		<form>
			<input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
            <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />
			
			<div class="formulario">
				<ul>
					<li><h2>Agregar Otorgante</h2>
						<span class="required">Datos requeridos</span>					</li>
					<li> <label for="name">Nombres:</label> <input type="text" name="nombre" placeholder="Escriba el Nombre" required="required"> </li>
					<li> <label for="name">Paterno:</label> <input type="text" name="paterno" placeholder="Escriba Apellido Paterno" required="required"></li>
					<li> <label for="name">Materno:</label> <input type="text" name="materno" placeholder="Escriba Apellido Materno" > </li>
					<li> <button class="submit" type="submit" name="btnBuscar" value="Buscar">Buscar Otorgante</button>
				</ul>
			</div>
		</form>

    <form action="AddPersonaO.php" method="post" name="frmGuardar" id="frmGuardar">
	<div class="CSSTableGenerator" >
		<table border="1" width="600">      
			<tr>
				<td>Nombre</td>
				<td>Apellido Paterno</td>
				<td>Apellido Materno</td>
				<td>Opciones</td>
			</tr>
	                                <?php
	                                while($fila = $result->fetch_assoc())
	                                {
	                                ?>
			<tr>
				<td><?php echo $fila['Nom_inv'];?></td>
				<td><?php echo $fila['Pat_inv'];?></td>
				<td><?php echo $fila['Mat_inv'];?></td>
	                        <td>
	                            <input type="hidden" name="involucrado" value="<?php echo $fila['Cod_inv']; ?>" />
	                            <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
	                            <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />
	                            <a href="AddPersonaO.php?cod_sct=<?php echo $codEscritura; ?>&involucrado=<?php echo $fila['Cod_inv']; ?>&cod_per=<?php echo $codPersonal; ?>" onclick="Confirmar()">Agregar >></a>
	                            
	                        </td>
	                        
			</tr>
	                                  <?php
	                                }
	                                if($result->num_rows == 0)  
	                                {
	                                    echo "El nombre NOOOOOO existe.";
	                                ?>
	                                <p>El nombre no existe. Desea Agregarlo a la Base de Datos.</p> <a href="NewPerson.php?nombre=<?php echo $nombre; ?>&paterno=<?php echo $paterno; ?>&materno=<?php echo $materno; ?>&cod_sct=<?php echo $codEscritura; ?>&cod_per=<?php echo $codPersonal; ?>"> PRESIONE AQUI </a>
	                                <?php
	                                
	                                }
	                                ?>
		</table>
    </div>   
    </form>
</body>
</html>