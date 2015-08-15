<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule");

?>

		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Cuenta VIP<img class="nav-icon" src="<?php echo theme_file("images/icons/ruby.png"); ?>" alt="VIP részleg" /></li>
					 
					 <?php
					 
					 if($wam_vip_enable_additem == "1"){
					 
						 echo '<li><a href="?id=add-item">Objetos</a></li>
						 <div class="dotted-line"></div>';
						 
					 }
					 
					 if($wam_vip_enable_addlevel == "1"){
					 
						 echo '<li><a href="?id=add-level">Niveles</a></li>
						 <div class="dotted-line"></div>';
						 
					 }
					 
					 if($wam_vip_enable_addmoney == "1"){
					 
						 echo '<li><a href="?id=add-money">Oro</a></li>
						 <div class="dotted-line"></div>';
						 
					 }
					 
					 if($wam_vip_enable_charrename == "1"){
					 
						 echo '<li><a href="?id=character-rename">Renombrar PJ</a></li>
						 <div class="dotted-line"></div>';
						 
					 }
					 
					 ?>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>