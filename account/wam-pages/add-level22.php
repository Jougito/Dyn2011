<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addlevel");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Karakterek lek�rdez�se
$query_addlevel_characters = db_query("SELECT guid, name, level FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["mycharacter"])){

	// Posztolt adatok �talak�t�s
	$post_addlevel_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellen�rz�se
	string_check($post_addlevel_mycharacter, 32, ">", "A karakter mez� �rt�ke hib�s!");
	string_check($post_addlevel_mycharacter, "^[0-9%]+$", "!ereg", "A karakter mez� �rt�ke hib�s!");

	// A karakter tulajdonos�nak ellen�rz�se
	character_check($post_addlevel_mycharacter);

	$query_addlevel_characters_check = db_query("SELECT level FROM characters WHERE guid = '".$post_addlevel_mycharacter."'");
	$results_addlevel_characters_check = mysqli_fetch_array($query_addlevel_characters_check);

	if($results_addlevel_characters_check["level"] > 9){

		system_message("M�r meghaladtad a 10-es szintet!");

	}

	// Szint friss�t�se
	db_query("UPDATE characters SET level = '80' WHERE guid = '".$post_addlevel_mycharacter."'");

	system_message("Sikeresen friss�tett�k a szinted!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem v�lasztott�l karaktert!" ); form.mycharacter.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Szint addol�s<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Szint addol�s" />
				 
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
						  
						  V�laszd ki az addolni k�v�nt karaktert majd kattints az addol�s gombra! Csak akkor tudsz szintet adni a karakterednek ha az m�g nem haladta meg a 10-es szintet!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-level" method="POST" onsubmit="return checkform(addlevel);" name="addlevel"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">V�lassz!</option>
					 
					 <?php
					 
					 while($results_addlevel_characters = mysqli_fetch_array($query_addlevel_characters)){
					 
					 echo '<option value="'.$results_addlevel_characters["guid"].'">'.$results_addlevel_characters["name"].' ('.$results_addlevel_characters["level"].')</option>';
					 
					 }
					 
					 ?>
					 
					 </select> <input type="submit" value="Addol�s" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>