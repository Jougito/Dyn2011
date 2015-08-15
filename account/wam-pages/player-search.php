<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["playername"])){

	// Posztolt adatok átalakítás
	$post_playersearch_playername = variable($_POST["playername"], "" ,"db");

	// Posztolt adatok ellenõrzése
	string_check($post_playersearch_playername, 12, ">", "A játékos neve túl hosszú!");
	string_check($post_playersearch_playername, 2, "<", "Adj meg legalább 2 karaktert a kereséshez!");

	// Email módosítása
	$query_playersearch_playername = db_query("SELECT name, race, class, gender, level, online FROM characters WHERE name LIKE '%".$post_playersearch_playername."%' ORDER BY name ASC");
	$rows_playersearch = mysqli_num_rows($query_playersearch_playername);

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Indica un nombre válido!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "Adj meg legalább 2 karaktert a kereséshez!" ); form.playername.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Buscador de Jugadores<img class="nav-icon" src="<?php echo theme_file("images/icons/search.png"); ?>" alt="Játékos keresése" />
				 
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
						  
						  Aquí puedes buscar a un jugador y consultar su raza, clase...
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=player-search" method="POST" onsubmit="return checkform(playersearch);" name="playersearch"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Nombre de jugador: <input name="playername" type="text" maxlength="12" /> <input type="submit" value="Buscar" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 <?php
				 
				 // Inputok kitöltésének ellenõrzése
                 if(!empty($post_playersearch_playername)){
				 
					 echo '
					 
					 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
						 <td align="center" colspan="5">Encontrados por \'<em>'.$post_playersearch_playername.'</em>\' Resultados: <b>'.$rows_playersearch.'</b></td>
					   </tr>
					 </table>
					 
					 ';
					 
					 if($rows_playersearch != 0){
						 
						 echo '
						 
						 <table class="body6" cellspacing="0" cellpadding="0">
							  <tr>
								<td>Nombre</td>
								<td>Raza</td>
								<td>Clase</td>
								<td>Nivel</td>
								<td>Estado</td>
							  </tr>
							
							';
							
							// Fajok és kasztok átalakítása képpé
							while($results_playersearch = mysqli_fetch_array($query_playersearch_playername)){
							
								 $results_playersearch_race = '<img src="dyn-images/'.$results_playersearch["race"].'-'.$results_playersearch["gender"].'.gif" alt="" />';
								 $results_playersearch_class = '<img src="dyn-images/'.$results_playersearch["class"].'.gif" alt="" />';
								 
								 switch($results_playersearch["online"]){
								 
								 case 0:
								 $results_playersearch_status = '<font color="red">Desconectado</font>';
								 break;
								 
								 case 1:
								 $results_playersearch_status = '<font color="green">Jugando</font>';
								 break;
								 
								 default:
								 $results_playersearch_status = '???';
								 break;
								 
							 }
							
							echo "<tr><td><b>".$results_playersearch["name"]."</b></td><td><b>".$results_playersearch_race."</b></td><td><b>".$results_playersearch_class ."</b></td><td><b>".$results_playersearch["level"]."</b></td><td><b>".$results_playersearch_status."</b></td></tr>";
							
							}
							
							echo "</table>";
							
						}
						
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>