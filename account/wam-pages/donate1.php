<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,charrename");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Ordenar PJs
$query_charrename_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["newname"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok átalakítás
	$post_charrename_newname = variable($_POST["newname"], "strtolower,ucfirst", "db");
	$post_charrename_mycharacter = variable($_POST["mycharacter"], "", "db");
	
	// Checkeo de nombre de personaje
	$char_check_query = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_charrename_newname."'");
	$char_check = mysqli_fetch_array($char_check_query);
	
	if($char_check[0] != 0){
	
		system_message("Este nombre ya está siendo utilizado por otra persona.");
	
	}

	// Inputok ellenõrzése
	string_check($post_charrename_newname, 12, ">", "El nombre de PJ no puede ser mayor de 12 letras.");
	string_check($post_charrename_newname, 3, "<", "El nombre de PJ no puede ser menor de 3 letras.");
	string_check($post_charrename_newname, "^[a-zA-Z%]+$", "!ereg", "El nuevo nombre contiene caracteres no permitidos.");
	string_check($post_charrename_mycharacter, "^[0-9%]+$", "!ereg", "El valor de la entrada tiene un carácter erroneo.");
	string_check($post_charrename_mycharacter, 32, ">", "El campo es incorrecto.");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_charrename_mycharacter);

	// Query a ejecutar
	db_query("UPDATE characters SET name = '".$post_charrename_newname."' WHERE guid = '".$post_charrename_mycharacter."'");
	db_query("UPDATE");

	system_message("La operación se ha realizado con éxito.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "No se ha seleccionado un personaje." ); form.mycharacter.focus(); return false; }
				 if (form.newname.value == "") { alert( "No se ha escrito un nombre nuevo." ); form.newname.focus(); return false; } else { if (form.newname.value.length < 2) { alert( "El nuevo nombre es demasiado corto." ); form.newname.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia - Renombrar Personaje<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Karakter átnevezés" />
				 
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
						  
						  Aquí puedes renombrar un personaje de tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=donate1" method="POST" onsubmit="return checkform(charrename);" name="charrename"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="left">
					 Personajes en mi Cuenta: <select name="mycharacter">
					 
					 <option SELECTED value="">Ninguno Seleccionado</option>
					 
					 <?php
					 
					 while($results_charrename_characters = mysqli_fetch_array($query_charrename_characters)){
					 
						 echo '<option value="'.$results_charrename_characters["guid"].'">'.$results_charrename_characters["name"].'</option>';
						 
					 }
					 
					 ?>
					
					 
				     </td>
				   </tr>
					<tr>
<td>
</select>  Nuevo nombre de mi PJ: <input maxlength="12" type="text" name="newname" />
</td>
<td>
<input type="submit" value="Actualizar" class="input-sbm" />
</td>
					</tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
