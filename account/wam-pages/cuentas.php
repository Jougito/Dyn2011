<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_realmd);

// Karakterek lek�rdez�se
$query_cuenta = db_query("SELECT id, bannedby, banreason FROM account_banned");
$rows_cuenta = mysqli_num_rows($query_cuenta);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de sanciones de Dynamite<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Cuenta" />
				 
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
						  
						  Aqu� puedes ver las saciones activas.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center" colspan="4">N�mero de sanciones: <b><?php echo $rows_cuenta; ?></b></td>
				   </tr>
				 </table>
					
					<?php
					
					if($rows_cuenta != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>Referencia</td>
							<td>Baneado por</td>
							<td>Raz�n</td>
							
						  </tr>'
						  ;
						
						// Fajok �s kasztok �talak�t�sa k�pp�
						while($results_cuenta = mysqli_fetch_array($query_cuenta)){
						
							 $results_cuenta_race = '<img src="dyn-images/'.$results_cuenta["race"].'-'.$results_cuenta["gender"].'.gif" alt="" />';
							 $results_cuenta_class = '<img src="dyn-images/'.$results_cuenta["class"].'.gif" alt="" />';
							
							echo "<tr><td><b>".$results_cuenta["id"]."</b></td><td><b>".$results_cuenta["bannedby"]."</b></td><td><b>".$results_cuenta["banreason"]."</b></td>";
						
						}

						echo "</table>";
					
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>
