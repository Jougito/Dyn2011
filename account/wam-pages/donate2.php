<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,notbanned");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Karakterek lek�rdez�se
$query_chartrans_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["account"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok �talak�t�s
	$post_chartrans_account = variable($_POST["account"], "", "db");
	$post_chartrans_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellen�rz�se
	string_check($post_chartrans_account, 32, ">", "Az account n�v t�l hossz�!");
	string_check($post_chartrans_mycharacter, 32, ">", "A karakter input �rt�ke hib�s!");
	string_check($post_chartrans_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input �rt�ke hib�s!");

	// A karakter tulajdonos�nak ellen�rz�se
	character_check($post_chartrans_mycharacter);

	// Csatlakoz�s a realmd adatb�zishoz
	db_select($mysql_db_realmd);

	// Account adatok lek�rdez�se
	$query_chartrans_account = db_query("SELECT id FROM account WHERE username = '".$post_chartrans_account."'");
	$results_chartrans_account = mysqli_fetch_array($query_chartrans_account);

	if(mysqli_num_rows($query_chartrans_account) == 0){

		system_message("La cuenta que has indicado no existe.");

	}

	// Csatlakoz�s a characters adatb�zishoz
	db_select($mysql_db_characters);

	// Karakter �thelyez�se
	db_query("UPDATE characters SET account = '".$results_chartrans_account["id"]."' WHERE guid = '".$post_chartrans_mycharacter."'");

	// Karakter �thelyez�sek napl�z�sa
	site_log("character-transfer", "IP: ".$site_ip." | Titula4 de cuenta: ".$user_check_accountname." | PJ: ".$results_chartrans_check_account["name"]." | Cuenta Destino: ".$post_chartrans_account." | Fecha: ".$site_date."");

	system_message("Tu personaje se ha eviado satisfactoriamente.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "No se ha seleccionado un personaje." ); form.mycharacter.focus(); return false; }
				 if (form.account.value == "") { alert( "No has indicado una cuenta de destino." ); form.account.focus(); return false; } else { if (form.account.value.length < 3) { alert( "El nombre de cuenta es demasiado corto." ); form.account.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia - Transferir PJ a otra cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Karakter �thelyez�s" />
				 
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
						  
						  Aqu� puedes transferir un PJ a otra cuenta, siempre y cuando no estes baneado.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=donate2" method="POST" onsubmit="return checkform(chartrans);" name="chartrans"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
					     <td width="150px" align="center">
						 Titular de la cuenta de origen: <b><?php echo $user_check_accountname; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 Identificador de la cuenta de origen: <b><?php echo $user_check_accountid; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 IP de la cuenta de origen: <b><i>[Oculta]</i></b>
						</p>
						 </td>
					   </tr>
				   <tr>
				     <td align="center">
					 Nombre de PJ: <select name="mycharacter">
					 
					 <option SELECTED value="">Ninguno seleccionado</option>
					 
					 <?php
					 
					 while($results_chartrans_characters = mysqli_fetch_array($query_chartrans_characters)){
					 
					 echo '<option value="'.$results_chartrans_characters["guid"].'">'.$results_chartrans_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					
					 
					 </select></p> Cuenta de destino: <font class="mini"><a title="Aqu� debes indicar el nombre de cuenta a donde quieres enviar tu PJ." href="#">[Ayuda]</a></font> <input maxlength="32" type="text" name="account" /> </p><input type="submit" value="Enviar PJ" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
