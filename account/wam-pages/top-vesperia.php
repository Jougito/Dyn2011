<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Top de jugadores<img class="nav-icon" src="<?php echo theme_file("images/icons/rank-star.png"); ?>" alt="Ranglisták" />
				 
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
						  
						  Aquí puedes ver el top de los mejores jugadores de Vesperia.
						  
						  </td>
						</tr>
					</table>
					
					
					
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     Honor
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Número</td>
						<td>Nombre</td>
						<td>Honor</td>
						<td>Raza</td>
						<td>Clase</td>
						<td>Nivel</td>
						<td>Estado</td>
					  </tr>
					
					<?php
					
					// Karakterek lekérdezése
					$query_tophonor = db_query("SELECT name, race, class, gender, level, totalHonorPoints, online FROM characters ORDER BY totalHonorPoints DESC LIMIT 20");
					
					$top_rank = 1;
					
					// Razaok és kasztok átalakítása képpé
						while($results_tophonor = mysqli_fetch_array($query_tophonor)){
						
						 switch($results_tophonor["online"]){
							 
							 case 0:
							 $results_tophonor_status = '<font color="red">Desconectado</font>';
							 break;
							 
							 case 1:
							 $results_tophonor_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_tophonor_status = '???';
							 break;
							 
						 }
						
						 $results_tophonor_race = '<img src="wam-images/'.$results_tophonor["race"].'-'.$results_tophonor["gender"].'.gif" alt="" />';
						 $results_tophonor_class = '<img src="wam-images/'.$results_tophonor["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_tophonor["name"].'</b></td><td class="top-rank"><b>'.$results_tophonor["totalHonorPoints"].'</b></td><td><b>'.$results_tophonor_race.'</b></td><td><b>'.$results_tophonor_class .'</b></td><td><b>'.$results_tophonor["level"].'</b></td><td><b>'.$results_tophonor_status.'</b></td>';
					
					}
					
					?>

					</table>
					<br />
					
				 
				 </td>
			   </tr>
			 </table>
