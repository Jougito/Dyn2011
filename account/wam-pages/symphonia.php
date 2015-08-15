<?php

// E- Logeado si/no
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Información de cuenta
$query_logged = db_query("SELECT joindate, last_ip, last_login FROM account WHERE id = '".$user_check_accountid."'");
$results_logged = mysqli_fetch_array($query_logged);

// Información de cuenta2
$query_logged2 = db_query("SELECT failed_logins, last_ip, last_login FROM account WHERE id = '".$user_check_accountid."'");
$results_logged2 = mysqli_fetch_array($query_logged2);

// Información de personajes
$query_pj = db_query("SELECT numchars FROM realmcharacters WHERE acctid = '".$user_check_accountid."' AND realmid= 2");
$results_pj = mysqli_fetch_array($query_pj);

// Resultados del reino
switch($results_pj["numchars"]){

	case "0":
	$results_pj["numchars"] = '<font color="red">No se han encontrado personajes en este reino.</font>';
	break;

	case "1":
	$results_pj["numchars"] = '<font color="orange">1 personaje.</font>';
	break;

	case "2":
	$results_pj["numchars"] = '<font color="orange">2 personajes.</font>';
	break;

	case "3":
	$results_pj["numchars"] = '<font color="orange">3 personajes.</font>';
	break;

	case "4":
	$results_pj["numchars"] = '<font color="yellow">4 personajes.</font>';
	break;

	case "5":
	$results_pj["numchars"] = '<font color="yellow">5 personajes.</font>';
	break;

	case "6":
	$results_pj["numchars"] = '<font color="green">6 personajes.</font>';
	break;

	case "7":
	$results_pj["numchars"] = '<font color="green">7 personajes.</font>';
	break;

	case "8":
	$results_pj["numchars"] = '<font color="green">8 personajes.</font>';
	break;

	case "9":
	$results_pj["numchars"] = '<font color="green">9 personajes.</font>';
	break;

	case "10":
	$results_pj["numchars"] = '<font color="green">10 personajes.</font>';
	break;

	default:
	$results_pj["numchars"] = '<font color="red">No se han encontrado personajes en este reino.</font>';
	break;

}

// Información de versión de juego
$query_build = db_query("SELECT name, address, gamebuild FROM realmlist WHERE id = 2");
$results_build = mysqli_fetch_array($query_build);

// Revision de baneo de cuenta(ban)
$query_symphonia = db_query("SELECT allowedSecurityLevel FROM realmlist WHERE id = 2");
$results_symphonia = mysqli_fetch_array($query_symphonia);

// Resultados del reino
switch($results_symphonia["allowedSecurityLevel"]){

	case "0":
	$results_symphonia["estado"] = '<img src="imagesv/blizz.gif" alt="Soir" />
<font color="green">Reino disponible para todos los jugadores</font>';
	break;

	case "1":
	$results_symphonia["estado"] = '<img src="imagesv/blizz.gif" alt="Soir" /> <font color="red">Reino inactivo para jugadores (Solo Staff)</font>';
	break;

	default:
	$results_symphonia["estado"] = '<img src="imagesv/cuentaactiva.png" alt="Soir" />
<font color="red">Reino Inexistente</font>';
	break;

}

// Revision de baneo de cuenta(ban)
$query_tiporeino = db_query("SELECT icon FROM realmlist WHERE id = 2");
$results_tiporeino = mysqli_fetch_array($query_tiporeino);

// Resultados del reino
switch($results_tiporeino["icon"]){

	case "0":
	$results_tiporeino["icono"] = '<font color="yellow">Normal</font>';
	break;

	case "1":
	$results_tiporeino["icono"] = '<font color="yellow">PVP</font>';
	break;

	default:
	$results_tiporeino["icono"] = '<font color="yellow">Reino Inexistente</font>';
	break;

}

switch($user_check_gmlevel){

	case $wam_gmlevel_player:
	$user_check_gmlevel = '<font color="cian">Jugador</font>';

	break;

	case $wam_gmlevel_vip:
	$user_check_gmlevel = '<font color="purple">Usuario con privilegios</font>';

	break;

	case $wam_gmlevel_mod:
	$user_check_gmlevel = '<font color="red">Moderador de symphonia</font>';

	break;

	case $wam_gmlevel_gm:
	$user_check_gmlevel = '<font color="red">Maestro de Juego de symphonia</font>';

	break;

	case $wam_gmlevel_admin:
	$user_check_gmlevel = '<font color="red">Administrador de symphonia</font>';

	break;

	case 0:
	$user_check_gmlevel = '<font color="cian">Jugador</font>';

	break;

	default:
	$user_check_gmlevel = "Desconocido";
	break;

}


?>

		     
 <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Reino de Symphonia<img class="nav-icon" src="<?php echo ("imagesv/blizz.gif"); ?>" alt="Datos adicionales (Nombre de cuenta: <?php echo $user_check_accountname; ?>)" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Información" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Aquí podrás encontrar la información acerca del reino de Symphonia.

						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td width="150px" align="right">
						 Nombre de Cuenta:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_accountname; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Fallos de inicio de sesión:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged2["failed_logins"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Número de Personajes:
						 </td>
						 <td align="left">
                         <b><?php echo $results_pj["numchars"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Versión de juego:
						 </td>
						 <td align="left">
						 <b><?php echo $results_build["gamebuild"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Estado del reino:
						 </td>
						 <td align="left">
						 <b><?php echo $results_symphonia["estado"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Realmlist:
						 </td>
						 <td align="left">
						 <b><?php echo $results_build["address"]; ?></b>
						 </td>
					   </tr>

					   <tr>
					     <td align="right">
						 Tipo de Juego del Reino:
						 </td>
						 <td align="left">
						 <b><?php echo $results_tiporeino["icono"]; ?></b>
						 </td>
					   </tr><center><img src="imagesv/dynamites.png"></center>
<tr>

					</table>
				 
				 </td>
			   </tr>
			 </table>
