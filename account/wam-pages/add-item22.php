<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,additem");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Karakterek lek�rdez�se
$query_additem_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["itemid"]) && !empty($_POST["mycharacter"])){

	// Posztolt adatok �talak�t�s
	$post_additem_itemid = variable($_POST["itemid"], "", "db");
	$post_additem_mycharacter = variable($_POST["mycharacter"], "", "db");
	$post_additem_count = variable($_POST["count"], "", "db");

	// Inputok ellen�rz�se
	string_check($post_additem_itemid, "^[0-9%]+$", "!ereg", "Hib�san adtad meg az item ID-j�t!");
	string_check($post_additem_itemid, 10, ">", "Az item ID-je t�l hossz�!");
	string_check($post_additem_count, "^[0-9%]+$", "!ereg", "Hib�s a darabsz�m input �rt�ke!");
	string_check($post_additem_count, 1, ">", "A darabsz�mt�l hossz�!");
	string_check($post_additem_mycharacter, "^[0-9%]+$", "!ereg", "A karakter input �rt�ke hib�s!");
	string_check($post_additem_mycharacter, 32, ">", "A karakter input �rt�ke hib�s!");

	// A karakter tulajdonos�nak ellen�rz�se
	character_check($post_additem_mycharacter);

	// Csatlakoz�s a world adatb�zishoz
	db_select($mysql_db_world);

	// Item l�tez�s�nek ellen�rz�se
	$query_additem_check_item = db_query("SELECT COUNT(*) FROM item_template WHERE entry = '".$post_additem_itemid."'");
	$results_additem_check_item = mysqli_fetch_array($query_additem_check_item);
	
	if($results_additem_check_item[0] == 0){

		system_message("Az item nem tal�lhat� az adatb�zisban! (".$post_additem_itemid.")");

	}

	// Csatlakoz�s a characters adatb�zishoz
	db_select($mysql_db_characters);

	// ITEM ELK�LD�SE, INGAME LEV�LBEN

	// 1. L�P�S
	// A legnagyobb ID �rt�k lek�rdez�se
	$query_additem_step1 = db_query("SELECT MAX(guid) FROM item_instance");
	$results_additem_step1 = mysqli_fetch_array($query_additem_step1);
	$additem_id_step1 = $results_additem_step1[0] + 1;

	// �j sor besz�r�sa
	db_query("INSERT INTO item_instance (guid, owner_guid, data) VALUES (".$additem_id_step1.", '".$post_additem_mycharacter."', '".$additem_id_step1." 1073741824 3 ".$post_additem_itemid." 1065353216 0 24 0 0 0 0 0 0 0 ".$post_additem_count." 0 4294967295 0 0 0 0 64 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 500 0 0 ')");

	// 2. L�P�S
	// A legnagyobb ID �rt�k lek�rdez�se
	$query_additem_step2 = db_query("SELECT MAX(id) FROM mail");
	$results_additem_step2 = mysqli_fetch_array($query_additem_step2);
	$additem_id_step2 = $results_additem_step2[0] + 1;

	// �j sor besz�r�sa
	db_query("INSERT INTO `mail` (`id`, `messageType`, `stationery`, `mailTemplateId`, `sender`, `receiver`, `subject`, `itemTextId`, `has_items`, `expire_time`, `deliver_time`, `money`, `cod`, `checked`) VALUES
	(".$additem_id_step2.", 0, 41, 0, 0, ".$post_additem_mycharacter.", 'WAM - VIP ITEM', 0, 1, 0, 0, 0, 0, 0)");

	// 3. L�P�S
	// �j sor besz�r�sa
	db_query("INSERT INTO `mail_items` (`mail_id`, `item_guid`, `item_template`, `receiver`) VALUES
	(".$additem_id_step2.", ".$additem_id_step1.", ".$post_additem_itemid.", ".$post_additem_mycharacter.")");

	// Biztons�gi napl�z�s k�sz�t�se (item addol�s)
	site_log("add-item", "IP: ".$site_ip." | Account n�v: ".$user_check_accountname." | Karakter ID: ".$post_additem_mycharacter." | Item mennyis�g: ".$post_additem_count." | D�tum: ".$site_date."");
	
	system_message("Sikeresen elk�ldt�k az �ltalad k�rt itemet!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem v�lasztott�l karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.itemid.value == "") { alert( "Nem adtad meg az item ID-j�t!" ); form.itemid.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Item addol�s<img class="nav-icon" src="<?php echo theme_file("images/icons/ipod.png"); ?>" alt="Item addol�s" />
				 
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
						  
						  V�lasszd ki az addolni k�v�nt karaktert majd kattints az addol�s gombra! Az addolt itemeket ingame lev�lben k�ldj�k el a karakterednek.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-item" method="POST" onsubmit="return checkform(additem);" name="additem"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Karakter: <select name="mycharacter">
					 
					 <option SELECTED value="">V�lassz!</option>
					 
					 <?php
					 
					 while($results_additem_characters = mysqli_fetch_array($query_additem_characters)){
					 
					 echo '<option value="'.$results_additem_characters["guid"].'">'.$results_additem_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					 
					 </select> Item ID: <input maxlength="10" type="text" name="itemid" /> Darabsz�m: <select name="count"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select> <input type="submit" value="Addol�s" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>