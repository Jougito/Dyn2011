<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addmoney");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_addmoney_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["money"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok átalakítás
	$post_addmoney_money = variable($_POST["money"], "", "db");
	$post_addmoney_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_addmoney_money, "^[0-9%]+$", "!ereg", "Hibásan adtad meg az arany mennyiségét!");
	string_check($post_addmoney_money, 5, ">", "Ilyen sok aranyat egyszerre nem tudsz addolni!");
	string_check($post_addmoney_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input értéke hibás!");
	string_check($post_addmoney_mycharacter, 32, ">", "A karakter input értéke hibás!");

	// A karakter tulajdonosának ellenõrzése
	character_check($post_addmoney_mycharacter);
	
	// Jelenlegi pénz lekérése
	$query_addmoney_money = db_query("SELECT money FROM characters WHERE guid = '".$post_addmoney_mycharacter."'");
	$results_addmoney_money = mysqli_fetch_array($query_addmoney_money);

	$post_addmoney_money = $post_addmoney_money * 10000;
	$post_addmoney_money_final = $post_addmoney_money + $results_addmoney_money["money"];

	// Pénz frissítése
	db_query("UPDATE characters SET money = '".$post_addmoney_money_final."' WHERE guid = '".$post_addmoney_mycharacter."'");

	system_message("Sikeresen frissítettük a pénzed!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.money.value == "") { alert( "Nem adtad meg az aranyat!" ); form.money.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Pénz addolás<img class="nav-icon" src="<?php echo theme_file("images/icons/coins.png"); ?>" alt="Pénz addolás" />
				 
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
						  
						  Válasszd ki az addolni kívánt karaktert majd kattints az addolás gombra!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-money" method="POST" onsubmit="return checkform(addmoney);" name="addmoney"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">Válassz!</option>
					 
					 <?php
					 
			        while($results_addmoney_characters = mysqli_fetch_array($query_addmoney_characters)){
					 
						 echo '<option value="'.$results_addmoney_characters["guid"].'">'.$results_addmoney_characters["name"].'</option>';
						 
					}
					 
					 ?>
					 
					 </select> Arany: <input maxlength="5" type="text" name="money" /> <input type="submit" value="Addolás" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>