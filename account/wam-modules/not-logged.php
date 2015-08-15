<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

?>

		     	 <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Menu Principal<img class="nav-icon" src="<?php echo theme_file("images/icons/arrow.png") ?>" alt="Menu de Cuenta" /></li>
					 <li><a href="index.php">Página Principal</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=registro">Registrar Cuenta</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="http://dynamite.es/">Dynamite.es</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="http://forum.dynamite.es/">Foro Dynamite</a></li>
						<div class="dotted-line"></div>
					 <li><a href="http://web.dynamite.es">Vesperia</a></li>
						<div class="dotted-line"></div>
					 <li><a href="http://dynamite.es/symphonia">Symphonia</a></li>
						<div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>
