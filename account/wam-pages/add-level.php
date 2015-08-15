<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addlevel");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_addlevel_characters = db_query("SELECT guid, name, level FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["mycharacter"])){

	// Posztolt adatok átalakítás
	$post_addlevel_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_addlevel_mycharacter, 32, ">", "A karakter mezõ értéke hibás!");
	string_check($post_addlevel_mycharacter, "^[0-9%]+$", "!ereg", "A karakter mezõ értéke hibás!");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_addlevel_mycharacter);

	$query_addlevel_characters_check = db_query("SELECT level FROM characters WHERE guid = '".$post_addlevel_mycharacter."'");
	$results_addlevel_characters_check = mysqli_fetch_array($query_addlevel_characters_check);

	if($results_addlevel_characters_check["level"] > 9){

		system_message("Már meghaladtad a 10-es szintet!");

	}

	// Szint frissítése
	db_query("UPDATE characters SET level = '80' WHERE guid = '".$post_addlevel_mycharacter."'");

	system_message("Sikeresen frissítettük a szinted!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Szint addolás<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Szint addolás" />
				 
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
						  
						  Válaszd ki az addolni kívánt karaktert majd kattints az addolás gombra! Csak akkor tudsz szintet adni a karakterednek ha az még nem haladta meg a 10-es szintet!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-level" method="POST" onsubmit="return checkform(addlevel);" name="addlevel"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">Válassz!</option>
					 
					 <?php
					 
					 while($results_addlevel_characters = mysqli_fetch_array($query_addlevel_characters)){
					 
					 echo '<option value="'.$results_addlevel_characters["guid"].'">'.$results_addlevel_characters["name"].' ('.$results_addlevel_characters["level"].')</option>';
					 
					 }
					 
					 ?>
					 
					 </select> <input type="submit" value="Addolás" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>