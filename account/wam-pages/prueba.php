<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged");

$query_equipos = db_query( "SELECT arenateamid FROM arena_team_member WHERE guid = '".$results_guid."'");

// Accountok lek�rdez�se rang alapj�n (vip)
$query_nombres_personajes = db_query( "SELECT name FROM characters WHERE account = '".$user_check_accountid."'");

$query_guid_personajes = db_query( "SELECT guid FROM characters WHERE account = '".$user_check_accountid."'");

while($results_guid = mysqli_fetch_array($query_guid_personajes))

?>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de Rangos<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Rangok �ttekint�se" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Informaci�n" />
						  
						  </td>
						  <td class="location-info-text">
						  
						   Aqu� se muestra una lista de MJs con rango en todos los reinos de juego de Dynamite, si salen en color rojo es que no est�n conectados, y si salen en color verdes es que si est�n conectados.
						  
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
						 
					    // Accountok lek�rdez�se rang alapj�n (vip)
						while($results_ranksview_accountacces_vip = mysqli_fetch_array($query_ranksview_accountacces_vip)){

							$query_ranksview_vip = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_vip["id"]."'");
							$results_rankview_vip = mysqli_fetch_array($query_ranksview_vip);
							
							if($results_rankview_vip["username"] == ""){ $results_rankview_vip["username"] = '<a href="#" title="Usuario">?</a>'; }
							
							// St�tusz �talak�t�sa
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
					  
				 </table>

				 </td>
			   </tr>
			 </table>
