<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["accountname"])){

	// Posztolt adatok �talak�t�s
	$post_accounttransaction_accountname = variable($_POST["accountname"], "strtoupper", "db");

	// Posztolt adatok ellen�rz�se
	string_check($post_playertransaction_playername, ">", 32, "Az account neve t�l hossz�!");
	string_check($post_playertransaction_playername, "<", 3, "Az account neve t�l r�vid!");
	
	// J�t�kos ellen�rz�se
	$query_accounttransaction_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_check = mysqli_fetch_array($query_accounttransaction_check);

	if($results_accounttransaction_check[0] == 0){

		system_message("Az �ltalad keresett account nem l�tezik!");

	}

	// Account ID lek�rdez�se
	$query_accounttransaction_account = db_query("SELECT id FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_account = mysqli_fetch_array($query_accounttransaction_account);

	// Account access besz�r�sa, ha nem l�tezik
	if($site_post_action == "gmlevelvip" || $site_post_action == "gmlevelgm" || $site_post_action == "gmlevelmod" || $site_post_action == "gmleveladmin"){

		$query_accounttransaction_accountaccess = db_query("SELECT COUNT(*) FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		$results_accounttransaction_accountaccess = mysqli_fetch_array($query_accounttransaction_accountaccess);

		if($results_accounttransaction_accountaccess[0] == 0){

			db_query("INSERT INTO account_access (id, gmlevel, RealmID) VALUES ('".$results_accounttransaction_account["id"]."', '0', '1')");

		}

	}

		// M�velet elv�gz�se
		switch($site_post_action){

		// Account t�rl�se
		case "delete":
		db_query("DELETE FROM account WHERE id = '".$results_accounttransaction_account["id"]."'");

		// Csatlakoz�s a characters adatb�zishoz
		db_select($mysql_db_characters);

		// Accounthoz tartoz� karakterek t�rl�se
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

		// Bannol�s
		case "bann":
		db_query("INSERT INTO account_banned (id, bannedby, banreason) VALUES ('".$results_accounttransaction_account["id"]."', 'WAM', 'WAM')");
		break;

		// Bann felold�sa
		case "unbann":
		db_query("DELETE FROM account_banned WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> J�t�kos
		case "gmlevelplayer":
		db_query("DELETE FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> VIP
		case "gmlevelvip":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_vip."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Moder�tor
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
		system_message("Hiba t�rt�nt a m�velet elv�gz�se k�zben!");
		break;

	}

	system_message("Sikeresen elv�gezt�k a m�veletet!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.accountname.value == "") { alert( "Nem t�lt�tted ki az account n�v mez�t!" ); form.accountname.focus(); return false; } else { if (form.accountname.value.length < 3) { alert( "Az account n�v t�l r�vid!" ); form.accountname.focus(); return false; } }
				 if (form.action.value == "") { alert( "Nem v�lasztott�l m�veletet!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Cuentas de Dynamite - Gestor Adminsitracion<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="J�t�kos m�veletek" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Inform�ci�" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  A�ade rango de GM, banea cuentas, desbanea... SOLO STAFF. - Administradores -
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=account-transaction" method="POST" onsubmit="return checkform(accountransaction);" name="accountransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Nombre de Cuenta: <input name="accountname" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>???</option><option value="delete">Borrar</option><option value="bann">Banear</option><option value="unbann">Desbanear</option><option value="gmlevelplayer">Rango --> J�t�kos</option><option value="gmlevelvip">Rango --> VIP</option><option value="gmlevelmod">Rango --> Moder�tor</option><option value="gmlevelgm">Rango -- > GM</option><option value="gmleveladmin">Rango --> Admin</option></select> <input type="submit" value="Editar" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>