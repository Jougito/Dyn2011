<?php

// Informaci�n de oro de cuenta
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
				 
				     Cr�ditos para la cuenta: "<?php echo $user_check_accountname; ?>"
				 
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
						  
						  Aqu� puedes ver el n�mero de cr�ditos que hay en tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
					    <td align="center" colspan="5">Cr�ditos en tu cuenta.</td>
				   </tr>
				 </table>
				 
				 <table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="250px" align="right">
						 Cr�ditos en tu cuenta de juego:
						 </td>
						 <td align="left">
						 <b><font color="blue"><?php echo $results_oro["creditos"]; ?> cr�ditos</b>
						 </td>
					   </tr>
 <tr>
					    <td align="center" colspan="5">Cr�ditos gastados en tu cuenta.</td>
				   </tr>
				 </table>
				 
				 <table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="250px" align="right">
						 Cr�ditos gastados en tu cuenta de juego:
						 </td>
						 <td align="left">
						<b><font color="blue"><?php echo $results_orogastado["creditos_gastados"]; ?> cr�ditos</b>
						 </td>
					   </tr>
					</table>
				 
				 </td>
			   </tr>
			 </table>
