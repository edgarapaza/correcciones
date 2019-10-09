<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Ingrese el Protocolo</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
</head>
<body>

    <div class="container bg-success">
        <div class="row">
            <div class="col-md-8">
                <h2>Revision de protocolos</h2>
                <em>IMPORTANTE: Protocolos de Proyectos a partir del PROTOCOLO 2612 EN ADELANTE</em>
                <h3>Ingrese el Numero de Protocolo a Revisar</h3>

                <form action="../controller/protocolos.php" method="post">
                    <div class="formulario">
                        <label for="name">Numero de Protocolo:</label>
                        <input type="text" name="protocolo" class="form-control" placeholder="Numero de Protocolo">
                        <button class="btn btn-success" type="submit" name="revisar">Comenzar Revision</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <p></p>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/npm.js"></script>
</body>
</html>


