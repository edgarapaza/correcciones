<?php //MODO DE VISTA DEL PROTOCOLOS CREADOS CON PROYECTO
session_start();
    
    $codigoPersonal = $_SESSION['administrator'];

	include "../model/EscrituraClassProyecto.php";
    include "../model/CambiarDatos.php";

    $escritura = new EscrituraClassProyecto();

    
    // Recoge el numero de protocolo de la session
	$numeroProyecto = $_SESSION['proyecto'];
		

	$datosproyecto = $escritura->DatosProyecto($numeroProyecto);
	/* Para leer los datos del proyecto
	proy_id 		= 0
	proy_nombre 	= 1
	not_id 			= 2
	num_protocolo 	= 3
	observaciones 	= 4
	estado 			= 5
	*/
	#$codigoEscritura = $_REQUEST['codigoEscritura'];
	#$codigoEscritura = 336665;
	#echo "El codigo enviado es: ".$codigoEscritura;

	$valor1 = $escritura->Escrituras($numeroProyecto);
	#$detalleEscrituras = $escritura->DetalleEscrituras($codigoEscritura);

	$resultado = $escritura->Listado($numeroProyecto);
	/*  VALORES PARA LA VISTA DE LAS ESCRITURAS
	cod_sct = 0
	num_sct = 1
	fec_doc = 2
	cod_sub = 3
	nom_bie = 4
	can_fol = 5
	obs_sct = 6
	num_fol = 7
	cod_usu = 8
	hra_ing = 9
	proy_id = 10
	*/
    	
	$lista = array();

	while($fila = $resultado->fetch_array())
	{
	    $lista[]=$fila[0];
	}

	//Numero total de regsitro del protocolo dentro del array
	$numeroArray = count($lista);

	/*
	 *     TODO EL LISTADO PROVENIENTE DEL ARRAY SE ALMACENA
	 *     EN EL ARRAY LISTA
	 *     Imprimiendo el listado del array
	 *
	for($i=0;$i<=count($lista)-1;$i++){
	   echo $lista[$i]."<br>";
	}
	*/
	$limite= $numeroArray;

	@$cont=$_GET['contador'];

	if ($cont+1 <= $limite && $cont >= 0 && isset($_GET['contador'])){
	    if (isset($_GET['mas'])){
	        $cont++;
	    }
	    if (isset($_GET['menos']) && $cont-1 > 0){
	       $cont--;
	    }
	} else {
	  $cont = 0;
	}

	$detalleEscrituras = $escritura->DetalleEscrituras($lista[$cont]);
    
    /*  LISTADO DE BOTONES PARA CAMBIOS EN EL SISTEMA   */
    if(isset($_POST['btnFolio'])){
        $cambiarDatos = new CambiarDatos();

        $codigoEscritura = $_REQUEST['codigoEscritura'];
        $numeroFolio = $_REQUEST['numeroFolio'];
                
        $cambiarDatos->CambiarFolio($codigoEscritura, $numeroFolio);
        header("Refresh:0");
    }

    if(isset($_POST['btnNumeroEscritura'])){
        $cambiarDatos = new CambiarDatos();

        $codigoEscritura = $_REQUEST['codigoEscritura'];
        $numeroEscritura = $_REQUEST['numeroEscritura'];
                
        $cambiarDatos->CambiarNumeroEscritura($codigoEscritura, $numeroEscritura);
        header("Refresh:0");
    }

    if(isset($_POST['btnCantidadFolios'])){
        $cambiarDatos = new CambiarDatos();

        $codigoEscritura = $_REQUEST['codigoEscritura'];
        $cantidadFolios = $_REQUEST['cantidadFolios'];
                
        $cambiarDatos->CambiarCantidadFolios($codigoEscritura, $cantidadFolios);
        header("Refresh:0");
    }

    if(isset($_POST['btnFechaDocumento'])){
        $cambiarDatos = new CambiarDatos();

        $codigoEscritura = $_REQUEST['codigoEscritura'];
        $fechaDocumento = $_REQUEST['fechaDocumento'];
                
        $cambiarDatos->CambiarFechaDocumento($codigoEscritura, $fechaDocumento);
        header("Refresh:0");
    }

    if(isset($_POST['btnNombreBien'])){
        $cambiarDatos = new CambiarDatos();

        $codigoEscritura = $_REQUEST['codigoEscritura'];
        $nombreBien = $_REQUEST['nombreBien'];
                
        $cambiarDatos->CambiarNombreBien($codigoEscritura, $nombreBien);
        header("Refresh:0");
    }


 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/corecciones.css">
    <title>Correccion de Escrituras</title>
    
    <!-- Latest compiled and minified JavaScript -->
</head>

<body>
    <div class="container-fluid bg-danger">
        <div class="row">
            <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Sistema de Correccion de Escrituras</a>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                
                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="glyphicon glyphicon-th-list"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php">Nuevo Protocolo</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="#" onclick="javascript:window.open('AddOtorgante.php?codigoEscritura=<?php echo $lista[$cont];?>&codigoPersonal=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=YES');">Agregar Otorgante</a>
                        </li>
                        <li>
                            <a href="#" onclick="javascript:window.open('AddFavorecido.php?codigoEscritura=<?php echo $lista[$cont];?>&codigoPersonal=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=YES');"> Agregar Favorecido</a>
                        </li>
                        <li>
                            <a href="#" onclick="javascript:window.open('AddOtorganteJuridico.php?cod_sct=<?php echo $lista[$cont];?>&cod_per=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=NO');"> Agregar Otorgante Juridico</a>
                        </li>
                        <li>
                            <a href="#" onclick="javascript:window.open('AddFavorecidoJuridico.php?cod_sct=<?php echo $lista[$cont];?>&cod_per=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=NO');">Agregar Favorecido Juridico</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../controller/sesionClose.php">Salir</a></li>
                    </ul>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
            </nav>
        </div>

        <div class="row">
            <div class="col-md-6">
                <span class="etiquetas"><?php echo $lista[$cont];?></span>
            </div>
            <div class="col-md-5">
                <p>Numero de Escrituras: <span class="header-text"><?php echo $numeroArray; ?></span>  | Numero de Protocolo: <span class="header-text"><?php echo $datosproyecto[3]; ?></span></p>
            </div>
        </div>

    </div>

    <div class="container-fluid bg-info">
        <div class="row">
            <div class="col-md-1">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input name="mas" type="submit" value="Next >>">
                    <?php echo $cont ?>
                    <input name="menos" type="submit" value="Ant. <<">
                    <input type="hidden" name="contador" value="<?php echo $cont ?>">
                </form>
            </div>

            <div class="col-md-3">
                <em>Sistema de Revision de Protocolos</em>
                <form action="" method="post">
                    <input type="hidden" name="codigoPersonal" value="<?php echo $codigoPersonal;?>" />
                    <input type="hidden" name="codigoEscritura" value="<?php echo $lista[$cont];?>" />
                    <table>
                        <tr>
                            <td>Folio:</td>
                            <td><input type="text" name="numeroFolio" value="<?php echo $detalleEscrituras[7]; ?>"
                                    class="form-control" /></td>
                            <td>
                                <button class="btn btn-primary" type="submit" name="btnFolio" id="btnFolio"><span class="glyphicon glyphicon-ok-circle"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Escritura:</td>
                            <td><input type="text" name="numeroEscritura" value="<?php echo $detalleEscrituras[1];?>"
                                    class="form-control" />
                            </td>
                            <td>
                            <button class="btn btn-primary" type="submit" name="btnNumeroEscritura" id="btnNumeroEscritura"><span class="glyphicon glyphicon-ok-circle"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Folios:</td>
                            <td><input type="text" name="cantidadFolios" value="<?php echo $detalleEscrituras[5];?>"
                                    class="form-control" />
                            </td>
                            <td>
                            <button class="btn btn-primary" type="submit" name="btnCantidadFolios" id="btnCantidadFolios"><span class="glyphicon glyphicon-ok-circle"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha:</td>
                            <td><input type="date" name="fechaDocumento" value="<?php echo $detalleEscrituras[2];?>"
                                    class="form-control" />
                            </td>
                            <td>
                            <button class="btn btn-primary" type="submit" name="btnFechaDocumento" id="btnFechaDocumento"><span class="glyphicon glyphicon-ok-circle"></span></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-8">
                <table>
                    <tr>
                        <th width="90%">Datos de la Escritura</th>
                        <th width="10%">Opc</th>
                    </tr>

                    <?php
						//echo "Otorgantes -----------------------------------------------
                        $dataOtorgantes = $escritura->ListadoOtorgantes($detalleEscrituras[0]);
                        
						while($filao = $dataOtorgantes->fetch_array(MYSQLI_ASSOC))
						{
							if($filao['cod_inv'] != 0)
							{
								$nombre = $escritura->VerNombre($filao['cod_inv']);
								
                    ?>

                    <tr class="bg-danger">
                        <td>
                            <span class="etiquetas">Otorgantes <br> </span>
                            <?php echo $nombre['nombre'];?>
                        </td>
                        <td>
                            <button name="boton1" class="btn btn-primary" type="button" onclick="javascript:window.open('./modificarNombres.php?cod_usu=<?php echo $filao['cod_inv'];?>','','width=800, height=500, scrollbars=YES');"> <span class="glyphicon glyphicon-edit"></span> </button>
                            <button name="boton1" class="btn btn-danger" type="button" onclick="javascript:window.open('../controller/eliminarNombre.php?codigoInvolucrado=<?php echo $filao['cod_inv'];?>&codigoEscritura=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');"> <span class="glyphicon glyphicon-trash"></span> </button>
                        </td>
                        
                    </tr>
                    <?php
							echo "<br>";
							}
						}
                        ?>
                    
                    <?php

					    $dataFavorecidos = $escritura->ListadoFavorecido($detalleEscrituras[0]);

                          while($filaf = $dataFavorecidos->fetch_array())
					          {
								  if($filaf['cod_inv'] != 0)
					              {
								  	$nombre = $escritura->VerNombre($filaf['cod_inv']);
                    ?>

                    <tr class="bg-success">
                        <td>
                            <span class="etiquetas">Favorecido</span> <br>
                            <?php echo $nombre['nombre'];?>
                        </td>
                        <td>
                            <button name="boton1" class="btn btn-primary" type="button" onclick="javascript:window.open('./modificarNombres.php?cod_usu=<?php echo $filaf['cod_inv'];?>','','width=800, height=500, scrollbars=YES');"><span class="glyphicon glyphicon-edit"></span></button>
                            <button name="boton2" class="btn btn-danger" type="button" onclick="javascript:window.open('../controller/eliminarNombreF.php?codigoInvolucrado=<?php echo $filaf['cod_inv'];?>&codigoEscritura=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');"><span class="glyphicon glyphicon-trash"></span></button>
                            
                        </td>
                    </tr>
                    <?php
					            echo "<br>";
					              }
					          }
                    ?>
                        
                        <?php
				            //echo "Otorgantes Juridicos---------------------------------------------------";
				          	$dataOtorgantes = $escritura->ListadoOtorgantes($detalleEscrituras[0]);

				            while($filaoj = $dataOtorgantes->fetch_array())
				            {
				                if($filaoj['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaoj['cod_inv_ju']);
									
				                
                        ?>

                    <tr>
                        <td>
                            <span class="etiquetas">Otorgantes Juridicos</span><br>
                            <?php echo $nombreJuridico['razon_social'];?>
                        </td>

                        <td>
                            <button name="boton1" class="btn btn-primary" type="button" onclick="javascript:window.open('./modificarNombresJuridicos.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');"> <span class="glyphicon glyphicon-edit"></span></button>
                            <button name="boton1" class="btn btn-danger" type="button" onclick="javascript:window.open('../controller/eliminarJuridicoO.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>&cod_sct=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');"> <span class="glyphicon glyphicon-trash"></span> </button>
                        </td>
                    
                    </tr>
                    <?php
                            }
                        }
                    ?>

                    <?php
				            //echo "Favorecidos Juridicos-------------------------------------
				            $dataFavorecidos = $escritura->ListadoFavorecido($detalleEscrituras[0]);

				            while($filaf = $dataFavorecidos->fetch_array())
				            {
				                if($filaf['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaf['cod_inv_ju']);
									
				                
                    ?>
                    
                    <tr>
                        <td>
                            <span class="etiquetas"> Favorecidos Juridicos</span><br>
                            <?php echo $nombreJuridico['razon_social'];?>
                        </td>
                        <td>
                            
                            <button name="boton1" class="btn btn-primary" type="button" onclick="javascript:window.open('./modificarNombresJuridicos.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');"> <span class="glyphicon glyphicon-edit"></span></button>
                            <button name="boton1" class="btn btn-danger" type="button" onclick="javascript:window.open('../controller/eliminarJuridicoF.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>&cod_sct=<?php echo $lista[$cont];?>','','width=600, height=600, scrollbars=NO');"> <span class="glyphicon glyphicon-trash"></span> </button>
                            
                        </td>
                    </tr>
                    <?php
				                echo "<br>";
				                }
				            }
				          ?>
                </table>
            </div>
        </div>

        <div class="part2">
            <div class="center">
            <form action="" method="post">
                <input type="hidden" name="codigoPersonal" value="<?php echo $codigoPersonal;?>" />
                <input type="hidden" name="codigoEscritura" value="<?php echo $lista[$cont];?>" />

                <table>
                    <tr>
                        <td>Nombre de Bien: *</td>
                        <td>
                            <input type="text" name="nombreBien" value="<?php echo $detalleEscrituras[4];?>" size="150" />
                            <button class="btn btn-primary" type="submit" name="btnNombreBien" id="btnNombreBien"><span class="glyphicon glyphicon-ok-circle"></span></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sub Serie: *</td>
                        <td>
                            <?php 
                                $subserie = $escritura->VerSubserie($detalleEscrituras[3]);
								echo $subserie['subserie'];
                            ?>
                            <button class="btn btn-primary" type="submit" name="btnSubSerie" id="btnSubSerie" onclick="javascript:window.open('CambiarSubserie.php?cod_sct=<?php echo $detalleEscrituras[0];?>','','width=800, height=500, scrollbars=YES');"><span class="glyphicon glyphicon-ok-circle"></span></button>
                            
                    </tr>
                    <tr>
                        <td>Notario</td>
                        <td>
                            <?php 
												$notario = $escritura->VerNotario($datosproyecto[2]);
												echo $notario['notario'];
											?>
                        </td>
                    </tr>
                    <tr>
                        <td>Distrito:</td>
                        <td>
                            <?php
													$distrito = $escritura->VerDistrito($datosproyecto[2]);
													echo $distrito['des_dst'];
												?>
                        </td>
                    </tr>

                    <tr>
                        <td>Codigo Trabajador:</td>
                        <td>
                            <?php 
													$trabajador = $escritura->VerTrabajador($detalleEscrituras[8]);
													echo $trabajador['trabajador'];
												?>
                        </td>
                    </tr>
                    <tr>
                        <td>Hora Ingreso:</td>
                        <td><?php echo $detalleEscrituras[9];?></td>
                    </tr>
                    <tr>
                        <td>Numero de Proyecto:</td>
                        <td><?php echo $datosproyecto[0];?></td>
                    </tr>
                    <tr>
                        <td>Observaciones:</td>
                        <td><?php echo $detalleEscrituras[6];?></td>
                    </tr>
                    <tr>
                        <td>Observaciones del Libro:</td>
                        <td><?php echo $datosproyecto[4];?></td>
                    </tr>

                </table>
            </form>
        </div>
        
    </div>

    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.js"></script>
    
</body>
</html>