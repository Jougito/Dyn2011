<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Datos del Gestor<img class="nav-icon" src="<?php echo theme_file("images/icons/alert-window.png"); ?>" alt="Rendszer adatok" />
				 
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
						  
						  Itt l�thatod a projekthez tartoz� inform�ci�kat �s a <em>settings (be�ll�t�sok)</em> f�jl adatait.
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="180px">
						 Projekt n�v:
						 </td>
						 <td align="left">
						 <b>Web Account Manager</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Fejleszt�:
						 </td>
						 <td align="left">
						 <b>K�lm�n Roland (Pradox)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Kapcsolat:
						 </td>
						 <td align="left">
						 <b>pradox@index.hu (MSN), pradoxblog@gmail.com (Email)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Jelenlegi verzi�:
						 </td>
						 <td align="left">
						 <b><?php echo $wam_version; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Weboldal:
						 </td>
						 <td align="left">
						 <b><a target="_blank" href="http://wam.nwhost.hu/">http://wam.nwhost.hu/</a></b>
						 </td>
					   </tr>
					   </tr>
					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					   <tr>
					     <td align="right" width="180px;">
						 MySQL hoszt:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_host; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL felhaszn�l�n�v:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_username; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL jelsz�:
						 </td>
						 <td align="left">
						 <b>Nem l�that�</b> <a href="#" title="Biztons�gi okokb�l a MySQL jelsz� nem l�that�"><font class="mini">[?]</font></a>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL realmd adatb�zis:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_realmd; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL characters adatb�zis:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_characters; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL world adatb�zis:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_world; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 A szerver realmlistje:
						 </td>
						 <td align="left">
						 <b><?php echo $wam_realmlist; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Az adminisztr�tor email c�me:
						 </td>
						 <td align="left">
						 <b><?php echo $site_admin_email; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Rangok:
						 </td>
						 <td align="left">
						 <b>J�t�kos (<?php echo $wam_gmlevel_player; ?>), VIP (<?php echo $wam_gmlevel_vip; ?>), Moder�tor (<?php echo $wam_gmlevel_mod; ?>), GM (<?php echo $wam_gmlevel_gm; ?>), Admin (<?php echo $wam_gmlevel_admin; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Kieg�sz�t�k:
						 </td>
						 <td align="left">
						 <b>Classic (<?php echo $wam_expansion_classic; ?>), BC (<?php echo $wam_expansion_bc; ?>), WOTLK (<?php echo $wam_expansion_wotlk; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP r�szleg:
						 </td>
						 <td align="left">
						 <b><?php if($wam_vip_enable==0){ echo "Letiltva"; } elseif ($wam_vip_enable==1) { echo "Enged�lyezve"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP funkci�k:
						 </td>
						 <td align="left">
						 <b>Item addol�s (
						 
						 <?php if($wam_vip_enable_additem==0){ echo "Letiltva"; } elseif ($wam_vip_enable_additem==1) { echo "Enged�lyezve"; } ?>), Szint addol�s (<?php if($wam_vip_enable_addlevel==0){ echo "Letiltva"; } elseif ($wam_vip_enable_addlevel==1) { echo "Enged�lyezve"; } ?>), P�nz addol�s (<?php if($wam_vip_enable_addmoney==0){ echo "Letiltva"; } elseif ($wam_vip_enable_addmoney==1) { echo "Enged�lyezve"; } ?>), Karakter �tvenez�s (<?php if($wam_vip_enable_charrename==0){ echo "Letiltva"; } elseif ($wam_vip_enable_charrename==1) { echo "Enged�lyezve"; } ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Biztons�gi napl�z�sok:
						 </td>
						 <td align="left">
						 <b><?php if($site_log_enable==0){ echo "Letiltva"; } elseif ($site_log_enable==1) { echo "Enged�lyezve"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Oldal c�m:
						 </td>
						 <td align="left">
						 <b><?php echo $site_title; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Szerver honlap:
						 </td>
						 <td align="left">
						 <b><a target="_blank" href="<?php echo $site_server_site; ?>"><?php echo $site_server_site; ?></a></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Oldal t�ma:
						 </td>
						 <td align="left">
						 <b><?php echo $site_theme; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Keres� robotok:
						 </td>
						 <td align="left">
						 <b><?php echo $site_meta_robots; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Kulcsszavak:
						 </td>
						 <td align="left">
						 <b><?php echo $site_meta_keywords; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Felugr� ablak:
						 </td>
						 <td align="left">
						 <b><?php if(empty($site_popup)){ echo "Letiltva"; } else { echo "Enged�lyezve (Sz�veg: ".$site_popup.")"; } ?></b>
						 </td>
					   </tr>
					</table>
					
				 </td>
			   </tr>
			 </table>