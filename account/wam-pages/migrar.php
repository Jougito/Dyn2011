<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

if(!empty($_POST["message"])){

	$post_bug_message = $_POST["message"];

	mail($site_admin_email, "".$site_title." - Migraciones", ".$post_bug_message." ".$post_bug_nombrepj.", "");

	system_message("Mensaje enviado con éxito al administrador!");

}

?>
				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.message.value == "") { alert( "Debes indicar un nombre de cuenta!" ); form.message.focus(); return false; }
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
				<form action="?id=migrar" method="POST" onsubmit="return checkform(bug);" name="bug"> 
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right">
						 Nombre de cuenta:
						 </td>
						 <td align="left">
						 <input name="message" class="normal" type="text" maxlength="32" value="<?php echo $user_check_accountname; ?>"/> <font class="mini"><a href="#" title="Introduce aquí tu nombre de cuenta">[?]</a> </font>
						 </td>
					   </tr>
				       <tr>
					     <td align="right">
						 Email:
						 </td>
						 <td align="left">
						 <input name="email" class="normal" type="email" value="<?php echo $user_check_email; ?>" maxlength="32" /> <font class="mini"><a href="#" title="Email donde poder contactar y enviar la informacion del estado de la migracion.">[?]</a></font>
						 </td>
					   </tr>
					   					   <tr>
					     <td align="right">
						 Nombre de PJ:
						 </td>
						 <td align="left">
						 <input name="nombrepj" class="normal" type="text" maxlength="32" /> <font class="mini"><a href="#" title="PJ al que se le entregará la migración, no lo crees en tu cuenta.">[?]</a></font>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Nivel:
						 </td>
						 <td align="left">
					     <input name="nivel" class="normal" type="text" maxlength="2"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Cabeza:
						 </td>
						 <td align="left">
					     <input name="item1" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Cuello:
						 <td align="left">
					     <input name="item2" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Hombro:
						 </td>
						 <td align="left">
					     <input name="item3" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Espalda:
						 </td>
						 <td align="left">
					     <input name="item4" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Pecho:
						 </td>
						 <td align="left">
					     <input name="item5" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Tabardo:
						 </td>
						 <td align="left">
					     <input name="item6" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Muñeca:
						 </td>
						 <td align="left">
					     <input name="item7" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Manos:
						 </td>
						 <td align="left">
					     <input name="item8" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Cintura:
						 </td>
						 <td align="left">
					     <input name="item9" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Piernas:
						 <td align="left">
					     <input name="item10" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Pies:
						 </td>
						 <td align="left">
					     <input name="item11" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Anillo1:
						 </td>
						 <td align="left">
					     <input name="item12" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Anillo2:
						 </td>
						 <td align="left">
					     <input name="item13" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Abalorio1:
						 </td>
						 <td align="left">
					     <input name="item14" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Item Abalorio2:
						 </td>
						 <td align="left">
					     <input name="item15" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
<tr>
					     <td align="right">
						 ID Arma Izquierda:
						 </td>
						 <td align="left">
					     <input name="item16" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
					   <tr>
<tr>
					     <td align="right">
						 ID Arma Derecha:
						 </td>
						 <td align="left">
					     <input name="item17" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
					   <tr>
<tr>
					     <td align="right">
						 ID Reliquia:
						 </td>
						 <td align="left">
					     <input name="item18" class="normal" type="text" maxlength="50"/>
						 </td>
					   </tr>
					   <tr>
<tr>
					     <td align="right">
						 Otras IDs:
						 </td>
						 <td align="left">
					     <input name="item19" class="normal" type="text" maxlength="50"/> <font class="mini"><a href="#" title="Separar con comas las IDs de monturas, etc...">[?]</a></font>
						 </td>
					   </tr>
					   <tr>

					     <td align="right" colspan="2">
						 <input type="submit" value="Enviar Migración" class="input-sbm" />
						 </td>
					   </tr>
					</table>
					</form>
				 
				 </td>
			   </tr>
			 </table>
