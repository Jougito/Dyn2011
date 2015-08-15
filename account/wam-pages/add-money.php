<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addmoney");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Karakterek lek�rdez�se
$query_addmoney_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["money"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok �talak�t�s
	$post_addmoney_money = variable($_POST["money"], "", "db");
	$post_addmoney_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellen�rz�se
	string_check($post_addmoney_money, "^[0-9%]+$", "!ereg", "Hib�san adtad meg az arany mennyis�g�t!");
	string_check($post_addmoney_money, 5, ">", "Ilyen sok aranyat egyszerre nem tudsz addolni!");
	string_check($post_addmoney_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input �rt�ke hib�s!");
	string_check($post_addmoney_mycharacter, 32, ">", "A karakter input �rt�ke hib�s!");

	// A karakter tulajdonos�nak ellen�rz�se
	character_check($post_addmoney_mycharacter);
	
	// Jelenlegi p�nz lek�r�se
	$query_addmoney_money = db_query("SELECT money FROM characters WHERE guid = '".$post_addmoney_mycharacter."'");
	$results_addmoney_money = mysqli_fetch_array($query_addmoney_money);

	$post_addmoney_money = $post_addmoney_money * 10000;
	$post_addmoney_money_final = $post_addmoney_money + $results_addmoney_money["money"];

	// P�nz friss�t�se
	db_query("UPDATE characters SET money = '".$post_addmoney_money_final."' WHERE guid = '".$post_addmoney_mycharacter."'");

	system_message("Sikeresen friss�tett�k a p�nzed!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem v�lasztott�l karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.money.value == "") { alert( "Nem adtad meg az aranyat!" ); form.money.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     P�nz addol�s<img class="nav-icon" src="<?php echo theme_file("images/icons/coins.png"); ?>" alt="P�nz addol�s" />
				 
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
						  
						  V�lasszd ki az addolni k�v�nt karaktert majd kattints az addol�s gombra!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-money" method="POST" onsubmit="return checkform(addmoney);" name="addmoney"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">V�lassz!</option>
					 
					 <?php
					 
			        while($results_addmoney_characters = mysqli_fetch_array($query_addmoney_characters)){
					 
						 echo '<option value="'.$results_addmoney_characters["guid"].'">'.$results_addmoney_characters["name"].'</option>';
						 
					}
					 
					 ?>
					 
					 </select> Arany: <input maxlength="5" type="text" name="money" /> <input type="submit" value="Addol�s" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>