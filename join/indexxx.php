<?php


require_once("config.php");

session_start();

if(!empty($_POST["security"])){

	if($_SESSION["security"]  != $_POST["security"]) { $errors[] = "<font color='red'>Codigo de verificación erroneo.</font>"; }

}

$security = rand(10000, 100000);
$_SESSION["security"] = $security;

if(!empty($_POST["accountname"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && $_POST["expansion"] != "" && !empty($_POST["security"])){

// Conexión MYSQL - NO editar
	$mysql_connect = mysqli_connect($mysql["host"], $mysql["username"], $mysql["password"]) or die("¡Ups! Hay un error, vuelve más tarde.");
	mysqli_select_db($mysql_connect, $mysql["realmd"]) or die("¡Ups! Hay un error, vuelve a intentarlo más tarde");
	
	$post_accountname = mysqli_real_escape_string($mysql_connect, trim(strtoupper($_POST["accountname"])));
	$post_password = mysqli_real_escape_string($mysql_connect, trim(strtoupper($_POST["password"])));
	$post_password_final = mysqli_real_escape_string($mysql_connect, SHA1("".$post_accountname.":".$post_password.""));
	$post_password2 = trim(strtoupper($_POST["password2"]));
	$post_email = mysqli_real_escape_string($mysql_connect, trim($_POST["email"]));
	$post_expansion = mysqli_real_escape_string($mysql_connect, trim($_POST["expansion"]));
	
	$check_account_query = mysqli_query($mysql_connect, "SELECT COUNT(*) FROM account WHERE username = '".$post_accountname."'");
	$check_account_results = mysqli_fetch_array($check_account_query);
	if($check_account_results[0]!=0){ $errors[] = "<font color='red'>La cuenta ya existe.</font>"; }
	if(strlen($post_accountname) > 32) { $errors[] = "<font color='red'>La cuenta no debe pasar las 32 letras.</font>"; }
	if(strlen($post_password) < 6) { $errors[] = "<font color='red'>La contraseña tiene que ser mayor de 6 letras.</font>"; }
	
	if(strlen($post_accountname) < 3) { $errors[] = "<font color='red'>La cuenta tiene que ser mayor de 3 letras.</font>"; }
	if(strlen($post_accountname) > 32) { $errors[] = "<font color='red'>La cuenta no debe pasar las 32 letras.</font>"; }
	if(strlen($post_password) < 6) { $errors[] = "<font color='red'>La contraseña tiene que ser mayor de 6 letras.</font>"; }
	if(strlen($post_password) > 32) { $errors[] = "<font color='red'>La contraseña no debe de ser mayor de 32 letras.</font>"; }
	if(strlen($post_email) > 64) { $errors[] = "<font color='red'>El email no debe de ser mayor de 64 letras.</font>"; }
	if(strlen($post_email) < 8) { $errors[] = "<font color='red'>El email debe de ser mayor de 8 letras.</font>"; }
	if(!ereg("^[0-9a-zA-Z%]+$", $post_accountname)) { $errors[] = "<font color='red'>La cuenta tiene que estar bien escrita.</font>"; }
	if(!ereg("^[0-9a-zA-Z%]+$", $post_password)) { $errors[] = "<font color='red'>La contraseña tiene que estar bien escrita.</font>"; }
	if(!ereg("^[0-2%]+$", $post_expansion)) { $errors[] = "<font color='red'>Debes seleccionar una expansión para tu cuenta.</font>"; }
	if(strlen($post_expansion) > 1) { $errors[] = "<font color='red'>Debes seleccionar al menos 1 expansión.</font>"; }
	if($post_accountname == $post_password) { $errors[] = "<font color='red'>La cuenta no puede ser igual que la contraseña.</font>"; }
	if($post_password != $post_password2) { $errors[] = "<font color='red'>Las contraseñas no coinciden.</font>"; }
	
	if(!is_array($errors)){
	
		mysqli_query($mysql_connect, "INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion) VALUES ('".$post_accountname."', '".$post_password_final."', '".$post_email."', '".$_SERVER["REMOTE_ADDR"]."', '".$post_expansion."')") or die(mysqli_error($mysql_connect));
		
		$errors[] = '<font color="red">CUENTA: </font><font color="yellow">'.$post_accountname.' </font><font color="red">EMAIL:</font> <font color="yellow">'.$post_email.'</font> registrada correctamente.';
	
	}
	
	mysqli_close($mysql_connect);

}

function error_msg(){

	global $errors;
	
	if(is_array($errors)){
	
		foreach($errors as $msg){
		
			echo '<div class="errors">'.$msg.'</div>';
		
		}
	
	}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<link rel="stylesheet" type="text/css" href="site.css" />
<meta name="description" content="<?php $site["meta_description"] ?>" />
<meta name="keywords" content="<?php echo $site["meta_keywords"]; ?>" />
<meta name="robots" content="<?php echo $site["meta_robots"] ?>" />
<meta name="author" content="Pradox (Kálmán Roland)" />
<link rel="shortcut icon" href="img/favicon.gif" type="image/png" />
<title><?php echo $site["title"]; ?></title>
</head>
<body>

 <script type="text/javascript">
 function checkform ( form )
 {
 
	 if (form.accountname.value == "") { alert( "[Fallo en creación de cuenta] Rellena todos los campos." ); form.accountname.focus(); return false; } else { if (form.accountname.value.length < 3) { alert( "La cuenta debe tener al menos 3 letras!" ); form.accountname.focus(); return false; } }
	 if (form.password.value == "") { alert( "[Fallo en creación de cuenta] Rellena todos los campos." ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "La contraseña debe tener al menos 6 letras!" ); form.password.focus(); return false; } }
	 if (form.password2.value == "") { alert( "Las contraseñas no coinciden!" ); form.password2.focus(); return false; }
	 if (form.password.value == form.accountname.value) { alert( "Fallo desconocido, revisa todos los datos." ); form.password.focus(); return false; }
	 if (form.password.value != form.password2.value) { alert( "Las contraseñas no coinciden!" ); form.password.focus(); return false; }
	 if (form.email.value == "") { alert( "[Fallo en creación de cuenta] Rellena todos los campos." ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "El email debe tener al menos 8 letras!" ); form.email.focus(); return false; } }
	 if (form.security.value == "") { alert( "El código de verificación no es correcto!" ); form.security.focus(); return false; }
 
 return true ;
 }
 </script>
<center>
<table class="reg">
	<tr>
		<td style="height: 110px">
			<a href="<?php echo $_SERVER["PHP_SELF"]; ?>"><img src="img/logo.png" alt="<?php echo $site["title"]; ?>" /></a>
		</td>
	</tr>
	<tr>
		<td style="height: 23px">
		</td>
	</tr>
	<tr>
		<td>
		
		<?php error_msg(); ?>
			
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return checkform(reg);" name="reg">
			
			<table class="form" background="img/section-bg.png" background-repeat: no-repeat; title="Crear Cuenta" align="center" style="height: 300px; width:800px; margin-bottom: 0px; background-repeat: no-repeat;">
				<tr>
					<td align="right">
						Cuenta:
					</td>
					<td align="left">
						<input name="accountname" type="text" maxlength="32" />
					</td>
					</td>
				</tr>
				<tr>
					<td align="right">
						Contraseña:
					</td>
					<td align="left">
						<input name="password" type="password" maxlength="32" />
					</td>
				</tr>
				<tr>
					<td align="right">
						Repite la Contraseña:
					</td>
					<td align="left">
						<input name="password2" type="password" maxlength="32" />
					</td>
				<tr>
					<td align="right">
						Email:
					</td>
					<td align="left">
						<input name="email" type="text" maxlength="32" />
					</td>
				</tr>
				<tr>
					<td align="right">
						Expansión:
					</td>
					<td align="left">
						<select name="expansion">
							<option SELECTED value="2">Wrath Of The Lich King</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">
						Código: <font style="color:#00b0f2;"><?php echo $security; ?></font>
					</td>
					<td align="left">
						<input name="security" type="text" maxlength="5" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" class="sbm" value="Crear Cuenta" />
					</td>
				</tr>
			</table>
			
			</form>
			
			<div class="copy"><b><?php echo $site["realmlist"]; ?></b><br /><br /><font color='grey'>Dynamite Staff &copy; 2009 - 2011</font></div>

		</td>
	</tr>
</table>
</center>

</body>
</html>