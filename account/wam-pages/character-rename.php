<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,charrename");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Karakterek lek�rdez�se
$query_charrename_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["newname"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok �talak�t�s
	$post_charrename_newname = variable($_POST["newname"], "strtolower,ucfirst", "db");
	$post_charrename_mycharacter = variable($_POST["mycharacter"], "", "db");
	
	// N�v haszn�lhat�s�g�nak ellen�rz�se
	$char_check_query = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_charrename_newname."'");
	$char_check = mysqli_fetch_array($char_check_query);
	
	if($char_check[0] != 0){
	
		system_message("Ezt a nevet m�r haszn�lja valaki!");
	
	}

	// Inputok ellen�rz�se
	string_check($post_charrename_newname, 12, ">", "Az �j n�v t�l hossz�!");
	string_check($post_charrename_newname, 2, "<", "Az �j n�v t�l r�vid!");
	string_check($post_charrename_newname, "^[a-zA-Z%]+$", "!ereg", "Az �j n�v tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_charrename_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input �rt�ke hib�s!");
	string_check($post_charrename_mycharacter, 32, ">", "A karakter mez� �rt�ke hib�s!");

	// A karakter tulajdonos�nak ellen�rz�se
	character_check($post_charrename_mycharacter);

	// N�v friss�t�se
	db_query("UPDATE characters SET name = '".$post_charrename_newname."' WHERE guid = '".$post_charrename_mycharacter."'");

	system_message("Sikeresen �tnevezt�k a karaktered!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem v�lasztott�l karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.newname.value == "") { alert( "Nem adtad meg az �j nevet!" ); form.newname.focus(); return false; } else { if (form.newname.value.length < 2) { alert( "Az �j n�v t�l r�vid!" ); form.newname.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Karakter �tnevez�s<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Karakter �tnevez�s" />
				 
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
						  
						  V�laszd ki az �tnevezni k�v�nt karaktert, majd add meg az �j nev�t. �gyelj arra hogy a karakter neved csak az angol ABC bet�it tartalmazhatja.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=character-rename" method="POST" onsubmit="return checkform(charrename);" name="charrename"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">V�lassz!</option>
					 
					 <?php
					 
					 while($results_charrename_characters = mysqli_fetch_array($query_charrename_characters)){
					 
						 echo '<option value="'.$results_charrename_characters["guid"].'">'.$results_charrename_characters["name"].'</option>';
						 
					 }
					 
					 ?>
					 
					 </select> �j n�v: <input maxlength="12" type="text" name="newname" /> <input type="submit" value="�tnevez�s" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
