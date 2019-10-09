<?php //MODO DE VISTA DEL PROTOCOLOS CREADOS CON PROYECTO
session_start();
    
    $codigoPersonal = $_SESSION['administrator'];
    echo "CODIGO DE PERSONAL: ".$codigoPersonal;

	include "../model/EscrituraClassProyecto.php";

	// Recoge el numero de protocolo de la session
	$numeroProyecto = $_SESSION['proyecto'];
	
	$escritura = new EscrituraClassProyecto();

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
    <title>Correccion de Escrituras</title>
</head>

<body>
    <div class="container-fluid bg-danger">
        <div class="row">
            <div class="col-md-8">
                <h1>Sistema de Correccion de Escrituras</h1>

            </div>
            <div class="col-md-4">
                <br>
                <a href="../index.php" class="btn btn-danger">Nuevo Protocolo</a>
                <p>Numero de Datos:<?php echo $numeroArray; ?></p>
                <p>Numero de Protocolo <?php echo $datosproyecto[3]; ?></p>
            </div>
        </div>

    </div>

    <br>

    <div class="container-fluid bg-info">
        <div class="row">
            <div class="col-md-1">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input name="mas" type="submit" value="Siguiente>>">
                    <?php echo $cont ?>
                    <input name="menos" type="submit" value="Anterior<<">
                    <input type="hidden" name="contador" value="<?php echo $cont ?>">
                </form>
            </div>

            <div class="col-md-3">

                <em>Sistema de Revision de Protocolos</em>


                <form action="CambiarDatos.php" method="post" class="form-group">
                    <table>
                        <tr>
                            <td>Folio:</td>
                            <td><input type="text" name="numeroFolio" value="<?php echo $detalleEscrituras[7]; ?>"
                                    class="form-control" /></td>
                            <td>
                                <button>x</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Escritura:</td>
                            <td><input type="text" name="numeroEscritura" value="<?php echo $detalleEscrituras[1];?>"
                                    class="form-control" />
                            </td>
                            <td>
                                <button>x</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Folios:</td>
                            <td><input type="text" name="cantidadFolios" value="<?php echo $detalleEscrituras[5];?>"
                                    class="form-control" />
                            </td>
                            <td>
                                <button>x</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha:</td>
                            <td><input type="date" name="fechaDocumento" value="<?php echo $detalleEscrituras[2];?>"
                                    class="form-control" />
                            </td>
                            <td>
                                <button>x</button>
                            </td>
                        </tr>
                        
                    </table>
                    <input type="hidden" name="codigoPersonal" value="<?php echo $codigoPersonal;?>" />
                    <input type="hidden" name="codigoEscritura" value="<?php echo $lista[$cont];?>" />
                </form>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <caption>Otorgantes</caption>
                    <tr>
                        
                        <td>
                            <?php
						//echo "Otorgantes -----------------------------------------------------<br>";
						$dataOtorgantes = $escritura->ListadoOtorgantes($detalleEscrituras[0]);

						while($filao = $dataOtorgantes->fetch_array(MYSQLI_ASSOC))
						{
							if($filao['cod_inv'] != 0)
							{
								$nombre = $escritura->VerNombre($filao['cod_inv']);
								
						?>
                            <ul>
                                <li>
                                    
                                    <?php echo $nombre['nombre'];?> <button name="boton1" class="btn btn-success" type="button"
                                    onclick="javascript:window.open('./modificarNombres.php?cod_usu=<?php echo $filao['cod_inv'];?>','','width=800, height=500, scrollbars=YES');"> lapiz</button>
                                    
                                    <button name="boton1" class="btn btn-success" type="button"
                                    onclick="javascript:window.open('../controller/eliminarNombre.php?codigoInvolucrado=<?php echo $filao['cod_inv'];?>&codigoEscritura=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');">X</button>
                                    
                                </li>
                            </ul>

                            

                            <?php
							echo "<br>";
							}
						}

					       ?>
                        </td>
                        <td></td>
                        <td>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('AddOtorgante.php?codigoEscritura=<?php echo $lista[$cont];?>&codigoPersonal=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=YES');">Agregar
                                Otorgante</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Favorecidos</td>
                        <td>
                            <?php

					          $dataFavorecidos = $escritura->ListadoFavorecido($detalleEscrituras[0]);

					          while($filaf = $dataFavorecidos->fetch_array())
					          {
								  if($filaf['cod_inv'] != 0)
					              {
								  	$nombre = $escritura->VerNombre($filaf['cod_inv']);
									echo $nombre['nombre'];
									

					          ?>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('./modificarNombres.php?cod_usu=<?php echo $filaf['cod_inv'];?>','','width=800, height=500, scrollbars=YES');">Corregir
                                Nombre</button>
                            <button name="boton2" class="btn btn-success" type="button"
                                onclick="javascript:window.open('../controller/eliminarNombreF.php?codigoInvolucrado=<?php echo $filaf['cod_inv'];?>&codigoEscritura=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');">X</button>
                            <?php
					            echo "<br>";
					              }
					          }

					        ?>
                        </td>

                        <td>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('AddFavorecido.php?codigoEscritura=<?php echo $lista[$cont];?>&codigoPersonal=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=YES');">
                                Agregar Favorecido</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Otorgantes Juridicos</td>
                        <td>
                            <?php
				            //echo "Otorgantes Juridicos-----------------------------------------------------<br>";
				          	$dataOtorgantes = $escritura->ListadoOtorgantes($detalleEscrituras[0]);

				            while($filaoj = $dataOtorgantes->fetch_array())
				            {
				                if($filaoj['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaoj['cod_inv_ju']);
									echo $nombreJuridico['razon_social'];
				                
				            ?>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('./modificarNombresJuridicos.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');">Corregir
                                Nombre</button>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('../controller/eliminarJuridicoO.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>&cod_sct=<?php echo $lista[$cont];?>','','width=500, height=200, scrollbars=NO');">
                                X </button>
                            <?php
				                echo "<br>";
				                }
				            }
				          ?>
                        </td>
                        <td>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('AddOtorganteJuridico.php?cod_sct=<?php echo $lista[$cont];?>&cod_per=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=NO');">Add
                                Otorgante Juridico</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Favorecidos Juridicos</td>
                        <td>
                            <?php
				            //echo "Favorecidos Juridicos-----------------------------------------------------<br>";}
				            $dataFavorecidos = $escritura->ListadoFavorecido($detalleEscrituras[0]);

				            while($filaf = $dataFavorecidos->fetch_array())
				            {
				                if($filaf['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaf['cod_inv_ju']);
									echo $nombreJuridico['razon_social'];
				                
				            ?>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('./modificarNombresJuridicos.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');">Corregir
                                Nombre</button>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('../controller/eliminarJuridicoF.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>&cod_sct=<?php echo $lista[$cont];?>','','width=600, height=600, scrollbars=NO');">
                                X </button>
                            <?php
				                echo "<br>";
				                }
				            }
				          ?>
                        </td>
                        <td>
                            <button name="boton1" class="btn btn-success" type="button"
                                onclick="javascript:window.open('AddFavorecidoJuridico.php?cod_sct=<?php echo $lista[$cont];?>&cod_per=<?php echo $codigoPersonal;?>','','width=800, height=500, scrollbars=NO');">Add
                                Favorecido Juridico</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="part2">
            <div class="center">

                <table>
                    <tr>
                        <td>Nombre de Bien: *</td>
                        <td><input type="text" name="nombreBien" value="<?php echo $detalleEscrituras[4];?>"
                                size="100" /></td>
                    </tr>
                    <tr>
                        <td>Sub Serie: *</td>
                        <td>
                            <?php 
													$subserie = $escritura->VerSubserie($detalleEscrituras[3]);
													echo $subserie['subserie'];
												?>
                            <input name="boton1" size="10" type="button"
                                onclick="javascript:window.open('CambiarSubserie.php?cod_sct=<?php echo $detalleEscrituras[0];?>','','width=800, height=500, scrollbars=YES');"
                                value="Cambiar la serie" />
                        </td>
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
                        <td><?php echo $datosproyecto[1];?></td>
                    </tr>
                    <tr>
                        <td>Observaciones del Libro:</td>
                        <td><?php echo $datosproyecto[4];?></td>
                    </tr>

                </table>

            </div>
            <br>
            <div class="OBS">
                <div class="left2">
                    <p>Observaciones</p>
                    <TEXTAREA name="observaciones">
			                                      <?php echo $detalleEscrituras[6];?>
			                                </TEXTAREA>
                    <input type="submit" name="btnGuardarCambios" value="Guardar Cambios" />
                </div>
            </div>
        </div>
        

        <!-- FORMLARIO PARA GUARDAR LAS CORRECCIONES HECHAS EN EL FORMULARIO -->
        <form action="" method="post" name="contador">
            <div class="right2">
                <p>Correcciones</p>
                <textarea name="correcciones"></textarea>
                <input type="submit" name="btnCorrecciones" value="Guardar Correcciones" />
            </div>

        </form>
    </div>

</body>

</html>