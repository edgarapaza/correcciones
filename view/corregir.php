<?php
  require_once "../../../coreapp/conection.php";

  @$cod_sct = $_REQUEST['cod_sct'];

  $escritura = "SELECT num_sct,cod_pro,num_fol, fec_doc, nom_bie, obs_sct, cod_sub FROM dbarp.escrituras1 WHERE cod_sct = $cod_sct;";
  $otor = "SELECT cod_inv,cod_inv_ju FROM escriotor1 WHERE cod_sct= $cod_sct;";
  $fav = "SELECT cod_inv,cod_inv_ju FROM escrifavor1 WHERE cod_sct= $cod_sct;";

  $query3 = $mysqli->query($escritura);
  $query1 = $mysqli->query($otor);
  $query2 = $mysqli->query($fav);

  @$result1 = $query1->fetch_assoc();
  @$result2 = $query2->fetch_array();
  @$r_escri = $query3->fetch_array();

  echo "aquiiiiii".$query1->num_rows;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Correcion de Datos - Archivo Regional de Puno</title>
</head>

<body>
  <nav>
    <ul>
      <li><a href="#">Inicio</a></li>
      <li><a href="../../../view/index.php">Regresar</a></li>
    </ul>
  </nav>
<form action="" method="get" name="envio1">
  <p>Ingrese el Codigo de la Base de Datos relacionada a la Escritura:
    <input type="text" name="cod_sct" value="<?php echo $cod_sct; ?>" placeholder="Codigo de la Escritura">
    <input name="consultar" type="submit" class="boton" id="consultar" value="Consultar" />
  </p>
</form>
<br />
<form id="form2" name="form2" method="post" action="change_favor2.php">
  <table width="957" border="1" cellspacing="2" cellpadding="2">
  	<tr>
      <td width="219">DATOS</td>
      <td width="72">Codigo Involucrado</td>
      <td width="496">Nombre / Razon Social</td>
      <td width="144">Cambiar</td>
	  <td><input name="Submit2" type="button" class="boton" onclick="javascript:location.href='../index.php';" value="Salir" /></td>
    </tr>
    <tr>
      <td width="219">Otorgante</td>
      <td width="72"><?php echo $result1['cod_inv'];?></td>
      <td width="496"><?php

	  				$otorgante_respuesta = "SELECT CONCAT(nom_inv, ' ', pat_inv, ' ', mat_inv) AS nombre, otros FROM involucrados1 WHERE Cod_inv =".$result1["cod_inv"];
						$respuestaOtorgante = $mysqli->query($otorgante_respuesta);
						$nombreOtorgante = $respuestaOtorgante->fetch_assoc();
						printf("%s",$nombreOtorgante['nombre']);
	  				?></td>
      <td width="144"><input type="text" name="otorgante" id="otorgante" value="<?php echo $result1[""];?>" /></td>
	  <td><input name="boton1" type="button" class="boton" onclick="javascript:window.open('./modificar_nombres.php?cod_usu=<?php echo $result1[0];?>','','width=500, height=300, scrollbars=NO');" value="Corregir Nombre" /></td>
    </tr>
    <tr>
      <td>Favorecido</td>
      <td><?php echo $result2[0];?></td>
      <td><?php
	  				$f1 = "SELECT CONCAT(nom_inv, ' ', pat_inv, ' ', mat_inv) AS nombre, otros FROM involucrados1 WHERE Cod_inv ='$result2[0]';";
						$r_f1 = mysql_query($f1);
						$r_rf1 = mysql_fetch_array($r_f1);
						printf("%s",$r_rf1[0]);
	  				?></td>
      <td><input type="text" name="favorecido" id="favorecido" value="<?php echo $result2[0];?>" /></td>
	  <td><input name="boton12" type="button" class="boton" onclick="javascript:window.open('./modificar_nombres.php?cod_usu=<?php echo $result2[0];?>','','width=500, height=300, scrollbars=NO');" value="Corregir Nombre" /></td>
    </tr>
    <tr>
      <td>Otorgante Juridico</td>
      <td><?php echo $result1[1];?></td>
      <td>
        <?php
	  				$oj1 = "SELECT Raz_inv FROM involjuridicas1 WHERE Cod_inv ='$result1[1]';";
						$r_oj1 = mysql_query($oj1);
						$r_rj1 = mysql_fetch_array($r_oj1);
						printf("%s",$r_rj1[0]);
	  				?></td>
      <td><input type="text" name="otor_juri" id="otor_juri" value="<?php echo $result1[1];?>" /></td>
	  <td><input name="button1" type="button" class="boton" onclick="javascript:window.open('./modificar_juridicos.php?cod_ju=<?php echo $result1[1];?>','','width=800, height=200, scrollbars=NO');" value="Corregir Nombre" /></td>
    </tr>
    <tr>
      <td>Favorecido Juridico</td>
      <td><?=$result2[1];?></td>
      <td><?php
	  				$fj1 = "SELECT Raz_inv FROM involjuridicas1 WHERE Cod_inv ='$result2[1]'";
						$r_fj1 = mysql_query($fj1);
						$r_rfj1 = mysql_fetch_array($r_fj1);
						printf("%s",$r_rfj1[0]);
	  				?></td>
      <td><input type="text" name="favor_juri" id="favor_juri" value="<?php echo $result2[1];?>" /></td>
	  <td><input name="button1" type="button" class="boton"  onclick="javascript:window.open('./modificar_juridicos.php?cod_ju=<?php echo $result2[1];?>','','width=800, height=200, scrollbars=NO');" value="Corregir Nombre" /></td>
    </tr>
    <tr>
      <td>Escritura</td>
      <td><input name="escritura2" type="text" id="escritura2" value="<?php echo $r_escri[0];?>" size="10" /></td>
      <td>Protocolo: <input type="text" name="protocolo" id="protocolo" value="<?php echo $r_escri[1];?>" />
        <input type="hidden" name="escritura" id="escritura" value="<?php echo $cod_sct;?>" /></td>
      <td><input name="button" type="submit" class="boton" id="button" value="Cambiar Datos" /></td>
	  <td></td>
    </tr>
  </table>
  <p>Detalles</p>
  <table width="623" border="1">
    <tr>
      <td width="142">Folio</td>
      <td width="465"><input name="folio" type="text" id="folio" value="<?php echo $r_escri[2];?>" /></td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td><input name="fecha" type="text" id="fecha" value="<?php echo $r_escri[3];?>" /></td>
    </tr>
    <tr>
      <td>Nombre del Bien </td>
      <td><input name="bien" type="text" id="bien" value="<?php echo $r_escri[4];?>" size="150"/></td>
    </tr>
  </table>
</form>
<form name="obs" action="change_obs.php" method="get">
<table width="623" border="1">
  <tr>
    <td>Observaciones</td>
    <td><textarea name="obs" cols="60" rows="5" id="obs"><?php echo $r_escri[5];?>
</textarea>
  <input name="Submit" type="submit" class="boton" value="Guardar Observaciones" />
  <input type="hidden" name="escritura3" id="escritura3" value="<?php echo $cod_sct;?>" /></td>
  </tr>
</table>
</form>
    <table width="70%">
        <form name="subserie" method="get" action="change_subserie.php">
            	<input type="hidden" name="escritura" id="escritura" value="<?php echo $cod_sct; ?>" />
                <tr>
                    <td width="142">Sub Serie</td>
                    <td width="465">
                        <?php
                            $sql="SELECT des_sub FROM subseries WHERE cod_sub = $r_escri[6];";
                            $sub_serie = $link->fetch_array($link->consulta($sql));
                        ?>
                        <input name="subs_erie" type="text" id="subs_erie" size="70" value="<?php echo $sub_serie[0]; ?>" />
                        <label>Cambiar:</label>
                        <select name="subserie">
                        	<option value="157">-- Modificar --</option>
                        	<?php
                        		$sql_subserie="SELECT cod_sub, des_sub FROM subseries ORDER BY des_sub;";
								$query1=mysql_query($sql_subserie);
                        		while($sub = mysql_fetch_array($query1)){
                        	?>
                            <option value="<?php echo $sub["cod_sub"];?>"><?php echo $sub["des_sub"];?></option>
                            <?php }?>
                        </select>
                        <input type="submit" name="btnCambiarSubserie" id ="btnCambiarSubserie" value="Cambiar Tipo de Documento" />
                    </td>
                </tr>
          </form>
      </table>
</body>
</html>
