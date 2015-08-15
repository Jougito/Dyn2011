<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

if(!empty($_POST["message"])){

	$post_bug_message = $_POST["message"];

	mail($site_admin_email, "".$site_title." - Informa de errores", $post_bug_message, "");

	system_message("Mensaje enviado con éxito al administrador!");

}

?>
				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.message.value == "") { alert( "Nem töltötted ki az üzenet mezõt!" ); form.message.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Informe de Errores<img class="nav-icon" src="<?php echo theme_file("images/icons/bug.png"); ?>" alt="Hibajelentés" />
				 
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
						  
						  Aquí puedes reportar un error del juego, Vesperia. Será enviado al correo principal de la administración, recuerda usarlo solo cuando sea importante. Para bugs de misiones, etc usa el foro...
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=bug" method="POST" onsubmit="return checkform(bug);" name="bug"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Error: <a href="#" title="Esto envia un correo a la administración central, a sus correos privados. USALO BIEN."><font class="mini">[?]</font></a><br /><textarea name="message" class="normal" cols="50" rows="5"></textarea><br /><input class="input-sbm" type="submit" value="Enviar" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>