<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_tickets = db_query("SELECT guid, name, message FROM gm_tickets WHERE closed = '0' ORDER BY name ASC");
$rows_tickets = mysqli_num_rows($query_tickets);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de Tickets Abiertos<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Tickets" />
				 
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
						  
						  Aquí puedes ver los tickets online en el juego. - Vesperia -
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center" colspan="4">Tickets Online: <b><?php echo $rows_tickets; ?></b></td>
				   </tr>
				 </table>
					
					<?php
					
					if($rows_tickets != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>Nombre</td>
							<td>Guid</td>
							<td>Mensaje</td>
							
						  </tr>'
						  ;
						
						// Fajok és kasztok átalakítása képpé
						while($results_tickets = mysqli_fetch_array($query_tickets)){
						
							 $results_tickets_race = '<img src="dyn-images/'.$results_tickets["race"].'-'.$results_tickets["gender"].'.gif" alt="" />';
							 $results_tickets_class = '<img src="dyn-images/'.$results_tickets["class"].'.gif" alt="" />';
							
							echo "<tr><td><b>".$results_tickets["name"]."</b></td><td><b>".$results_tickets["guid"]."</b></td><td><b>".$results_tickets["message"]."</b></td>";
						
						} 

						echo "</table>";
					
					} else { echo "<center>Ningún ticket en la base de datos.</center>"; }
					
					?>
				 
				 </td>
			   </tr>
			 </table>
