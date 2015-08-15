<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,notbanned");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_chartrans_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["account"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok átalakítás
	$post_chartrans_account = variable($_POST["account"], "", "db");
	$post_chartrans_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_chartrans_account, 32, ">", "Nombre de cuenta incorrecto.");
	string_check($post_chartrans_mycharacter, 32, ">", "Nombre de PJ incorrecto.");
	string_check($post_chartrans_mycharacter, "^[0-9%]+$", "!ereg", "Nombre de PJ incorrecto.");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_chartrans_mycharacter);

	// Csatlakozás a realmd adatbázishoz
	db_select($mysql_db_realmd);

	// Account adatok lekérdezése
	$query_chartrans_account = db_query("SELECT id FROM account WHERE username = '".$post_chartrans_account."'");
	$results_chartrans_account = mysqli_fetch_array($query_chartrans_account);

	if(mysqli_num_rows($query_chartrans_account) == 0){

		system_message("La cuenta que has introducido no existe!");

	}

	// Csatlakozás a characters adatbázishoz
	db_select($mysql_db_characters);

	// Karakter áthelyezése
	db_query("UPDATE characters SET account = '".$results_chartrans_account["id"]."' WHERE guid = '".$post_chartrans_mycharacter."'");

	// Karakter áthelyezések naplózása
	site_log("asoirlegustaelsexo", "IP: ".$site_ip." | Tulajdonos account: ".$user_check_accountname." | Karakter: ".$results_chartrans_check_account["name"]." | Account (ahova került): ".$post_chartrans_account." | Dátum: ".$site_date."");

	system_message("PJ movido correctamente.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Indica un nombre de PJ." ); form.mycharacter.focus(); return false; }
				 if (form.account.value == "") { alert( "Indica el nombre de cuenta de destino." ); form.account.focus(); return false; } else { if (form.account.value.length < 3) { alert( "Nombre de cuenta demasiado corto." ); form.account.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Transferencias de PJs<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="PJs" />
				 
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
						  
						  Aquí puedes transferir tus PJs a otra cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=asoirlegustaelsexo" method="POST" onsubmit="return checkform(chartrans);" name="chartrans"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center"></p> <br>
					 Personaje: <select name="mycharacter">
					 
					 <option SELECTED value="">----------</option>
					 
					 <?php
					 
					 while($results_chartrans_characters = mysqli_fetch_array($query_chartrans_characters)){
					 
					 echo '<option value="'.$results_chartrans_characters["guid"].'">'.$results_chartrans_characters["name"].'</option>';
					 
					 }
					 
					 ?>
<br>
					 <p>
					 </select> <br>Cuenta: <font class="mini"><a title="Erre az accountra fog kerülni a karaktered" href="#">[?]</a></font> <input maxlength="32" type="text" name="account" /> <input type="submit" value="Enviar PJ" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
