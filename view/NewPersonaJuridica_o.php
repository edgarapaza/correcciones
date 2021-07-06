<?php
$razonsocial = strtoupper(trim($_REQUEST['razonsocial']));

$cod_sct = $_REQUEST['cod_sct'];
$cod_per = $_REQUEST['cod_per'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Persona</title>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <link rel="stylesheet" href="./css/formulario.css" />
</head>

<body>
    <div>
        <form action="../controller/VerificarDuplicadosJuridicos_o.php" method="post">
            <input type="hidden" name="cod_sct" value="<?php echo $cod_sct;?>">
            <input type="hidden" name="cod_per" value="<?php echo $cod_per;?>">
            <div class="formulario">
                <table class="imagetable">
                    <tr>
                        <td>Razon social:</td>
                        <td><input type="text" name="razonsocial" value="<?php echo $razonsocial;?>"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><button class="btn btn-success" type="submit" name="Verificar">Agregar Juridicos
                                Favorecido</button>
                        </td>

                    </tr>
                </table>
            </div>
        </form>
    </div>
</body>

</html>