<?php
require '../model/AddPersonaClass.php';

$obj = new AddPersonaClass();

$razonSocial = "oro nuevo";

$result = $obj->BuscarJuridico($razonSocial);

$codEscritura = $_REQUEST['cod_sct'];
$codPersonal = $_REQUEST['cod_per'];
$razonsocial = $_REQUEST['razonsocial'];

if(isset($_REQUEST['btnBuscar']))
{
	$razon = $_REQUEST['razonsocial'];
    $obj = new AddPersonaClass();
    
    $nexo = "%";
	$sinEspacios = trim($razon);
	$nom_temp = explode(" ", $sinEspacios);
	$razonSocial = implode($nexo, $nom_temp);

	$result = $obj->BuscarJuridico($razonSocial);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Otorgante Juridico</title>
    <script type="text/javascript">
    function Guardar() {
        if (confirm('¿REALMENTE DESEAS AGREGAR ESTA INSTITUCION?')) {
            document.frmGuardar.submit();
            alert("Datos Guardados");
        } else {
            alert("Cancelado");
        }
    }
    </script>
    <link rel="stylesheet" type="text/css" href="css/bootstarp.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>

<body>
    <form action="" method="get">
        <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
        <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />

        <div>
            <div class="formulario">
                <h2>Agregar Otorgante Juridico</h2>
                <span >Datos requeridos</span>
                <label for="name">Razon Social:</label>
                <input type="text" name="razonsocial" placeholder="Nombre de Razon Social de la empresa o institucion" required="required" size="80" />
                <button type="submit" name="btnBuscar" class="btn btn-primary">Buscar Otorgante Juridico</button>
            </div>
    </form>

    <form action="AddPersonaJuridicaO.php" method="post" name="frmGuardar" id="frmGuardar">
        <div class="CSSTableGenerator">
            <table class="imagetable" width="600">
                <tr>
                    <th>Nombre</th>
                    <th width="80">Opciones</th>
                </tr>
                <?php
		        while($fila = $result->fetch_assoc())
		        {
		        ?>
                <tr>
                    <td><?php echo $fila['Raz_inv'];?></td>
                    <td>
                        <input type="hidden" name="codigojuridico" value="<?php echo $fila['Cod_inv']; ?>" />
                        <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
                        <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />

                        <a
                            href="AddPersonaJuridicaO.php?cod_sct=<?php echo $codEscritura; ?>&codigojuridico=<?php echo $fila['Cod_inv']; ?>&cod_per=<?php echo $codPersonal; ?>">Agregar
                            >></a>

                    </td>

                </tr>
                <?php
		        }
				if($result->num_rows == 0)
                {
				?>
				<div class="alert">
					<h4>El nombre no existe.  Desea agregarlo a la Base de Datos?</h4>
					<a href="NewPersonaJuridica_o.php?razonsocial=<?php echo $razonsocial; ?>&cod_sct=<?php echo $codEscritura; ?>&cod_per=<?php echo $codPersonal; ?>"> PRESIONE AQUI </a>
				</div>
	            <?php } ?>
            </table>
        </div>
    </form>

</body>

</html>