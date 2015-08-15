<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,not-banned");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["playername"])){

	// Posztolt adatok �talak�t�s
	$post_playertransaction_playername = variable($_POST["playername"], "", "db");

	// Posztolt adatok ellen�rz�se
	string_check($post_playertransaction_playername, 32, ">", "Error con el nombre de PJ");

	// J�t�kos ellen�rz�se
	$query_playertransaction_check = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_playertransaction_playername."'");
	$results_playertransaction_check = mysqli_fetch_array($query_playertransaction_check);
	if($results_playertransaction_check[0] == 0){

		system_message("El Personaje no existe.");

	}

	// M�velet elv�gz�se
	switch($site_post_action){

		// Karakter t�rl�se
		case "delete":

		// Guid lek�r�se
		$query_playertransaction_guid = db_query("SELECT guid, name FROM characters WHERE name = '".$post_playertransaction_playername."'");
		$results_playertransaction_guid = mysqli_fetch_array($query_playertransaction_guid);

		db_query("DELETE FROM characters WHERE name = '".$results_playertransaction_guid["name"]."'");
		db_query("DELETE FROM arena_team_member WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_account_data WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_achievement WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_achievement_progress WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_action WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_aura WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_battleground_data WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_declinedname WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_equipmentsets WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_gifts WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_glyphs WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_homebind WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_inventory WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_queststatus WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_queststatus_daily WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_reputation WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_skills WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_social WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_spell WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_spell_cooldown WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_talent WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM corpse WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_aura WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_spell WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_spell_cooldown WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM guild_member WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM item_instance WHERE owner_guid = '".$results_playertransaction_guid["guid"]."'");

		break;

		// Szint null�z�s
		case "level":
		db_query("UPDATE characters SET level = '1' WHERE name = '".$post_playertransaction_playername."'");
		break;

		// P�nz null�z�s
		case "money":
		db_query("UPDATE characters SET money = '0' WHERE name = '".$post_playertransaction_playername."'");
		break;

		// Creditos de Cuenta
		case "creditos":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET creditos = (creditos +10) WHERE username = '".$post_playertransaction_playername."'");
		break;

		// Bloquear cuenta
		case "bloq":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET locked = 1, last_ip = 1 WHERE username = '".$post_playertransaction_playername."'");
		break;

		// Bloquear cuenta
		case "unloq":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET locked = 0 WHERE username = '".$post_playertransaction_playername."'");
		break;

		default:
		system_message("Error al realizar la operacion!");
		break;

	}

	system_message("Operaci�n realizada con �xito.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Indica el nombre del jugador!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "A j�t�kos n�v t�l r�vid!" ); form.playername.focus(); return false; } }
				 if (form.action.value == "") { alert( "Nem v�lasztott�l m�veletet!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Operaciones con PJs<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="J�t�kos m�veletek" />
				 
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
						  
						  A�ade oro predeterminado a un jugador, borra el jugador...
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=gestion_gm" method="POST" onsubmit="return checkform(playertransaction);" name="playertransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Nombre de Jugador o Cuenta: <input name="playername" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>???</option><option value="delete">Borrar</option><option value="level">Reiniciar Nivel a 1</option><option value="money">Reiniciar Oro a 0</option><option value="creditos">A�adir 10 Cr�ditos</option><option value="bloq">Baneo Preventivo</option><option value="unloq">Desbaneo</option></select> <input type="submit" value="Enviar" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
