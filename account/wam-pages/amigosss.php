<?php

// Comprobación de sesión activa
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Conexión a la base de datos de cuentas
db_select($mysql_db_realmd);

// Querys a ejecutar
$query_amigo = db_query("SELECT fecharecruit FROM account WHERE id = '".$user_check_accountid."'");
$rows_amigo = mysqli_num_rows($query_amigo);
$query_amigofecha = db_query("SELECT email FROM amigos WHERE id = '".$user_check_accountid."'");


?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Vinculación de cuenta: "<?php echo $user_check_accountname; ?>"
				 
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
						  
						  Aquí puedes ver la Identificación de la cuenta con quién estás vinculado.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
					    <td align="center" colspan="5">Número de vinculaciones: <b><?php echo $rows_amigo; ?></b></td>
				   </tr>
				 </table>
				 
				 <?php
				 
				 if($rows_amigo != 0){
				 
					 echo '
						
						<table class="body6" cellspacing="0" cellpadding="0">
						
						';
						
						if(!empty($site_get_action)){
						
							echo '<form action="?id=amigos&cid='.$site_get_cid.'" method="POST">';
							
								switch($site_get_action){
								
								
								
							}
							
							echo '</form>';
							
						}
						
						echo '
						
						  <tr>
							<td>Fecha de inicio</td>

						  </tr>
						  
						  ';
						
						while($results_amigo = mysqli_fetch_array($query_amigo)){							
							echo "<tr><td><b>".$results_amigo["fecharecruit"]."</b></td>";



							
						}
echo '
						
						  <tr>
							<td>Email de tu amigo</td>

						  </tr>
						  
						  ';
							while($results_amigof = mysqli_fetch_array($query_amigofecha)){			
							echo "<tr><td><b>".$results_amigof["email"]."</b></td>";



							
						}
						
					}

					
					?>

					</table>
				 
				 </td>
			   </tr>
			 </table>
