<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

// Munkamenet ind�t�sa
session_start();

// Inputok kit�lt�s�nek ellen�rz�se
if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && ($_POST["expansion"])!="" && !empty($_POST["security"])){

	$reg_security_answer = $_SESSION["reg_security"] + $_SESSION["reg_security2"];

	string_check($reg_security_answer, $_POST["security"], "!=", "Rossz v�laszt adt�l a biztons�gi k�rd�sre!");

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
	if($results_reg_acc_check[0]!=0){ system_message("Ezt az account nevet m�r haszn�lja valaki, k�rlek v�lassz m�sikat!"); }

	// Posztolt adatok ellen�rz�se
	string_check($post_reg_password, $post_reg_password2, "!=", "A jelsz� �s annak a meger�s�t�se nem egyezik meg!");
	string_check($post_reg_username, 3, "<", "Az account neved t�l r�vid!");
	string_check($post_reg_password, 6, "<", "A jelszavad t�l r�vid!");
	string_check($post_reg_username, 32, ">", "Az account neved t�l hossz�!");
	string_check($post_reg_password, 32, ">", "A jelszavad t�l hossz�!");
	string_check($post_reg_username, $post_reg_password, "==", "Az account n�v �s a jelsz� nem egyezhetnek meg!");
	string_check($post_reg_email, 64, ">", "Az email c�med t�l hossz�!");
	string_check($post_reg_email, 8, "<", "Az email c�med t�l r�vid!");
	string_check($post_reg_username, "^[0-9a-zA-Z%]+$", "!ereg", "Az account neved tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_reg_password, "^[0-9a-zA-Z%]+$", "!ereg", "A jelszavad tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_reg_expansion, 1, ">", "Az kieg�sz�t� mez� �rt�ke hib�s!");
	string_check($post_reg_expansion, "^[0-2%]+$", "!ereg", "Az kieg�sz�t� mez� �rt�ke hib�s!");

	// �j account besz�r�sa
	db_query("INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion) VALUES ('".$post_reg_username."', '".$reg_password."', '".$post_reg_email."', '".$site_ip."', '".$post_reg_expansion."')");

	// Biztons�gi napl�z�s k�sz�t�se (regisztr�ci�k)
	site_log("reg", "IP: ".$site_ip." | Account n�v: ".$post_reg_username." | D�tum: ".$site_date."");

	// �tir�ny�t�s
	system_message('Sikeresen regisztr�ltad a(z) '.$post_reg_username.' nev� accountot!');

}

$reg_security = rand(1, 9);
$reg_security2 = rand(1, 9);
$_SESSION["reg_security"] = $reg_security;
$_SESSION["reg_security2"] = $reg_security2;

?>
			 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     �j account<img class="nav-icon" src="<?php echo theme_file("images/icons/plus.png"); ?>" alt="�j account" />
				 
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
						  
						  T�ltsd ki az al�bbi mez�ket majd kattints a Mehet gombra! �gyelj arra hogy az account neved �s a jelszavad csak az angol ABC kis �s nagybet�it valamint sz�mokat tartalmazhat!
						  
						  </td>
						</tr>
					</table>
					
				 <script type="text/javascript">
				 function checkform ( form )
				 {
				 if (form.username.value == "") { alert( "Nem t�lt�tted ki az account n�v mez�t!" ); form.username.focus(); return false; } else { if (form.username.value.length < 3) { alert( "Az account neved t�l r�vid!" ); form.username.focus(); return false; } }
				 if (form.password.value == "") { alert( "Nem t�lt�tted ki a jelsz� mez�t!" ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "A jelszavad t�l r�vid!" ); form.password.focus(); return false; } }
				 if (form.password2.value == "") { alert( "Nem t�lt�tted ki a jelsz� m�gegyszer mez�t!" ); form.password2.focus(); return false; }
				 if (form.password.value == form.username.value) { alert( "Az account n�v �s a jelsz� nem egyezhetnek meg!" ); form.password.focus(); return false; }
				 if (form.password.value != form.password2.value) { alert( "A jelsz� �s annak meger�s�t�se nem egyezik meg!" ); form.password.focus(); return false; }
				 if (form.email.value == "") { alert( "Nem t�lt�tted ki az email mez�t!" ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "Az email c�med t�l r�vid!" ); form.email.focus(); return false; } }
				 if (form.security.value == "") { alert( "Nem t�lt�tted ki az ellen�rz� k�rd�s mez�t!" ); form.security.focus(); return false; }
				 return true ;
				 }
				 </script>
			 
				 <form action="?id=reg" method="POST" onsubmit="return checkform(reg);" name="reg"> 
				 <table class="body6" cellspacing="0" cellpadding="0">
				    <tr>
					  <td align="center" rowspan="7">
					  <img src="<?php echo theme_file("images/reg-animation".rand(1, 6).".gif"); ?>" width="150" height="150" alt="" />
					  </td>
					  <td align="right">
					  Account n�v:
					  </td>
					  <td align="left">
					  <input name="username" type="text" maxlength="32" /> <font class="mini">Min 3, Max 32 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Jelsz�:
					  </td>
					  <td align="left">
					  <input name="password" type="password" maxlength="32" /> <font class="mini">Min 6 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Jelsz� m�gegyszer:
					  </td>
					  <td align="left">
					  <input name="password2" type="password" maxlength="32" /> <font class="mini">Min 6 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Email c�m:
					  </td>
					  <td align="left">
					  <input name="email" type="text" maxlength="64" />
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Kieg�sz�t�:
					  </td>
					  <td align="left">
					  <select name="expansion"><option value="<?php echo $wam_expansion_wotlk; ?>">WOTLK</option><option value="<?php echo $wam_expansion_bc; ?>">BC</option><option value="<?php echo $wam_expansion_classic; ?>">Classic</option></select>
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
					<input name="security" type="text" maxlength="2" /> <font class="mini"><a title="Ezzel a k�rd�ssel sz�rj�k ki a robotokat" href="#">[?]</a></font>
					</td>
					</tr>
				    <tr>
					  <td colspan="2" style="text-align:right;">
					  <input type="submit" value="Mehet" class="input-sbm" />
					  </td>
					</tr>
			     </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>