<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Ûrlap elküldésének ellenõrzése
if(!empty($_POST)){

	// Inputok kitöltésének ellenõrzése (jelszó)
	if(!empty($_POST["newpassword"]) && !empty($_POST["newpassword2"]) && !empty($_POST["password"])){

		// Posztolt adatok átalakítás
		$post_accountmodify_password = variable($_POST["password"], "strtoupper", "db");
		$post_accountmodify_newpassword = variable($_POST["newpassword"], "strtoupper", "db");
		$post_accountmodify_newpassword2 = variable($_POST["newpassword2"], "strtoupper", "normal");
		$accountmodify_password = sha_pass_hash($user_check_accountname, $post_accountmodify_password);
		$accountmodify_password_final = sha_pass_hash($user_check_accountname, $post_accountmodify_newpassword);

		if($accountmodify_password == $user_check_password){

			// Posztolt adatok ellenõrzése
			string_check($post_accountmodify_newpassword, $post_accountmodify_newpassword2, "!=", "La nueva contraseña es igual.");
			string_check($post_accountmodify_newpassword, $user_check_accountname, "==", "El nombre de usuario y la contraseña son iguales.");
			string_check($post_accountmodify_newpassword, 6, "<", "La contraseña es demasiado corta.");
			string_check($post_accountmodify_newpassword, 32, ">", "La contraseña es demasiado larga.");
			string_check($post_accountmodify_newpassword, "^[0-9a-zA-Z%]+$", "!ereg", "La contraseña tiene valores raros.");

			// Jelszó módosítása
			db_query("UPDATE account SET sha_pass_hash = '".$accountmodify_password_final."' WHERE id = '".$user_check_accountid."'");

		} else {

			system_message("Contraseña actual incorrecta!");

		}

	}

	// Inputok kitöltésének ellenõrzése (email)
	if($_POST["email"] != $user_check_email){

		// Posztolt adatok átalakítás
		// $post_accountmodify_email = variable($_POST["email"], "", "db");

		// Posztolt adatok ellenõrzése
		// string_check($post_accountmodify_email, 64, ">", "Email demasiado largo.");
		// string_check($post_accountmodify_email, 8, "<", "Email demasiado corto.");

		// Email módosítása
		db_query("UPDATE account SET locked = 1 WHERE id = '".$user_check_accountid."'");

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
					

				 
					<form action="?id=account-modify" method="POST" onsubmit="return checkform(accountmodify);" name="accountmodify">
					<table class="body6" cellspacing="0" cellpadding="0">
					   
					   					   <tr>
					     <td align="right">
						 Contraseña Actual
						 </td>
						 <td align="left">
						 <input name="password" class="normal" type="password" maxlength="32" /> <font class="mini"><a href="#" title="Sirve para verificar que eres el dueño de la cuenta.">[?]</a></font>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Email:
						 </td>
						 <td align="left">
					     <input name="email" class="normal" type="text" value="<?php echo $user_check_email; ?>" maxlength="64" disabled/>
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
