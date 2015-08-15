<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Account adatok lekérdezése
$query_logged = db_query("SELECT joindate, last_ip, last_login FROM account WHERE id = '".$user_check_accountid."'");
$results_logged = mysqli_fetch_array($query_logged);

// Account adatok lekérdezése (ban)
$query_logged_ban = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
$results_logged_ban = mysqli_fetch_array($query_logged_ban);

// Lekért adatok átalakítása
switch($results_logged_ban["active"]){

	case "0":
	$results_logged_ban["active"] = '<font color="green">Abierta</font>';
	break;

	case "1":
	$results_logged_ban["active"] = '<font color="red">Cerrada</font>';
	break;

	default:
	$results_logged_ban["active"] = '<font color="green">Abierta</font>';
	break;

}


switch($user_check_expansion){

	case $wam_expansion_wotlk:
	$user_check_expansion = '<img src="imagesv/wotlk.png" alt="" />';

	break;

	case $wam_expansion_bc:
	$user_check_expansion = '<img src="imagesv/tbc.png" alt="" />';

	break;

	case $wam_expansion_classic:
	$user_check_expansion = '<img src="imagesv/classic.png" alt="" />';
	break;

	default:
	$user_check_expansion = "Nulo";
	break;

}

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Gestión de Expansiones para el Reino Vesperia<img class="nav-icon" src="<?php echo theme_file("images/icons/page.png"); ?>" alt="Account adatok (Bejelentkezve: <?php echo $user_check_accountname; ?>)" />
				 
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
						  
						  Aquí podrás ver la información de las expansiónes asociadas a tu cuenta.

						  </td>
						</tr>
					</table>
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     					   <tr>
						 <td align="center">
						 <img src="imagesv/logo.png" alt="Soir" />
	     						 </td>
						 </td>
					   </tr>
					</table>

					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     					   <tr>
						 <td align="center">
						 <b><?php echo $user_check_expansion; ?></b>
	     <td align="center">
						<font color="red">No disponible todavía</font> <p>Actualizar a Cataclysm.
						 </td>
						 </td>
					   </tr>
					</table>
  <tr>
						 <td align="center">
						 <img src="imagesv/cataclysm.png" alt="Soir" />
	     						 </td>
						 </td>

				 
				 </td>
			   </tr>
			 </table>
