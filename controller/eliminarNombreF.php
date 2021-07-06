<?php
$cod_inv = $_REQUEST['codigoInvolucrado'];
$cod_sct = $_REQUEST['codigoEscritura'];
echo $cod_inv;
echo $cod_sct;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eliminar</title>
    <script type="text/javascript">
    function Eliminar() {
        if (confirm('¿REALMENTE DESEAS ELIMINAR ESTE NOMBRE A LA ESCRITURA?')) {
            document.frmEliminar.submit();

            alert("Eliminado- Actualizar (F5)");

        } else {
            alert("Cancelado");

        }
    }
    </script>
</head>

<body onload="Eliminar()">
    <form action="ConfirmarEliminar.php" name="frmEliminar" id="frmEliminar">
        <input type="text" name="codigoInvolucrado" value="<?php echo $cod_inv;?>">
        <input type="text" name="codigoEscritura" value="<?php echo $cod_sct;?>">
        <input type="text" name="opcion" value="favorecido">
    </form>

</body>

</html>