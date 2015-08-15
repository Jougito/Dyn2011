<?php

// Fontos fájlok beillesztése
require_once("wam-include/settings.php");
require_once("wam-include/functions.php");
require_once("wam-include/header.php");

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
$query_oro = db_query("SELECT creditos FROM account WHERE id = '".$user_check_accountid."'");
$results_oro = mysqli_fetch_array($query_oro);

// Revision de baneo de cuenta(ban)
$query_logged_ban = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
$results_logged_ban = mysqli_fetch_array($query_logged_ban);

// Revision de baneo de cuenta(mute)
$query_mute = db_query("SELECT mutetime FROM account WHERE id = '".$user_check_accountid."'");
$results_mute = mysqli_fetch_array($query_mute);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<link rel="stylesheet" type="text/css" href="<?php echo theme_file("style.css"); ?>" />
<script language="javascript" type="text/javascript" src="dyn-others/script.js"></script>
<meta name="description" content="Dynamite.es es un servidor privado de world of warcraft, derechos a blizzard y contenido de codigo a Dynamite Staff" />
<meta name="keywords" content="<?php echo $site_meta_keywords; ?>" />
<meta name="robots" content="<?php echo $site_meta_robots ?>" />
<meta name="author" content="Soir (Dynamite Staff - Jorge)" />
<meta content="gestor 1.0" name="version">
<meta content="dynamite.es" name="dynamitewebpage">
<link rel="shortcut icon" href="<?php echo theme_file("images/favicon.png"); ?>" type="image/png" />
<title><?php echo $site_title; ?></title>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
.auto-style4 {
	color: #F3BBBB;
}
.auto-style5 {
	font-weight: normal;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>

<div align="center">

<table class="site" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	
	<table class="header" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		<center><a href="index.php"><img src="<?php echo theme_file("images/logo.png"); ?>" alt="<?php echo $site_title; ?>" /></a></center>
		
		</td>
      </tr>
    </table>
	
	<table align="right" class="body-header" cellspacing="1" cellpadding="0">
      <tr>
        <td>
		

</tr>
    </table>
	 
	<table class="body" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
	     <table class="body2" cellspacing="0" cellpadding="0">
           <tr>
             <td class="body2-left">
			 
			 <?php
			 
			 if(!empty($cookie_wam_id)){
			 
				require_once("wam-modules/logged.php");
			 
			} else {
			 
				require_once("wam-modules/not-logged.php");
			 
			}
			 
			 ?>
		
		     </td>
			 <td class="body2-right">
			 
			 	 <?php
	 
	            if(!empty($site_get_pages)){

					 if (file_exists("wam-pages/".$site_get_pages.".php")) {
		   
						 require_once("wam-pages/".$site_get_pages.".php");

					 } else {

						 require_once("wam-pages/404.php");

					 }
 
                } else { require_once("wam-pages/index.php"); }

                 ?>
		
		     </td>

             </tr>
         </table>
		
		</td>
      </tr>
    </table>
	 
	<table align="center" class="body-footer" cellspacing="0" cellpadding="0">
      <tr>
        <td class="auto-style1">
		
		<br>.Código 0054.<br>2011 
		&copy; Dynamite.es - <a target="_blank" href="http://dynamite.es/">Página Principal</a>
		
		<br>Todos los derechos reservados de código a Dynamite -&nbsp; World of 
		Warcraft, Pradox, Soir.<br>Todos los derechos de imágenes reservados a 
		Blizzard Entertainment &amp; Co.</td>
      </tr>
    </table>
	
	</td>
  </tr>
</table>

</div>

</body>
</html>

<?php

// Fontos fájlok beillesztése
require_once("wam-include/footer.php");

?>
