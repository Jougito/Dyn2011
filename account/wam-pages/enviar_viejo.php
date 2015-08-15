<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,notbanned");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Karakterek lekérdezése
$query_chartrans_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");
?>


<table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia - Transferir PJ a otra cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Karakter áthelyezés" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Információ" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Aquí puedes transferir un PJ a otra cuenta, siempre y cuando no estes baneado.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=welcome" method="POST" onsubmit="return checkform(chartrans);" name="chartrans" > 
				 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
					     <td width="150px" align="center">
						 Titular de la cuenta de origen: <b><?php echo $user_check_accountname; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 Identificador de la cuenta de origen: <b><?php echo $user_check_accountid; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 IP de la cuenta de origen: <b><i>[Oculta]</i></b>
						</p>
						 </td>
					   </tr>
				   <tr>
				     <td align="center">
					 Nombre de PJ: <select name="mycharacter">
					 
					 <option SELECTED value="">Ninguno seleccionado</option>
					 
					 <?php
					 
					 while($results_chartrans_characters = mysqli_fetch_array($query_chartrans_characters)){
					 
					 echo '<option value="'.$results_chartrans_characters["guid"].'">'.$results_chartrans_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					
					 
					 </select></p> </p><input type="submit" value="Enviar PJ" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
