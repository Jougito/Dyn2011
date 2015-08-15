<?php

ob_start();

// Fájl ellenõrzése
if(!isset($mysql_host)){ exit(); }

// Oldal letiltása
if ($site_enable == "0"){ require_once("wam-include/lock.php"); exit(); }

// Karakterkészlet beállítása
header("Content-Type: text/html; charset=ISO-8859-2");

// MySQL kapcsolódás és az adatbázis (realmd) kijelölése
$mysql_connect = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die("Nem sikerült csatlakozni az adatbázishoz!");
db_select($mysql_db_realmd);

// Program verzió
$wam_version = "1.3.4 RC";

// Fontos változók
$site_get_pages = variable($_GET["id"], "", "normal");
$site_get_action = variable($_GET["act"], "", "normal");
$site_get_name = variable($_GET["name"], "", "db");
$site_post_action = variable($_POST["action"], "", "normal");
$site_get_cid = variable($_GET["cid"], "", "db");
$cookie_wam_id = variable($_COOKIE["wam_id"], "", "db");
$site_get_message = variable($_GET["msg"], "stripslashes,htmlspecialchars", "normal");
$cookie_worktime = $_COOKIE["wam_worktime"];
$site_ip = $_SERVER["REMOTE_ADDR"];

// Dátum megjelenítése, átalakítása
$site_date_day = date("D");

switch ($site_date_day){

	case "Mon":
	$site_date_day = "Hétfõ";
	break;

	case "Tue":
	$site_date_day = "Kedd";
	break;

	case "Wed":
	$site_date_day = "Szerda";
	break;

	case "Thu":
	$site_date_day = "Csütörtök";
	break;
	case "Fri":
	$site_date_day = "Péntek";
	break;

	case "Sat":
	$site_date_day = "Szombat";
	break;

	case "Sun":
	$site_date_day = "Vasárnap";
	break;

}

$site_date = "".date("Y.m.d. H:i").", ".$site_date_day."";

// Biztonsági naplózás készítése (látogatók)
site_log("visitors", "IP: ".$site_ip." | Dátum: ".$site_date."");

// Sütik ellenõrzése
if(!empty($cookie_wam_id)){

	// Helyes süti adatok ellenõrzése
	$query_login = db_query("SELECT COUNT(*) FROM account WHERE wam_id = '".$cookie_wam_id."'");
	$results_login = mysqli_fetch_array($query_login);

	if($results_login[0] == 0){

		// Biztonsági naplózás készítése (rossz belépések (süti))
		site_log("bad-login-cookie", "IP: ".$site_ip." | Dátum: ".$site_date."");

		// Kilépés
		header_location("logout");

	} else
	{

		// Account adatainak lekérdezése
		$query_user_check = db_query("SELECT id, username, sha_pass_hash, email, expansion FROM account WHERE wam_id = '".$cookie_wam_id."'");
		$results_user_check = mysqli_fetch_array($query_user_check);

		// Account adatainak tárolása
		$user_check_accountid = $results_user_check["id"];
		$user_check_accountname = $results_user_check["username"];
		$user_check_password = $results_user_check["sha_pass_hash"];
		$user_check_email = $results_user_check["email"];
		$user_check_expansion = $results_user_check["expansion"];

		// Account rangjának lekérdezése
		$query_user_check_gmlevel = db_query("SELECT gmlevel FROM account_access WHERE id = '".$user_check_accountid."'");
		$results_user_check_gmlevel = mysqli_fetch_array($query_user_check_gmlevel);

		// Account rangjának tárolása
		$user_check_gmlevel = $results_user_check_gmlevel["gmlevel"];

		// Sütik frissítése
		$worktime_login_final = time()+$cookie_worktime;
		setcookie("wam_id", $_COOKIE["wam_id"], $worktime_login_final);
		setcookie("wam_worktime", $_COOKIE["wam_worktime"], $worktime_login_final);

	}

}

?>