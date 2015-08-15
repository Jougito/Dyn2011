<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

?>

		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Administración<img class="nav-icon" src="<?php echo theme_file("images/icons/admin.png"); ?>" alt="Administración" /></li>
					 <li><a href="?id=system-data">Datos del Gestor 1.0</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=account-transaction">Central de Cuentas</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=player-transaction">Edicion de Personajes</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=ranks-view">Rangos</a></li>
					 <div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>