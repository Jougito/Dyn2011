<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,notbanned");

// Información de cuenta
$query_logged = db_query("SELECT joindate, last_ip, last_login, nombrepj FROM account WHERE id = '".$user_check_accountid."'");
$results_logged = mysqli_fetch_array($query_logged);

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
	string_check($post_chartrans_mycharacter, 32, ">", "El nombre del PJ no es válido!");
	string_check($post_chartrans_mycharacter, "^[0-9%]+$", "!ereg", "El nombre del PJ no es válido II!");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_chartrans_mycharacter);

	// Csatlakozás a realmd adatbázishoz
	db_select($mysql_db_realmd);

	// Account adatok lekérdezése
	$query_chartrans_account = db_query("SELECT id FROM account WHERE username = '".$post_chartrans_account."'");
	$results_chartrans_account = mysqli_fetch_array($query_chartrans_account);

	if(mysqli_num_rows($query_chartrans_account) == 0){

		system_message("La cuenta que has indicado no existe.");

	}

	// Csatlakozás a characters adatbázishoz
	db_select($mysql_db_realmd);

	// Karakter áthelyezése
	db_query("UPDATE account SET nombrepj = ".$results_chartrans_check_account["name"]." WHERE id = '".$user_check_accountid."'");

	// Karakter áthelyezések naplózása
	site_log("seleccion-pj", "IP: ".$site_ip." | Titula4 de cuenta: ".$user_check_accountname." | PJ: ".$results_chartrans_check_account["name"]." | Cuenta Destino: ".$post_chartrans_account." | Fecha: ".$site_date."");

	system_message("Tu personaje se ha seleccionado satisfactoriamente.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "No se ha seleccionado un personaje." ); form.mycharacter.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia - Recompensar PJ 1/2<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Donacion" />
				 
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
						  
						  Aquí puedes transferir un PJ a otra cuenta, siempre y cuando no estes baneado.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=recompensas" method="POST" onsubmit="return checkform(chartrans);" name="chartrans"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
					     <td width="150px" align="center">
						 Personaje seleccionado para Recompensar: <b><?php echo $results_logged["nombrepj"]; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 Identificador de la cuenta Recompensada: <b><?php echo $user_check_accountid; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 IP de la cuenta: <b><i>[Oculta]</i></b>
						</p>
						 </td>
					   </tr>
				   <tr></p><center><h1>Selecciona un personaje para recompensar</h1></center>
				     <td align="center">
					 Nombre de PJ: <select name="mycharacter">
					 
					 <option SELECTED value="">Ninguno seleccionado</option>
					 
					 <?php
					 
					 while($results_chartrans_characters = mysqli_fetch_array($query_chartrans_characters)){
					 
					 echo '<option value="'.$results_chartrans_characters["guid"].'">'.$results_chartrans_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					
					 
					 </select> </p><input type="submit" value="Seleccionar Recompensa" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
