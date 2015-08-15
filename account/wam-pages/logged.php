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
$query_logged3 = db_query("SELECT numchars FROM realmcharacters WHERE acctid = '".$user_check_accountid."'");
$results_logged3 = mysqli_fetch_array($query_logged3);

// Información de versión de juego
$query_build = db_query("SELECT name, address, gamebuild FROM realmlist WHERE id = 1");
$results_build = mysqli_fetch_array($query_build);

// Información de oro de cuenta
$query_oro = db_query("SELECT creditos, creditos_gastados FROM account WHERE id = '".$user_check_accountid."'");
$results_oro = mysqli_fetch_array($query_oro);


// Revision de baneo de cuenta(ban)
$query_logged_ban = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
$results_logged_ban = mysqli_fetch_array($query_logged_ban);

// Revision de baneo de cuenta(mute)
$query_mute = db_query("SELECT mutetime FROM account WHERE id = '".$user_check_accountid."'");
$results_mute = mysqli_fetch_array($query_mute);

// Cuenta muteada... datos
switch($results_mute["mutetime"]){

	case "0":
	$results_mute["mutetime"] = '<font color="green">No</i></font>';
	break;

	case "1":
	$results_mute["mutetime"] = '<font color="red">Sí</font>';
	break;

	default:
	$results_mute["mutetime"] = '<font color="green">No</i></font>';
	break;

}

// Cuenta baneada... datos
switch($results_logged_ban["active"]){

	case "0":
	$results_logged_ban["active"] = '<img src="imagesv/cuentaactiva-.png" alt="Soir" /><font color="yellow">
Cuenta Activa - <i>Con alguna sanción inactiva</i></font>';
	break;

	case "1":
	$results_logged_ban["active"] = '<img src="imagesv/cuentainactiva.png" alt="Soir" /><font color="red">Cuenta Inactiva</font>';
	break;

	default:
	$results_logged_ban["active"] = '<img src="imagesv/cuentaactiva.png" alt="Soir" />
<font color="green">Cuenta Activa</font>';
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
	$user_check_gmlevel = '<font color="red">Moderador de Vesperia</font>';

	break;

	case $wam_gmlevel_gm:
	$user_check_gmlevel = '<font color="red">Maestro de Juego de Vesperia</font>';

	break;

	case $wam_gmlevel_admin:
	$user_check_gmlevel = '<font color="red">Administrador de Vesperia</font>';

	break;

	case 0:
	$user_check_gmlevel = '<font color="cian">Jugador</font>';

	break;

	default:
	$user_check_gmlevel = "Desconocido";
	break;

}

switch($user_check_expansion){

	case $wam_expansion_wotlk:
	$user_check_expansion = "WOTLK";
	break;

	case $wam_expansion_bc:
	$user_check_expansion = "BC";
	break;

	case $wam_expansion_classic:
	$user_check_expansion = "Classic";
	break;

	default:
	$user_check_expansion = "Ismeretlen";
	break;

}

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Gestión de Cuenta (Nombre de Cuenta: <?php echo $user_check_accountname; ?>)<img class="nav-icon" src="<?php echo theme_file("images/icons/page.png"); ?>" alt="Account adatok (Bejelentkezve: <?php echo $user_check_accountname; ?>)" />
				 
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
						  
						  Aquí podrás encontrar la información de tu cuenta.

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
						 Identificador de Cuenta:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_accountid; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Email:
						 </td>
						 <td align="left">
                         <b><?php echo $user_check_email; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Rango:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_gmlevel; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Estado de la Cuenta:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged_ban["active"]; ?></b>
						 </td>
					</tr>
<tr>
							<td align="right">
						 Muteado:
						 </td>
						 <td align="left">
						 <b><?php echo $results_mute["mutetime"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Fecha de Registro:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["joindate"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Último juego:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["last_login"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Última IP:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["last_ip"]; ?></b>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 Créditos:
						 </td>
						 <td align="left">
						 <b><font color="blue"><?php echo $results_oro["creditos"]; ?> Créditos</b>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 Créditos Gastados:
						 </td>
						 <td align="left">
						 <b><font color="blue"><?php echo $results_oro["creditos_gastados"]; ?> Créditos</b>
						 </td>
					   </tr>
<tr>

					</table>
<i><center>Recuerda que estos datos pueden variar dependiendo del estado de tu cuenta.</center></i>
</table>
 
