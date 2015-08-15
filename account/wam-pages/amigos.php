<?php

$query_amigofecha = db_query("SELECT email FROM amigos WHERE id = '".$user_check_accountid."'");

// Revision de baneo de cuenta
$query_amigosreclutados = db_query("SELECT fecharecruit FROM account WHERE id = '".$user_check_accountid."'");
$results_amigosreclutados = mysqli_fetch_array($query_amigosreclutados);

// Cuenta amigosreclutadosada... datos
switch($results_amigosreclutados["fecharecruit"]){

	case "0000-00-00 00:00:00":
	$results_amigosreclutados["fecharecruit"] = '<font color="green">Fecha no disponible para este usuario.</i></font>';
	break;

	case "1":
	$results_amigosreclutados["fecharecruit"] = '<font color="red">Sí</font>';
	break;

}

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_realmd);

// Karakterek lekérdezése
$query_tickets = db_query("SELECT id, bannedby, banreason FROM account_banned WHERE id = '".$user_check_accountid."'");
$rows_tickets = mysqli_num_rows($query_tickets);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de amigos vinculados a tu cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Amigos" />
				 
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
						  
						  Aquí puedes ver los amigos vinculados a tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 
					
					<?php
					
					if($rows_tickets != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>Fecha</td>
							<td>Email Amigo</td>
							
						  </tr>'
						  ;
						
						// Fajok és kasztok átalakítása képpé
						while($results_tickets = mysqli_fetch_array($query_tickets)){
						
							
							echo "<td>".$results_amigosreclutados["fecharecruit"]."</td><td><b>".$results_amigof["email"]."</b></td>";
						
						}

						echo "</table>";
					
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>
