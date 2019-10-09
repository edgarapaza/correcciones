<?php
require "../model/AddPersonaClass.php";
//Recoge los valores de la ventana para agregar los nombres a la base de datos
$codEscritura = $_REQUEST['codigoEscritura'];
$codPersonal = $_REQUEST['codigoPersonal'];

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
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Otorgante</title>
    <link rel="stylesheet" type="text/css" src="../css/bootstrap.css" />
    <style>
        body{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 16px;
        }
        .formulario{
            background-color: #d5ebfd;
        }
        .formulario table{
            width: 100%;
            border: 1px solid #000;
        }
        .formulario input{
            background-color: #e8e8e8;
            padding: 5px;
            width: 90%;
            border-radius: 5px;
            font-size: 1em;
        }
        .button{
            background-color: #378ed6;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px;
        }
        table.imagetable {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #999999;
            border-collapse: collapse;
        }
        table.imagetable th {
            background:#378ed6;
            color: white;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #999999;
        }
        table.imagetable td {
            background:#dcddc0 url('cell-grey.jpg');
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #999999;
        }

    </style>
</head>
<body>
    <form>
        <h1>aqui</h1>
        <input type="text" name="cod_sct" value="<?php echo $codEscritura; ?>" />
        <input type="text" name="cod_per" value="<?php echo $codPersonal; ?>" />

        <div class="formulario">
            <h2>Agregar Otorgante</h2>
            <table class="table">
                <tr>
                    <td>Nombres</td>
                    <td><input type="text" name="nombre" placeholder="Escriba el Nombre"
                        required="required"></td>
                </tr>
                <tr>
                    <td>Paterno</td>
                    <td><input type="text" name="paterno"
                        placeholder="Escriba Apellido Paterno" required="required"></td>
                </tr>
                <tr>
                    <td>Materno</td>
                    <td><input type="text" name="materno"
                        placeholder="Escriba Apellido Materno" require="required"></td>
                </tr>
                <tr>
                    <td><button class="button" type="button" name="btnCancelar" >Cancelar</button></td>
                    <td><button class="button" type="submit" name="btnBuscar" >Buscar Otorgante</button></td>
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