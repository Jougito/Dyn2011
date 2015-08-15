<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,charrename");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_charrename_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["newname"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok átalakítás
	$post_charrename_newname = variable($_POST["newname"], "strtolower,ucfirst", "db");
	$post_charrename_mycharacter = variable($_POST["mycharacter"], "", "db");
	
	// Név használhatóságának ellenõrzése
	$char_check_query = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_charrename_newname."'");
	$char_check = mysqli_fetch_array($char_check_query);
	
	if($char_check[0] != 0){
	
		system_message("Ezt a nevet már használja valaki!");
	
	}

	// Inputok ellenõrzése
	string_check($post_charrename_newname, 12, ">", "Az új név túl hosszú!");
	string_check($post_charrename_newname, 2, "<", "Az új név túl rövid!");
	string_check($post_charrename_newname, "^[a-zA-Z%]+$", "!ereg", "Az új név tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_charrename_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input értéke hibás!");
	string_check($post_charrename_mycharacter, 32, ">", "A karakter mezõ értéke hibás!");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_charrename_mycharacter);

	// Név frissítése
	db_query("UPDATE characters SET name = '".$post_charrename_newname."' WHERE guid = '".$post_charrename_mycharacter."'");

	system_message("Sikeresen átneveztük a karaktered!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.newname.value == "") { alert( "Nem adtad meg az új nevet!" ); form.newname.focus(); return false; } else { if (form.newname.value.length < 2) { alert( "Az új név túl rövid!" ); form.newname.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Karakter átnevezés<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Karakter átnevezés" />
				 
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
						  
						  Válaszd ki az átnevezni kívánt karaktert, majd add meg az új nevét. Ügyelj arra hogy a karakter neved csak az angol ABC betûit tartalmazhatja.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=character-rename" method="POST" onsubmit="return checkform(charrename);" name="charrename"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">Válassz!</option>
					 
					 <?php
					 
					 while($results_charrename_characters = mysqli_fetch_array($query_charrename_characters)){
					 
						 echo '<option value="'.$results_charrename_characters["guid"].'">'.$results_charrename_characters["name"].'</option>';
						 
					 }
					 
					 ?>
					 
					 </select> Új név: <input maxlength="12" type="text" name="newname" /> <input type="submit" value="Átnevezés" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
