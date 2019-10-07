<?php
include_once "../model/EscrituraClass.php";
session_start();

	// Recoge el numero de protocolo de la session
	$numeroProtocolo = $_SESSION['protocolo'];

	// VALORES PARA LA VISTA
    // cod_sct =0
    //  cod_not =1
    //   num_sct =2
    //   cod_dst =3
    //   fec_doc =4
    //   cod_sub =5
    //   nom_bie =6
    //   can_fol =7
    //   cod_pro =8
    //   obs_sct =9
    //   num_fol =10
    //   cod_usu =11
    //   hra_ing =12
    //   proy_id =13

    $escritura = new EscrituraClass();
		
	$listadoEscrituras = $escritura->Listado($numeroProtocolo);
	$lista = array();

	while($fila = $listadoEscrituras->fetch_array())
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
	*
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

	$valor1 = $escritura->Escrituras($lista[$cont]);
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
 		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
 		<title>Correccion de Escrituras</title>
 </head>
 <body>
	<div class="container-fluid bg-success">
		<div class="row">
			<div class="col-md-8">
				<h1>Sistema de Correccion de Escrituras</h1>
				<em><?php echo "Registro Actual: ". $valor1[0];?></em>
			</div>
			<div class="col-md-4">
				<br>
				<a href="../index.php" class="btn btn-danger">Nuevo Protocolo</a>
				<p>Numero de Datos:<?php echo $numeroArray; ?></p>
				<p>Numero de Protocolo <?php echo $numeroProtocolo; ?></p>
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

			        <input type="text" name="codigoEscritura" value="<?php echo $valor1[0];?>" class="form-control"/>
					<table>
						<tr>
							<td>Folio:</td>
							<td><input type="text" name="numeroFolio" value="<?php echo $valor1[10]; ?>" class="form-control" /></td>
						</tr>
						<tr>
							<td>Escritura:</td>
							<td><input type="text" name="numeroEscritura" value="<?php echo $valor1[2];?>" class="form-control" /></td>
						</tr>
						<tr>
						    <td>Total Folios:</td>
						    <td><input type="text" name="cantidadFolios" value="<?php echo $valor1[7];?>" class="form-control" /></td>
						</tr>
						<tr>
							<td>Fecha:</td>
							<td><input type="date" name="fechaDocumento" value="<?php echo $valor1[4];?>" class="form-control" /></td>
						</tr>
						<tr>
							<td><button name="buscarEscritura" type="button"  class="btn btn-info">Buscar </button></td>
							<td><button name="boton" type="button" class="btn btn-info"> Editar </button></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-md-8">
				<table class="table">
					<tr>
						<td>Otorgantes</td>
						<td>
						<?php
						//echo "Otorgantes -----------------------------------------------------<br>";
						$dataOtorgantes = $escritura->ListadoOtorgantes($valor1[0]);

						while($filao = $dataOtorgantes->fetch_array(MYSQLI_ASSOC))
						{
							if($filao['cod_inv'] != 0)
							{
								$nombre = $escritura->VerNombre($filao['cod_inv']);
								echo $nombre['nombre'];
						?>


						<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/modificarNombres.php?cod_usu=<?php echo $filao['cod_inv'];?>','','width=800, height=500, scrollbars=YES');">Corregir Nombre</button>
						<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/elimnarNombre.php?cod_usu=<?php echo $filao['cod_inv'];?>&cod_sct=<?php echo $fila['cod_sct'];?>','','width=500, height=200, scrollbars=NO');">X</button>

							<?php
							echo "<br>";
							}
						}

					       ?>
					    </td>
					    <td>
					    	<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('AddOtorgante.php?cod_sct=<?php echo $fila['cod_sct'];?>&cod_per=<?php echo $fila['cod_usu'];?>','','width=800, height=500, scrollbars=YES');" >Agregar Otorgante</button>
					    </td>
					</tr>

					<tr>
					    <td>Favorecidos</td>
					    <td>
					        <?php

					          $dataFavorecidos = $escritura->ListadoFavorecido($valor1[0]);

					          while($filaf = $dataFavorecidos->fetch_array())
					          {
								  if($filaf['cod_inv'] != 0)
					              {
								  	$nombre = $escritura->VerNombre($filaf['cod_inv']);
									echo $nombre['nombre'];
									

					          ?>
					            <button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/modificarNombres.php?cod_usu=<?php echo $filaf['cod_inv'];?>','','width=800, height=500, scrollbars=YES');" >Corregir Nombre</button>
					            <button name="boton2" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/elimnarNombreF.php?cod_inv=<?php echo $filaf['cod_inv'];?>&cod_sct=<?php echo $fila['cod_sct'];?>','','width=500, height=200, scrollbars=NO');">X</button>
					          <?php
					            echo "<br>";
					              }
					          }

					        ?>
					    </td>

					    <td>
					    	<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('AddFavorecido.php?cod_sct=<?php echo $fila['cod_sct'];?>&cod_per=<?php echo $fila['cod_usu'];?>','','width=800, height=500, scrollbars=YES');"> Agregar Favorecido</button>
					    </td>
					</tr>

					<tr>
				        <td>Otorgantes Juridicos</td>
				        <td>
				          <?php
				            //echo "Otorgantes Juridicos-----------------------------------------------------<br>";
				          	$dataOtorgantes = $escritura->ListadoOtorgantes($valor1[0]);

				            while($filaoj = $dataOtorgantes->fetch_array())
				            {
				                if($filaoj['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaoj['cod_inv_ju']);
									echo $nombreJuridico['razon_social'];
				                
				            ?>
				            <button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/modificarNombresJuridicos.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');" >Corregir Nombre</button>
				            <button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/elimnarJuridicoO.php?cod_inv=<?php echo $filaoj['cod_inv_ju'];?>&cod_sct=<?php echo $fila['cod_sct'];?>','','width=500, height=200, scrollbars=NO');"> X </button>
				          <?php
				                echo "<br>";
				                }
				            }
				          ?>
				        </td>
				        <td>
				        	<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('AddOtorganteJuridico.php?cod_sct=<?php echo $fila['cod_sct'];?>&cod_per=<?php echo $fila['cod_usu'];?>','','width=800, height=500, scrollbars=NO');" >Add Otorgante Juridico</button>
				        </td>
					</tr>

					<tr>
				        <td>Favorecidos Juridicos</td>
				        <td>
				          <?php
				            //echo "Favorecidos Juridicos-----------------------------------------------------<br>";}
				            $dataFavorecidos = $escritura->ListadoFavorecido($valor1[0]);

				            while($filaf = $dataFavorecidos->fetch_array())
				            {
				                if($filaf['cod_inv_ju'] != 0)
				                {
									$nombreJuridico = $escritura->VerNombreJuridico($filaf['cod_inv_ju']);
									echo $nombreJuridico['razon_social'];
				                
				            ?>
				            <button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/modificarNombresJuridicos.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>','','width=1100, height=400, scrollbars=YES');" >Corregir Nombre</button>
				            <button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('../controller/elimnarJuridicoF.php?cod_inv=<?php echo $filaf['cod_inv_ju'];?>&cod_sct=<?php echo $fila['cod_sct'];?>','','width=600, height=600, scrollbars=NO');" > X </button>
				          <?php
				                echo "<br>";
				                }
				            }
				          ?>
				        </td>
				        <td>
				        	<button name="boton1" class="btn btn-success" type="button" onclick="javascript:window.open('AddFavorecidoJuridico.php?cod_sct=<?php echo $fila['cod_sct'];?>&cod_per=<?php echo $fila['cod_usu'];?>','','width=800, height=500, scrollbars=NO');" >Add Favorecido Juridico</button>
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
			                                <td><input type="text" name="nombreBien" value="<?php echo $valor1[6];?>" size="100" /></td>
			                        </tr>
			                        <tr>
			                                <td>Sub Serie: *</td>
			                                <td>
												<?php 
													$subserie = $escritura->VerSubserie($valor1[5]);
													echo $subserie['subserie'];
												?>
												<input name="boton1" size="10" type="button" onclick="javascript:window.open('CambiarSubserie.php?cod_sct=<?php echo $valor1[0];?>','','width=800, height=500, scrollbars=YES');" value="Cambiar la serie" />
											</td>
			                        </tr>
			                        <tr>
			                            <td>Notario</td>
			                            <td>
											<?php 
												$notario = $escritura->VerNotario($valor1[1]);
												echo $notario['notario'];
											?>
										</td>
			                        </tr>
			                        <tr>
			                                <td>Distrito:</td>
			                                <td>
												<?php
													$distrito = $escritura->VerDistrito($valor1[3]);
													echo $distrito['des_dst'];
												?>
											</td>
			                        </tr>

			                        <tr>
			                                <td>Codigo Trabajador:</td>
			                                <td>
												<?php 
													$trabajador = $escritura->VerTrabajador($valor1[11]);
													echo $trabajador['trabajador'];
												?>
											</td>
			                        </tr>
			                        <tr>
			                                <td>Hora Ingreso:</td>
			                                <td><?php echo $valor1[12];?></td>
			                        </tr>

			                </table>

			                </div>
			                <br>
			                <div class="OBS">
			                        <div class="left2">
			                                <p>Observaciones</p>
			                                <TEXTAREA  name="observaciones">
			                                      <?php echo $valor1[9];?>
			                                </TEXTAREA>
			                                <input type="submit" name="btnGuardarCambios" value="Guardar Cambios" />
			                        </div>
			                </div>
			        </div>
			        </form>

			        <!-- FORMLARIO PARA GUARDAR LAS CORRECCIONES HECHAS EN EL FORMULARIO -->
			        <form action="" method="post" name="contador">
			                <div class="right2">
			                        <p>Correcciones</p>
			                        <textarea name="correcciones"></textarea>
			                        <input type="submit" name="btnCorrecciones" value="Guardar Correcciones" />
							</div>
							
					</form>
					
					<a href="changeProtocolo.php?contador=1">Siguiente</a>
					<div>
								
								
							</div>
			    </div>
		</div>
	</div>

 </body>
 </html>