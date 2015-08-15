<?php

// Fájl ellenõrzése
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
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Információ" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Itt láthatod a projekthez tartozó információkat és a <em>settings (beállítások)</em> fájl adatait.
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="180px">
						 Projekt név:
						 </td>
						 <td align="left">
						 <b>Web Account Manager</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Fejlesztõ:
						 </td>
						 <td align="left">
						 <b>Kálmán Roland (Pradox)</b>
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
						 Jelenlegi verzió:
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
						 MySQL felhasználónév:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_username; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL jelszó:
						 </td>
						 <td align="left">
						 <b>Nem látható</b> <a href="#" title="Biztonsági okokból a MySQL jelszó nem látható"><font class="mini">[?]</font></a>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL realmd adatbázis:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_realmd; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL characters adatbázis:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_characters; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL world adatbázis:
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
						 Az adminisztrátor email címe:
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
						 <b>Játékos (<?php echo $wam_gmlevel_player; ?>), VIP (<?php echo $wam_gmlevel_vip; ?>), Moderátor (<?php echo $wam_gmlevel_mod; ?>), GM (<?php echo $wam_gmlevel_gm; ?>), Admin (<?php echo $wam_gmlevel_admin; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Kiegészítõk:
						 </td>
						 <td align="left">
						 <b>Classic (<?php echo $wam_expansion_classic; ?>), BC (<?php echo $wam_expansion_bc; ?>), WOTLK (<?php echo $wam_expansion_wotlk; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP részleg:
						 </td>
						 <td align="left">
						 <b><?php if($wam_vip_enable==0){ echo "Letiltva"; } elseif ($wam_vip_enable==1) { echo "Engedélyezve"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP funkciók:
						 </td>
						 <td align="left">
						 <b>Item addolás (
						 
						 <?php if($wam_vip_enable_additem==0){ echo "Letiltva"; } elseif ($wam_vip_enable_additem==1) { echo "Engedélyezve"; } ?>), Szint addolás (<?php if($wam_vip_enable_addlevel==0){ echo "Letiltva"; } elseif ($wam_vip_enable_addlevel==1) { echo "Engedélyezve"; } ?>), Pénz addolás (<?php if($wam_vip_enable_addmoney==0){ echo "Letiltva"; } elseif ($wam_vip_enable_addmoney==1) { echo "Engedélyezve"; } ?>), Karakter átvenezés (<?php if($wam_vip_enable_charrename==0){ echo "Letiltva"; } elseif ($wam_vip_enable_charrename==1) { echo "Engedélyezve"; } ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Biztonsági naplózások:
						 </td>
						 <td align="left">
						 <b><?php if($site_log_enable==0){ echo "Letiltva"; } elseif ($site_log_enable==1) { echo "Engedélyezve"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Oldal cím:
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
						 Oldal téma:
						 </td>
						 <td align="left">
						 <b><?php echo $site_theme; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Keresõ robotok:
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
						 Felugró ablak:
						 </td>
						 <td align="left">
						 <b><?php if(empty($site_popup)){ echo "Letiltva"; } else { echo "Engedélyezve (Szöveg: ".$site_popup.")"; } ?></b>
						 </td>
					   </tr>
					</table>
					
				 </td>
			   </tr>
			 </table>