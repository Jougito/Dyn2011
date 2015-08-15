<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("not-logged");

// Munkamenet ind�t�sa
session_start();

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && ($_POST["expansion"])!="" && !empty($_POST["security"])){

	$reg_security_answer = $_SESSION["reg_security"] + $_SESSION["reg_security2"];

	string_check($reg_security_answer, $_POST["security"], "!=", "Debes completar la pregunta de seguridad.");

	// Munkamenet t�rl�se
	session_destroy();

	// K�ld�tt adatok �talak�t�sa
	$post_reg_username = variable($_POST["username"], "strtoupper", "db");
	$post_reg_password = variable($_POST["password"], "strtoupper", "db");
	$post_reg_password2 = variable($_POST["password2"], "strtoupper", "normal");
	$post_reg_email = variable($_POST["email"], "", "db");
	$post_reg_expansion = variable($_POST["expansion"], "", "db");
	$reg_password = sha_pass_hash($post_reg_username, $post_reg_password);

	// Account n�v ellen�rz�se
	$query_reg_acc_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_reg_username."'");
	$results_reg_acc_check = mysqli_fetch_array($query_reg_acc_check);
	if($results_reg_acc_check[0]!=0){ system_message("Esta cuenta ya est� en uso por otra persona, por favor, elije otra."); }

	// Posztolt adatok ellen�rz�se
	string_check($post_reg_password, $post_reg_password2, "!=", "Las contrase�as no coinciden.");
	string_check($post_reg_username, 3, "<", "El nombre de cuenta es demasiado corto.");
	string_check($post_reg_password, 6, "<", "La contrase�a es demasiado corta.");
	string_check($post_reg_username, 32, ">", "El nombre de cuenta es demasiado largo.");
	string_check($post_reg_password, 32, ">", "La contrase�a es demasiado larga.");
	string_check($post_reg_username, $post_reg_password, "==", "El nombre de cuenta y la contrase�a son iguales.");
	string_check($post_reg_email, 64, ">", "El email es demasiado largo.");
	string_check($post_reg_email, 8, "<", "El email es demasiado corto.");
	string_check($post_reg_username, "^[0-9a-zA-Z%]+$", "!ereg", "El nombre de cuenta tiene letras que no son v�lidas.");
	string_check($post_reg_password, "^[0-9a-zA-Z%]+$", "!ereg", "La contrase�a tiene letras que no son v�lidas.");
	string_check($post_reg_expansion, 1, ">", "Selecciona una expansi�n.");
	string_check($post_reg_expansion, "^[0-2%]+$", "!ereg", "Expansi�n inv�lida.");

	// �j account besz�r�sa
	db_query("INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion) VALUES ('".$post_reg_username."', '".$reg_password."', '".$post_reg_email."', '".$site_ip."', '".$post_reg_expansion."')");

	// Biztons�gi napl�z�s k�sz�t�se (regisztr�ci�k)
	site_log("reg", "IP: ".$site_ip." | Cuenta: ".$post_reg_username." | Fecha: ".$site_date."");

	// �tir�ny�t�s
	system_message('Registro de cuenta '.$post_reg_username.' realizado correctamente.');

}

$reg_security = rand(1, 9);
$reg_security2 = rand(1, 9);
$_SESSION["reg_security"] = $reg_security;
$_SESSION["reg_security2"] = $reg_security2;

?>
			 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Registro de Cuenta<img class="nav-icon" src="<?php echo theme_file("images/icons/plus.png"); ?>" alt="Cuenta" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Inform�ci�" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Aqu� puedes registrar tu cuenta de juego.
						  
						  </td>
						</tr>
					</table>
					
				 				 <script type="text/javascript">
				 function checkform ( form )
				 {
				 if (form.username.value == "") { alert( "Indica un nombre de cuenta." ); form.username.focus(); return false; } else { if (form.username.value.length < 3) { alert( "El nombre de cuenta es demasiado corto." ); form.username.focus(); return false; } }
				 if (form.password.value == "") { alert( "Indica una contrase�a." ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "La contrase�a es demasiado corta." ); form.password.focus(); return false; } }
				 if (form.password2.value == "") { alert( "Indica la confirmaci�n de la contrase�a." ); form.password2.focus(); return false; }
				 if (form.password.value == form.username.value) { alert( "El usuario y contrase�a es identico." ); form.password.focus(); return false; }
				 if (form.password.value != form.password2.value) { alert( "Las contrase�as no coinciden." ); form.password.focus(); return false; }
				 if (form.email.value == "") { alert( "Indica un email." ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "El email es demasiado corto." ); form.email.focus(); return false; } }
				 if (form.security.value == "") { alert( "La pregunta de seguridad no es v�lida." ); form.security.focus(); return false; }
				 return true ;
				 }
				 </script>
			 
				 <form action="?id=registro" method="POST" onsubmit="return checkform(reg);" name="reg"> 
				 <table class="body6" cellspacing="0" cellpadding="0">
				    <tr>
					  <td align="center" rowspan="7">
					  <img src="<?php echo theme_file("images/reg-animation".rand(1, 6).".gif"); ?>" width="150" height="150" alt="" />
					  </td>
					  <td align="right">
					  Cuenta:
					  </td>
					  <td align="left">
					  <input name="username" type="text" maxlength="32" /> <font class="mini">Min 3, Max 32</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Contrase�a:
					  </td>
					  <td align="left">
					  <input name="password" type="password" maxlength="32" /> <font class="mini">Min 6</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Rep. Contrase�a:
					  </td>
					  <td align="left">
					  <input name="password2" type="password" maxlength="32" /> <font class="mini">Min 6</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Email:
					  </td>
					  <td align="left">
					  <input name="email" type="text" maxlength="64" />
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Seguridad:
					  </td>
					  <td align="left">
					  <select name="expansion"><option value="<?php echo $wam_expansion_wotlk; ?>">WOTLK</option><option value="<?php echo $wam_expansion_bc; ?>">BC</option><option value="<?php echo $wam_expansion_classic; ?>">Clasico</option></select>
					  </td>
					</tr>
					<tr>
					<td align="right">
					
					<?php
					
					echo '<img src="'.theme_file('images/number-'.$reg_security.'.png').'" alt="" /><img src="'.theme_file('images/plus.png').'" alt="" /><img src="'.theme_file('images/number-'.$reg_security2.'.png').'" alt="" /><img src="'.theme_file('images/equality.png').'" alt="" /><img src="'.theme_file('images/question.png').'" alt="" />
					';
					
					?>
					</td>
					<td align="left">
					<input name="security" type="text" maxlength="2" /> <font class="mini"><a title="Sirve para comprobar que eres humano." href="#">[?]</a></font>
					</td>
					</tr>
				    <tr>
					  <td colspan="2" style="text-align:right;">
					  <input type="submit" value="Crear Cuenta" class="input-sbm" />
					  </td>
					</tr>
			     </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
