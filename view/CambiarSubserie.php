<?php
$codEscritura = $_REQUEST['cod_sct'];

if(isset($_REQUEST['btnBuscar']))
{
	$subserie = $_REQUEST['subserie'];
	
                $nexo = "%";
	$sinEspacios = trim($subserie);
	$nom_temp = explode(" ", $sinEspacios);
	$nombresubserie = implode($nexo, $nom_temp);

	require '../model/ChangeSubserieClass.php';

	$obj = new ChangeSubserieClass();
	$result = $obj->ListadoSubseries($nombresubserie);
	
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Agregar Otorgante</title>
        <script type="text/javascript">
            function Guardar()
            {
                if (confirm('¿REALMENTE DESEAS AGREGAR ESTA INSTITUCION?')) {
                    document.frmGuardar.submit();
                    alert("Datos Guardados");
                } else {
                    alert("Cancelado");
                }
            }
        </script>
        <link rel="stylesheet" href="css/styleform.css">
		<link rel="stylesheet" href="css/styletable.css">
</head>
<body>
	<form action="" method="get">
            <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
        <div class="formulario">
			<div class="formulario">
				<ul>
					<li><h2>Modificar Serie</h2>
						<span class="required">Datos requeridos</span>
					</li>
					<li> <label for="name">Sub Serie:</label> <input type="text" name="subserie" placeholder="Escriba la sub serie de la escritura" required="required" size="80" /></li>
					<li> <button class="submit" type="submit" name="btnBuscar" value="Buscar">Buscar Serie</button>
				</ul>
		</div>
	</form>

    <form action="" method="post" name="frmGuardar" id="frmGuardar">
	<div class="CSSTableGenerator" >
			<table border="1" width="600">
		            
		            
				<tr>
					<td>Nombre</td>
					<td>Opciones</td>
				</tr>
		                                <?php
		                                while($fila = $result->fetch_assoc())
		                                {
		                                ?>
				<tr>
					<td><?php echo $fila['des_sub'];?></td>
		                        <td>
		                            <input type="hidden" name="codigojuridico" value="<?php echo $fila['cod_sub']; ?>" />
		                            <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
		                            
		                      
		                            <a href="SaveSubserie.php?cod_sct=<?php echo $codEscritura; ?>&codigoSubserie=<?php echo $fila['cod_sub']; ?>">Cambiar</a>
		                            
		                        </td>
		                        
				</tr>
		                                 <?php
		                                }

		                                ?>
			</table>
	</div>
    </form>
</body>
</html>