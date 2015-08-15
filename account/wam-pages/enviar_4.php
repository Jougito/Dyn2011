<?php
// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Información de oro de cuenta
$query_orogastado = db_query("SELECT creditos_gastados FROM account WHERE id = '".$user_check_accountid."'");
$results_orogastado = mysqli_fetch_array($query_orogastado);

?>


<table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Tienda" />
				 
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
						  
						  Envia un objeto a tu cuenta desde esta web.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=enviar_4_2" method="POST" onsubmit="return checkform(chartrans);" name="chartrans" > 
				 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
					     <td width="150px" align="center">
						 Titular de la cuenta: <b><?php echo $user_check_accountname; ?></b>
						</p>
						 </td>
					   </tr>
					   <tr>
					     <td width="150px" align="center">
						 Creditos de la cuenta: <b><font color="green"><?php echo $results_oro["creditos"]; ?></font></b>
						</p>
						 </td>
					   </tr>
					   <tr>
					     <td width="150px" align="center">
						 Creditos gastados de la cuenta: <b><font color="red"><?php echo $results_orogastado["creditos_gastados"]; ?></font></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 Identificador de la cuenta: <b><?php echo $user_check_accountid; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						  <img src="/imagesv/objetos/lupa.png" onMouseOver="this.src='/imagesv/objetos/cambio_raza.jpg'" onMouseOut="this.src='/imagesv/objetos/lupa.png'" style="cursor:pointer;">
						</p>
						 </td>
					   </tr>
				   <tr>
				     <td align="center">
					 Nombre de PJ: <input type="text" name="pj" />
					 
					 </p> </p><input type="submit" value="Enviar Objeto" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
