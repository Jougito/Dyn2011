<?php

// Información de oro de cuenta
$query_orogastado = db_query("SELECT creditos_gastados FROM account WHERE id = '".$user_check_accountid."'");
$results_orogastado = mysqli_fetch_array($query_orogastado);

// Logeado?
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Conexion bas de datos
db_select($mysql_db_realmd);



?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Créditos para la cuenta: "<?php echo $user_check_accountname; ?>"
				 
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
						  
						  Aquí puedes ver el número de créditos que hay en tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
					    <td align="center" colspan="5">Créditos en tu cuenta.</td>
				   </tr>
				 </table>
				 
				 <table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="250px" align="right">
						 Créditos en tu cuenta de juego:
						 </td>
						 <td align="left">
						 <b><font color="blue"><?php echo $results_oro["creditos"]; ?> créditos</b>
						 </td>
					   </tr>
 <tr>
					    <td align="center" colspan="5">Créditos gastados en tu cuenta.</td>
				   </tr>
				 </table>
				 
				 <table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="250px" align="right">
						 Créditos gastados en tu cuenta de juego:
						 </td>
						 <td align="left">
						<b><font color="blue"><?php echo $results_orogastado["creditos_gastados"]; ?> créditos</b>
						 </td>
					   </tr>
					</table>
				 
				 </td>
			   </tr>
			 </table>
