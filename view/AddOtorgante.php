<?php
require "../model/AddPersonaClass.php";

$codEscritura = $_REQUEST['cod_sct'];
$codPersonal = $_REQUEST['cod_per'];
$nom_corregido = "TERESA";
$paterno = "QUISPE";
$materno = "C";

$addpersona = new AddPersonaClass();
$data = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);

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

	$data = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);
	/*if($materno != null)
	{
		$data = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);
		
	}else
	{
		$data = $addpersona->BuscarNombre($nom_corregido, $paterno);
		
	}
	*/
            
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Agregar Otorgante</title>
</head>
<body>
    <form>
        <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
        <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />

        <div class="formulario">
            <ul>
                <li>
                    <h2>Agregar Otorgante</h2>
                    <span class="required">Datos requeridos</span>
                </li>
                <li> <label for="name">Nombres:</label> <input type="text" name="nombre" placeholder="Escriba el Nombre"
                        required="required"> </li>
                <li> <label for="name">Paterno:</label> <input type="text" name="paterno"
                        placeholder="Escriba Apellido Paterno" required="required"></li>
                <li> <label for="name">Materno:</label> <input type="text" name="materno"
                        placeholder="Escriba Apellido Materno"> </li>
                <li> <button class="submit" type="submit" name="btnBuscar" value="Buscar">Buscar Otorgante</button>
            </ul>
        </div>
    </form>

    <form action="AddPersonaO.php" method="post" name="frmGuardar" id="frmGuardar">
        <div class="CSSTableGenerator">
            <table width="600">
                <tr>
                    <td>Nombre</td>
                    <td>Apellido Paterno</td>
                    <td>Apellido Materno</td>
                    <td>Opciones</td>
                </tr>
				<?php
					while($fila = $data->fetch_array(MYSQLI_ASSOC))
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
                        <a href="AddPersonaO.php?cod_sct=<?php echo $codEscritura; ?>&involucrado=<?php echo $fila['Cod_inv']; ?>&cod_per=<?php echo $codPersonal; ?>"
                            onclick="Confirmar()">Agregar >></a>

                    </td>

                </tr>
                <?php
	                                }
	                                if($data->num_rows == 0)  
	                                {
	                                    echo "El nombre NOOOOOO existe.";
	                                ?>
                <p>El nombre no existe. Desea Agregarlo a la Base de Datos.</p> <a
                    href="NewPerson.php?nombre=<?php echo $nombre; ?>&paterno=<?php echo $paterno; ?>&materno=<?php echo $materno; ?>&cod_sct=<?php echo $codEscritura; ?>&cod_per=<?php echo $codPersonal; ?>">
                    PRESIONE AQUI </a>
                <?php
					}
	            ?>
            </table>
        </div>
    </form>
</body>

</html>