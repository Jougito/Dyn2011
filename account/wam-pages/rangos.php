<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Accountok lekérdezése rang alapján (vip)
$query_ranksview_accountacces_vip = db_query( "SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_vip."'");

// Accountok lekérdezése rang alapján (moderátor)
$query_ranksview_accountacces_mod = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_mod."'");

// Accountok lekérdezése rang alapján (gm)
$query_ranksview_accountacces_gm = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_gm."'");

// Accountok lekérdezése rang alapján (admin)
$query_ranksview_accountacces_admin = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_admin."'");

?>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de Rangos<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Rangok áttekintése" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Información" />
						  
						  </td>
						  <td class="location-info-text">
						  
						   Aquí se muestra una lista de MJs con rango en todos los reinos de juego de Dynamite, si salen en color rojo es que no están conectados, y si salen en color verdes es que si están conectados.
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="180px;">
						 Cuentas VIP:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						 if(mysqli_num_rows($query_ranksview_accountacces_vip) != 0){
						 
					    // Accountok lekérdezése rang alapján (vip)
						while($results_ranksview_accountacces_vip = mysqli_fetch_array($query_ranksview_accountacces_vip)){

							$query_ranksview_vip = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_vip["id"]."'");
							$results_rankview_vip = mysqli_fetch_array($query_ranksview_vip);
							
							if($results_rankview_vip["username"] == ""){ $results_rankview_vip["username"] = '<a href="#" title="Usuario">?</a>'; }
							
							// Státusz átalakítása
							switch($results_rankview_vip["online"]){
							
								case 1:
								$results_rankview_vip_online_color = "green";
								break;
								
								case 0:
								$results_rankview_vip_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_vip[] = '<a href="#" title="ID: '.$results_rankview_vip["id"].'"><font color="'.$results_rankview_vip_online_color.'">'.$results_rankview_vip["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_vip);
						 
						 } else { echo "Ninguna cuenta VIP"; }
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 Cuentas de Moderador:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						 if(mysqli_num_rows($query_ranksview_accountacces_mod) != 0){
						 
					    // Accountok lekérdezése rang alapján (moderátor)
						while($results_ranksview_accountacces_mod = mysqli_fetch_array($query_ranksview_accountacces_mod)){

							$query_ranksview_mod = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_mod["id"]."'");
							$results_rankview_mod = mysqli_fetch_array($query_ranksview_mod);
							
							if($results_rankview_mod["username"] == ""){ $results_rankview_mod["username"] = '<a href="#" title="Usuario">?</a>'; }
							
							// Státusz átalakítása
							switch($results_rankview_mod["online"]){
							
								case 1:
								$results_rankview_mod_online_color = "green";
								break;
								
								case 0:
								$results_rankview_mod_online_color = "red";
								break;
							
							}
							
							$array_results_rankview_mod[] = '<a href="#" title="ID: '.$results_rankview_mod["id"].'"><font color="'.$results_rankview_mod_online_color.'">'.$results_rankview_mod["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_mod);
						
						} else { echo "Ninguna cuenta de moderador"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 Cuentas de GM:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
					    if(mysqli_num_rows($query_ranksview_accountacces_gm) != 0){
						 
					    // Accountok lekérdezése rang alapján (gm)
						while($results_ranksview_accountacces_gm = mysqli_fetch_array($query_ranksview_accountacces_gm)){

							$query_ranksview_gm = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_gm["id"]."'");
							$results_rankview_gm = mysqli_fetch_array($query_ranksview_gm);
							
							if($results_rankview_gm["username"] == ""){ $results_rankview_gm["username"] = '<a href="#" title="Ismeretlen">?</a>'; }
							
								// Státusz átalakítása
								switch($results_rankview_gm["online"]){
								
								case 1:
								$results_rankview_gm_online_color = "green";
								break;
								
								case 0:
								$results_rankview_gm_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_gm[] = '<a href="#" title="ID: '.$results_rankview_gm["id"].'"><font color="'.$results_rankview_gm_online_color.'">'.$results_rankview_gm["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_gm);
						
						} else { echo "Ninguna cuenta de GM"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 Administrador:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						if(mysqli_num_rows($query_ranksview_accountacces_admin) != 0){
						
					    // Accountok lekérdezése rang alapján (admin)
						while($results_ranksview_accountacces_admin = mysqli_fetch_array($query_ranksview_accountacces_admin)){

							$query_ranksview_admin = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_admin["id"]."'");
							$results_rankview_admin = mysqli_fetch_array($query_ranksview_admin);
							
							if($results_rankview_admin["username"] == ""){ $results_rankview_admin["username"] = '<a href="#" title="Ismeretlen">?</a>'; }
							
							// Státusz átalakítása
							switch($results_rankview_admin["online"]){
								
								case 1:
								$results_rankview_admin_online_color = "green";
								break;
								
								case 0:
								$results_rankview_admin_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_admin[] = '<a href="#" title="ID: '.$results_rankview_admin["id"].'"><font color="'.$results_rankview_admin_online_color.'">'.$results_rankview_admin["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_admin);
						
						} else { echo "Ninguna cuenta de GM"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
				 </table>

				 </td>
			   </tr>
			 </table>
