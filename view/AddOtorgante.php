<?php
require "../model/AddPersonaClass.php";
//Recoge los valores de la ventana para agregar los nombres a la base de datos
$codEscritura = $_REQUEST['codigoEscritura'];
$codPersonal = $_REQUEST['codigoPersonal'];

$nom_corregido = "TERESA";
$paterno = "QUISPE";
$materno = "C";

$addpersona = new AddPersonaClass();
$datos = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);

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

	$datos = $addpersona->BuscarCompleto($nom_corregido, $paterno, $materno);
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Otorgante</title>
    <link rel="stylesheet" type="text/css" href="./css/formulario.css" />
</head>

<body>
    <form>
        <input type="hidden" name="codigoEscritura" value="<?php echo $codEscritura; ?>" />
        <input type="hidden" name="codigoPersonal" value="<?php echo $codPersonal; ?>" />

        <div class="formulario">
            <h2>Agregar Otorgante</h2>
            <table>
                <tr>
                    <td width="70">Nombres</td>
                    <td><input type="text" name="nombre" placeholder="Escriba el Nombre" required="required"></td>
                </tr>
                <tr>
                    <td>Paterno</td>
                    <td><input type="text" name="paterno" placeholder="Escriba Apellido Paterno" required="required">
                    </td>
                </tr>
                <tr>
                    <td>Materno</td>
                    <td><input type="text" name="materno" placeholder="Escriba Apellido Materno" require="required">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="button" type="submit" name="btnBuscar">Buscar Otorgante</button></td>
                </tr>
            </table>
        </div>
    </form>
    <hr>
    <form action="AddPersonaO.php" method="post" name="frmGuardar" id="frmGuardar">
        <div>
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
                        <a href="AddPersonaO.php?cod_sct=<?php echo $codEscritura; ?>&involucrado=<?php echo $datos['Cod_inv']; ?>&cod_per=<?php echo $codPersonal; ?>"
                            onclick="Confirmar()">Agregar >></a>

                    </td>

                </tr>
	                           
                <?php
						if(empty($datos)){
							#echo "Vacio";
					?>

                <div class="alert">
                    <h4>El nombre no existe. Desea agregarlo a la Base de Datos?</h4>
                    <a
                        href="NewPerson.php?nombre=<?php echo $nombre; ?>&paterno=<?php echo $paterno; ?>&materno=<?php echo $materno; ?>&cod_sct=<?php echo $codEscritura; ?>&cod_per=<?php echo $codPersonal; ?>">
                        PRESIONE AQUI </a>
                </div>
                <?php
				}
	            ?>
            </table>
        </div>
    </form>
</body>

</html>