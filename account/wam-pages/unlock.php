<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Ûrlap elküldésének ellenõrzése
if(!empty($_POST)){

	

	// Inputok kitöltésének ellenõrzése (email)
	if($_POST["email"] != $user_check_email){

		// Posztolt adatok átalakítás
		// $post_accountmodify_email = variable($_POST["email"], "", "db");

		// Posztolt adatok ellenõrzése
		// string_check($post_accountmodify_email, 64, ">", "Email demasiado largo.");
		// string_check($post_accountmodify_email, 8, "<", "Email demasiado corto.");

		// Email módosítása
		db_query("UPDATE account SET locked = 1 WHERE email = '".$post_accountmodify_email."'");

	}

	system_message("Sus datos se han actualizado correctamente.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.password.value != "" || form.newpassword.value != "" || form.newpassword2.value != "") {

                 if (form.newpassword.value == "") { alert( "Nem töltötted ki az Nueva Contraseña mezõt!" ); form.newpassword.focus(); return false; } else { if (form.newpassword.value.length < 6) { alert( "La contraseña debe contener 6 carácteres!" ); form.newpassword.focus(); return false; } }
				 if (form.newpassword2.value == "") { alert( "Rellena todos los campos!" ); form.newpassword2.focus(); return false; } else { if (form.newpassword2.value.length < 6) { alert( "La nueva contraseña es demasiado corta!" ); form.newpassword2.focus(); return false; } }
				 if (form.password.value == "") { alert( "La contraseña actual no es correcta!" ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "Contraseña actual demasiado corta!" ); form.password.focus(); return false; } }
				 
				 } else {
				 
				 if (form.email.value != "<?php echo $user_check_email; ?>") { if (form.email.value.length < 8) { alert( "Introduce un email correcto!" ); form.email.focus(); return false; } return true; }
				 if (form.expansion.value != "<?php echo $user_check_expansion; ?>") { return true; }
				 
				 return false;
				 
				 }

				 return true ;
				 
				 }
				 </script>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Modificar datos de Cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Adatok módosítása" />
						
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
						  
						  Aquí puedes editar los datos de tu cuenta.
						  
						  </td>
						</tr>
					</table>
					

				 
					<form action="?id=unlock" method="POST" onsubmit="return checkform(accountmodify);" name="accountmodify">
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     
					   <tr>
					     <td align="right">
						 Email de Cuenta para Desbloquear:
						 </td>
						 <td align="left">
					     <input name="email" class="normal" type="text" value=".$post_accountmodify_email." maxlength="64"/>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" colspan="2">
						 <input type="submit" value="Modificar Cuenta" class="input-sbm" />
						 </td>
					   </tr>
					</table>
					</form>
				 
				 </td>
			   </tr>
			 </table>
