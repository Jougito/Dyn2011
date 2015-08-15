<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["accountname"])){

	// Posztolt adatok átalakítás
	$post_accounttransaction_accountname = variable($_POST["accountname"], "strtoupper", "db");

	// Posztolt adatok ellenõrzése
	string_check($post_playertransaction_playername, ">", 32, "Az account neve túl hosszú!");
	string_check($post_playertransaction_playername, "<", 3, "Az account neve túl rövid!");
	
	// Játékos ellenõrzése
	$query_accounttransaction_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_check = mysqli_fetch_array($query_accounttransaction_check);

	if($results_accounttransaction_check[0] == 0){

		system_message("Az általad keresett account nem létezik!");

	}

	// Account ID lekérdezése
	$query_accounttransaction_account = db_query("SELECT id FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_account = mysqli_fetch_array($query_accounttransaction_account);

	// Account access beszúrása, ha nem létezik
	if($site_post_action == "gmlevelvip" || $site_post_action == "gmlevelgm" || $site_post_action == "gmlevelmod" || $site_post_action == "gmleveladmin"){

		$query_accounttransaction_accountaccess = db_query("SELECT COUNT(*) FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		$results_accounttransaction_accountaccess = mysqli_fetch_array($query_accounttransaction_accountaccess);

		if($results_accounttransaction_accountaccess[0] == 0){

			db_query("INSERT INTO account_access (id, gmlevel, RealmID) VALUES ('".$results_accounttransaction_account["id"]."', '0', '1')");

		}

	}

		// Mûvelet elvégzése
		switch($site_post_action){

		// Account törlése
		case "delete":
		db_query("DELETE FROM account WHERE id = '".$results_accounttransaction_account["id"]."'");

		// Csatlakozás a characters adatbázishoz
		db_select($mysql_db_characters);

		// Accounthoz tartozó karakterek törlése
		$query_accounttransaction_character = db_query("SELECT guid, name FROM characters WHERE account = '".$results_accounttransaction_account["id"]."'");

		while($results_accounttransaction_character = mysqli_fetch_array($query_accounttransaction_character)){

			db_query("DELETE FROM characters WHERE name = '".$results_accounttransaction_character["name"]."'");
			db_query("DELETE FROM arena_team_member WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_account_data WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_achievement WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_achievement_progress WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_action WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_aura WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_battleground_data WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_declinedname WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_equipmentsets WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_gifts WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_glyphs WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_homebind WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_inventory WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_queststatus WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_queststatus_daily WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_reputation WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_skills WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_social WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_spell WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_spell_cooldown WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_talent WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM corpse WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_aura WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_spell WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_spell_cooldown WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM guild_member WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM item_instance WHERE owner_guid = '".$results_accounttransaction_character["guid"]."'");

		}

		break;

		// Bannolás
		case "bann":
		db_query("INSERT INTO account_banned (id, bannedby, banreason) VALUES ('".$results_accounttransaction_account["id"]."', 'WAM', 'WAM')");
		break;

		// Bann feloldása
		case "unbann":
		db_query("DELETE FROM account_banned WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Játékos
		case "gmlevelplayer":
		db_query("DELETE FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> VIP
		case "gmlevelvip":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_vip."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Moderátor
		case "gmlevelmod":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_mod."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> GM
		case "gmlevelgm":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_gm."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Admin
		case "gmleveladmin":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_admin."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		default:
		system_message("Hiba történt a mûvelet elvégzése közben!");
		break;

	}

	system_message("Sikeresen elvégeztük a mûveletet!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.accountname.value == "") { alert( "Nem töltötted ki az account név mezõt!" ); form.accountname.focus(); return false; } else { if (form.accountname.value.length < 3) { alert( "Az account név túl rövid!" ); form.accountname.focus(); return false; } }
				 if (form.action.value == "") { alert( "Nem választottál mûveletet!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Cuentas de Dynamite - Gestor Adminsitracion<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="Játékos mûveletek" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Információ" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Añade rango de GM, banea cuentas, desbanea... SOLO STAFF. - Administradores -
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=account-transaction" method="POST" onsubmit="return checkform(accountransaction);" name="accountransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Nombre de Cuenta: <input name="accountname" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>???</option><option value="delete">Borrar</option><option value="bann">Banear</option><option value="unbann">Desbanear</option><option value="gmlevelplayer">Rango --> Játékos</option><option value="gmlevelvip">Rango --> VIP</option><option value="gmlevelmod">Rango --> Moderátor</option><option value="gmlevelgm">Rango -- > GM</option><option value="gmleveladmin">Rango --> Admin</option></select> <input type="submit" value="Editar" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>