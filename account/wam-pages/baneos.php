<?php

// Revision de baneo de cuenta
$query_banactivo = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
$results_banactivo = mysqli_fetch_array($query_banactivo);

// Cuenta banactivoada... datos
switch($results_banactivo["active"]){

	case "0":
	$results_banactivo["active"] = '<font color="green">No</i></font>';
	break;

	case "1":
	$results_banactivo["active"] = '<font color="red">S�</font>';
	break;

	default:
	$results_banactivo["active"] = '<font color="green">No</i></font>';
	break;

}

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Csatlakoz�s a characters adatb�zishoz
db_select($mysql_db_realmd);

// Karakterek lek�rdez�se
$query_tickets = db_query("SELECT id, bannedby, banreason FROM account_banned WHERE id = '".$user_check_accountid."'");
$rows_tickets = mysqli_num_rows($query_tickets);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Lista de baneos de tu cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Tickets" />
				 
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
						  
						  Aqu� puedes ver los baneos de tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center" colspan="4">Lista de sanciones: <b><?php echo $rows_tickets; ?></b></td>
				   </tr>
				 </table>
					
					<?php
					
					if($rows_tickets != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>ID</td>
							<td>Banedo por</td>
							<td>Raz�n del baneo</td>
							<td>Activo</td>
							
						  </tr>'
						  ;
						
						// Fajok �s kasztok �talak�t�sa k�pp�
						while($results_tickets = mysqli_fetch_array($query_tickets)){
						
							
							echo "<tr><td><b>".$results_tickets["id"]."</b></td><td><b>".$results_tickets["bannedby"]."</b></td><td><b>".$results_tickets["banreason"]."</b></td><td>".$results_banactivo["active"]."</td>";
						
						}

						echo "</table>";
					
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>
