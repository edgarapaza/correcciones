<?php
$codEscritura = $_REQUEST['cod_sct'];
$codPersonal = $_REQUEST['cod_per'];

if(isset($_REQUEST['btnBuscar']))
{
	$razon = $_REQUEST['razonsocial'];
	
        $nexo = "%";
	$sinEspacios = trim($razon);
	$nom_temp = explode(" ", $sinEspacios);
	$razonSocial = implode($nexo, $nom_temp);

	require '../model/AddPersonaClass.php';

	$obj = new AddPersonaClass();
	$result = $obj->BuscarJuridico($razonSocial);
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Agregar Otorgante Juridico</title>
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
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="" method="get">
        <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
        <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />
		
		<div class="formulario">
			<div class="formulario">
				<ul>
					<li><h2>Agregar Otorgante Juridico</h2>
						<span class="required">Datos requeridos</span>
					</li>
					<li> <label for="name">Razon Social:</label> <input type="text" name="razonsocial" placeholder="Escriba la Razon Social de la empresa o institucion" required="required" size="80" /> </li>
					<li> <button class="submit" type="submit" name="btnBuscar" value="Buscar">Buscar Otorgante Juridico</button>
				</ul>
		</div>
	</form>

    <form action="AddPersonaJuridicaO.php" method="post" name="frmGuardar" id="frmGuardar">
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
					<td><?php echo $fila['Raz_inv'];?></td>
		                        <td>
		                            <input type="hidden" name="codigojuridico" value="<?php echo $fila['Cod_inv']; ?>" />
		                            <input type="hidden" name="cod_sct" value="<?php echo $codEscritura; ?>" />
		                            <input type="hidden" name="cod_per" value="<?php echo $codPersonal; ?>" />
		                            
		                            <a href="AddPersonaJuridicaO.php?cod_sct=<?php echo $codEscritura; ?>&codigojuridico=<?php echo $fila['Cod_inv']; ?>&cod_per=<?php echo $codPersonal; ?>">Agregar >></a>
		                            
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