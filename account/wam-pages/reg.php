<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

// Munkamenet indítása
session_start();

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && ($_POST["expansion"])!="" && !empty($_POST["security"])){

	$reg_security_answer = $_SESSION["reg_security"] + $_SESSION["reg_security2"];

	string_check($reg_security_answer, $_POST["security"], "!=", "Rossz választ adtál a biztonsági kérdésre!");

	// Munkamenet törlése
	session_destroy();

	// Küldött adatok átalakítása
	$post_reg_username = variable($_POST["username"], "strtoupper", "db");
	$post_reg_password = variable($_POST["password"], "strtoupper", "db");
	$post_reg_password2 = variable($_POST["password2"], "strtoupper", "normal");
	$post_reg_email = variable($_POST["email"], "", "db");
	$post_reg_expansion = variable($_POST["expansion"], "", "db");
	$reg_password = sha_pass_hash($post_reg_username, $post_reg_password);

	// Account név ellenõrzése
	$query_reg_acc_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_reg_username."'");
	$results_reg_acc_check = mysqli_fetch_array($query_reg_acc_check);
	if($results_reg_acc_check[0]!=0){ system_message("Ezt az account nevet már használja valaki, kérlek válassz másikat!"); }

	// Posztolt adatok ellenõrzése
	string_check($post_reg_password, $post_reg_password2, "!=", "A jelszó és annak a megerõsítése nem egyezik meg!");
	string_check($post_reg_username, 3, "<", "Az account neved túl rövid!");
	string_check($post_reg_password, 6, "<", "A jelszavad túl rövid!");
	string_check($post_reg_username, 32, ">", "Az account neved túl hosszú!");
	string_check($post_reg_password, 32, ">", "A jelszavad túl hosszú!");
	string_check($post_reg_username, $post_reg_password, "==", "Az account név és a jelszó nem egyezhetnek meg!");
	string_check($post_reg_email, 64, ">", "Az email címed túl hosszú!");
	string_check($post_reg_email, 8, "<", "Az email címed túl rövid!");
	string_check($post_reg_username, "^[0-9a-zA-Z%]+$", "!ereg", "Az account neved tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_reg_password, "^[0-9a-zA-Z%]+$", "!ereg", "A jelszavad tartalmaz olyan karaktereket is amik nem megengedettek!");
	string_check($post_reg_expansion, 1, ">", "Az kiegészítõ mezõ értéke hibás!");
	string_check($post_reg_expansion, "^[0-2%]+$", "!ereg", "Az kiegészítõ mezõ értéke hibás!");

	// Új account beszúrása
	db_query("INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion) VALUES ('".$post_reg_username."', '".$reg_password."', '".$post_reg_email."', '".$site_ip."', '".$post_reg_expansion."')");

	// Biztonsági naplózás készítése (regisztrációk)
	site_log("reg", "IP: ".$site_ip." | Account név: ".$post_reg_username." | Dátum: ".$site_date."");

	// Átirányítás
	system_message('Sikeresen regisztráltad a(z) '.$post_reg_username.' nevû accountot!');

}

$reg_security = rand(1, 9);
$reg_security2 = rand(1, 9);
$_SESSION["reg_security"] = $reg_security;
$_SESSION["reg_security2"] = $reg_security2;

?>
			 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Új account<img class="nav-icon" src="<?php echo theme_file("images/icons/plus.png"); ?>" alt="Új account" />
				 
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
						  
						  Töltsd ki az alábbi mezõket majd kattints a Mehet gombra! Ügyelj arra hogy az account neved és a jelszavad csak az angol ABC kis és nagybetûit valamint számokat tartalmazhat!
						  
						  </td>
						</tr>
					</table>
					
				 <script type="text/javascript">
				 function checkform ( form )
				 {
				 if (form.username.value == "") { alert( "Nem töltötted ki az account név mezõt!" ); form.username.focus(); return false; } else { if (form.username.value.length < 3) { alert( "Az account neved túl rövid!" ); form.username.focus(); return false; } }
				 if (form.password.value == "") { alert( "Nem töltötted ki a jelszó mezõt!" ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "A jelszavad túl rövid!" ); form.password.focus(); return false; } }
				 if (form.password2.value == "") { alert( "Nem töltötted ki a jelszó mégegyszer mezõt!" ); form.password2.focus(); return false; }
				 if (form.password.value == form.username.value) { alert( "Az account név és a jelszó nem egyezhetnek meg!" ); form.password.focus(); return false; }
				 if (form.password.value != form.password2.value) { alert( "A jelszó és annak megerõsítése nem egyezik meg!" ); form.password.focus(); return false; }
				 if (form.email.value == "") { alert( "Nem töltötted ki az email mezõt!" ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "Az email címed túl rövid!" ); form.email.focus(); return false; } }
				 if (form.security.value == "") { alert( "Nem töltötted ki az ellenõrzõ kérdés mezõt!" ); form.security.focus(); return false; }
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
					  Account név:
					  </td>
					  <td align="left">
					  <input name="username" type="text" maxlength="32" /> <font class="mini">Min 3, Max 32 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Jelszó:
					  </td>
					  <td align="left">
					  <input name="password" type="password" maxlength="32" /> <font class="mini">Min 6 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Jelszó mégegyszer:
					  </td>
					  <td align="left">
					  <input name="password2" type="password" maxlength="32" /> <font class="mini">Min 6 karakter</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Email cím:
					  </td>
					  <td align="left">
					  <input name="email" type="text" maxlength="64" />
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Kiegészítõ:
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
					<input name="security" type="text" maxlength="2" /> <font class="mini"><a title="Ezzel a kérdéssel szûrjük ki a robotokat" href="#">[?]</a></font>
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