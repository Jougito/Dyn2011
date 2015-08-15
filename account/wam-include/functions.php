<?php

// F�jl ellen�rz�se
if(!isset($mysql_host)){exit(); }

// MySQL lek�r�s
function db_query( $sql ){

	global $mysql_connect;

	return mysqli_query($mysql_connect, $sql);

}

// MySQL adatb�zis csatlakoz�s
function db_select( $db ){

	global $mysql_connect;

	mysqli_select_db($mysql_connect, $db) or die("Nem siker�lt kijel�lni az adatb�zist! (".$db.")");

}

// �tir�ny�t�s (hiba�zenetek)
function system_message ( $msg ){

	header("Location: ?id=system-message&msg=".$msg.""); exit();

}

// �tir�ny�t�s (m�sik oldalra)
function header_location ( $id ){

	header("Location: ?id=".$id.""); exit();

}

// Biztons�gi napl�z�sok
function site_log ( $filename, $text ){

	global $site_log_enable;

	if($site_log_enable == "1"){
	
		$log_visitors = fopen("wam-logs/".$filename.".txt", "a");
		fwrite($log_visitors, "".$text."\n");
		fclose($log_visitors);
	
	}

}

// V�ltoz�k �talak�t�sa
function variable ( $variable, $functions, $mode ){

	global $mysql_connect;

	$functions_explode = explode(",", $functions);
	
	foreach ($functions_explode as $functions_final)
    {
		
		if(function_exists($functions_final)) { $variable = $functions_final($variable); }
		
		switch ($mode){
		
			case "normal":
			$variable_return = trim(htmlspecialchars($variable));
			break;
			
			case "db":
			$variable_return = mysqli_real_escape_string($mysql_connect, trim(htmlspecialchars($variable)));
			break;
		
		}

    }
	
	return $variable_return;

}

// Sha pass hash konvert�l�s
function sha_pass_hash ( $username, $password ){

	return SHA1("".$username.":".$password."");

}

// F�jl ellen�rz�s
function file_check ( $terms ){

	global $user_check_gmlevel;
	global $user_check_accountid;
	global $wam_gmlevel_vip;
	global $wam_gmlevel_admin;
	global $wam_vip_enable;
	global $wam_vip_enable_addmoney;
	global $wam_vip_enable_additem;
	global $wam_vip_enable_addlevel;
	global $wam_vip_enable_charrename;

	$terms_explode = explode(",", $terms);
	
	foreach ($terms_explode as $terms_final)
    {
		
		switch ($terms_final){
		
			case "logged":
			if(empty($_COOKIE["wam_id"])) { header_location("404"); }
			break;
			
			case "notlogged":
			if(!empty($_COOKIE["wam_id"])) { header_location("404"); }
			break;
			
			case "error":
			header_location("404");
			break;
			
			case "player":
			if($user_check_gmlevel != $wam_gmlevel_player) { header_location("404"); }
			break;
			
			case "moderator":
			if($user_check_gmlevel != $wam_gmlevel_mod) { header_location("404"); }
			break;
			
			case "gm":
			if($user_check_gmlevel != $wam_gmlevel_gm) { header_location("404"); }
			break;
			
			case "vip":
			if($user_check_gmlevel != $wam_gmlevel_vip) { header_location("404"); }
			break;
			
			case "admin":
			if($user_check_gmlevel != $wam_gmlevel_admin) { header_location("404"); }
			break;
			
			case "vipmodule":
			if($wam_vip_enable != "1") { header_location("404"); }
			break;
			
			case "additem":
			if($wam_vip_enable_additem != "1") { header_location("404"); }
			break;
			
			case "addlevel":
			if($wam_vip_enable_addlevel != "1") { header_location("404"); }
			break;
			
			case "addmoney":
			if($wam_vip_enable_addmoney != "1") { header_location("404"); }
			break;
			
			case "charrename":
			if($wam_vip_enable_charrename != "1") { header_location("404"); }
			break;
			
			case "notbanned":
			$query = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
			$results = mysqli_fetch_array($query);
			if($results["active"] == 1){ system_message("Az accountod bannolva van!"); }
			break;
		
		}
		
    }

}

// Adatok ellen�rz�se
function string_check ( $string, $string2, $mode, $error ){

	switch($mode){

		case "<":
		if(strlen($string) < $string2){ system_message($error); }
		break;
		
		case ">":
		if(strlen($string) > $string2){ system_message($error); }
		break;
		
		case "<num":
		if($string < $string2){ system_message($error); }
		break;
		
		case ">num":
		if($string > $string2){ system_message($error); }
		break;
		
		case "==":
		if($string == $string2){ system_message($error); }
		break;
		
		case "!=":
		if($string != $string2){ system_message($error); }
		break;
		
		case "!ereg":
		if(!ereg($string2, $string)){ system_message($error); }
		break;

	}

}

// F�jlok ki�r�sa
function theme_file( $file ){

	global $site_theme;

	return "wam-themes/".$site_theme."/".$file."";

}

// Karakter tulajdonos�nak ellen�rz�se
function character_check( $guid ){

	global $mysql_connect;
	global $user_check_accountid;

	$query = db_query("SELECT account FROM characters WHERE guid = '".$guid."'");
	$results = mysqli_fetch_array($query);
	if($results["account"] != $user_check_accountid){

		system_message("Ez nem a Te karaktered!");

	}

}

?>