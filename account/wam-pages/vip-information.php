<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); }

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Sección VIP<img class="nav-icon" src="<?php echo theme_file("images/icons/direction.png"); ?>" alt="VIP információ" />
				 
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
						  
						  Aquí puedes encontrar datos para usuarios VIP.
						  
						  </td>
						</tr>
					</table>
					
					<?php echo $site_vip_information; ?>
				 
				 </td>
			   </tr>
			 </table>