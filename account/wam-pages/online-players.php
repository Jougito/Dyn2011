<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_onlineplayers = db_query("SELECT name, race, class, gender, level FROM characters WHERE online = '1' ORDER BY name ASC");
$rows_onlineplayers = mysqli_num_rows($query_onlineplayers);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Jugadores Online<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Online játékosok" />
				 
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
						  
						  Aquí puedes ver los usuarios online en el juego. - Vesperia -
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center" colspan="4">Jugadores Online: <b><?php echo $rows_onlineplayers; ?> / <?php echo $wam_max_players; ?></b></td>
				   </tr>
				 </table>
					
					<?php
					
					if($rows_onlineplayers != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>Nombre</td>
							<td>Raza</td>
							<td>Clase</td>
							<td>Nivel</td>
						  </tr>'
						  ;
						
						// Fajok és kasztok átalakítása képpé
						while($results_onlineplayers = mysqli_fetch_array($query_onlineplayers)){
						
							 $results_onlineplayers_race = '<img src="dyn-images/'.$results_onlineplayers["race"].'-'.$results_onlineplayers["gender"].'.gif" alt="" />';
							 $results_onlineplayers_class = '<img src="dyn-images/'.$results_onlineplayers["class"].'.gif" alt="" />';
							
							echo "<tr><td><b>".$results_onlineplayers["name"]."</b></td><td><b>".$results_onlineplayers_race."</b></td><td><b>".$results_onlineplayers_class ."</b></td><td><b>".$results_onlineplayers["level"]."</b></td>";
						
						}

						echo "</table>";
					
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>