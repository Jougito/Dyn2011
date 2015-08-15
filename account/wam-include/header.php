<?php

ob_start();

// F�jl ellen�rz�se
if(!isset($mysql_host)){ exit(); }

// Oldal letilt�sa
if ($site_enable == "0"){ require_once("wam-include/lock.php"); exit(); }

// Karakterk�szlet be�ll�t�sa
header("Content-Type: text/html; charset=ISO-8859-2");

// MySQL kapcsol�d�s �s az adatb�zis (realmd) kijel�l�se
$mysql_connect = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die("Nem siker�lt csatlakozni az adatb�zishoz!");
db_select($mysql_db_realmd);

// Program verzi�
$wam_version = "1.3.4 RC";

// Fontos v�ltoz�k
$site_get_pages = variable($_GET["id"], "", "normal");
$site_get_action = variable($_GET["act"], "", "normal");
$site_get_name = variable($_GET["name"], "", "db");
$site_post_action = variable($_POST["action"], "", "normal");
$site_get_cid = variable($_GET["cid"], "", "db");
$cookie_wam_id = variable($_COOKIE["wam_id"], "", "db");
$site_get_message = variable($_GET["msg"], "stripslashes,htmlspecialchars", "normal");
$cookie_worktime = $_COOKIE["wam_worktime"];
$site_ip = $_SERVER["REMOTE_ADDR"];

// D�tum megjelen�t�se, �talak�t�sa
$site_date_day = date("D");

switch ($site_date_day){

	case "Mon":
	$site_date_day = "H�tf�";
	break;

	case "Tue":
	$site_date_day = "Kedd";
	break;

	case "Wed":
	$site_date_day = "Szerda";
	break;

	case "Thu":
	$site_date_day = "Cs�t�rt�k";
	break;
	case "Fri":
	$site_date_day = "P�ntek";
	break;

	case "Sat":
	$site_date_day = "Szombat";
	break;

	case "Sun":
	$site_date_day = "Vas�rnap";
	break;

}

$site_date = "".date("Y.m.d. H:i").", ".$site_date_day."";

// Biztons�gi napl�z�s k�sz�t�se (l�togat�k)
site_log("visitors", "IP: ".$site_ip." | D�tum: ".$site_date."");

// S�tik ellen�rz�se
if(!empty($cookie_wam_id)){

	// Helyes s�ti adatok ellen�rz�se
	$query_login = db_query("SELECT COUNT(*) FROM account WHERE wam_id = '".$cookie_wam_id."'");
	$results_login = mysqli_fetch_array($query_login);

	if($results_login[0] == 0){

		// Biztons�gi napl�z�s k�sz�t�se (rossz bel�p�sek (s�ti))
		site_log("bad-login-cookie", "IP: ".$site_ip." | D�tum: ".$site_date."");

		// Kil�p�s
		header_location("logout");

	} else
	{

		// Account adatainak lek�rdez�se
		$query_user_check = db_query("SELECT id, username, sha_pass_hash, email, expansion FROM account WHERE wam_id = '".$cookie_wam_id."'");
		$results_user_check = mysqli_fetch_array($query_user_check);

		// Account adatainak t�rol�sa
		$user_check_accountid = $results_user_check["id"];
		$user_check_accountname = $results_user_check["username"];
		$user_check_password = $results_user_check["sha_pass_hash"];
		$user_check_email = $results_user_check["email"];
		$user_check_expansion = $results_user_check["expansion"];

		// Account rangj�nak lek�rdez�se
		$query_user_check_gmlevel = db_query("SELECT gmlevel FROM account_access WHERE id = '".$user_check_accountid."'");
		$results_user_check_gmlevel = mysqli_fetch_array($query_user_check_gmlevel);

		// Account rangj�nak t�rol�sa
		$user_check_gmlevel = $results_user_check_gmlevel["gmlevel"];

		// S�tik friss�t�se
		$worktime_login_final = time()+$cookie_worktime;
		setcookie("wam_id", $_COOKIE["wam_id"], $worktime_login_final);
		setcookie("wam_worktime", $_COOKIE["wam_worktime"], $worktime_login_final);

	}

}

?>