<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_characters);

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["playername"])){

	// Posztolt adatok �talak�t�s
	$post_playersearch_playername = variable($_POST["playername"], "" ,"db");

	// Posztolt adatok ellen�rz�se
	string_check($post_playersearch_playername, 12, ">", "A j�t�kos neve t�l hossz�!");
	string_check($post_playersearch_playername, 2, "<", "Adj meg legal�bb 2 karaktert a keres�shez!");

	// Email m�dos�t�sa
	$query_playersearch_playername = db_query("SELECT name, race, class, gender, level, online FROM characters WHERE name LIKE '%".$post_playersearch_playername."%' ORDER BY name ASC");
	$rows_playersearch = mysqli_num_rows($query_playersearch_playername);

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Indica un nombre v�lido!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "Adj meg legal�bb 2 karaktert a keres�shez!" ); form.playername.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Buscador de Jugadores<img class="nav-icon" src="<?php echo theme_file("images/icons/search.png"); ?>" alt="J�t�kos keres�se" />
				 
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
						  
						  Aqu� puedes buscar a un jugador y consultar su raza, clase...
						  
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
				 
				 // Inputok kit�lt�s�nek ellen�rz�se
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
							
							// Fajok �s kasztok �talak�t�sa k�pp�
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