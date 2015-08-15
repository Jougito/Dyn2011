<?php

// Comprobación
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,charrename");

$settings = array(
    "IP"        => "127.0.0.1", //Your server's IP address
    "PORT"        => 7878, //7878 is the default Port
    "USERNAME"    => "SOIR", //Must be in UPPERCASE in both, Database AND This file
    "PASSWORD"    => "socuello33", //Password of the account give above
    "DEBUG"        => true, //If "True" then errors will be printed in html and if false ... They'll only be printed in file
);

function ExecuteSoapCommand($command)
{
    global $connection;

    try //Try to execute function
    {
        $result = $connection->executeCommand(new SoapParam($command, "command"));
    }
    catch(Exception $e) //Don't give fatal error if there is a problem
    {
        LogSoapError($e);
        return array('sent' => false, 'message' => $e->getMessage());
    }

    return array('sent' => true, 'message' => $result);
}

function LogSoapError($e)
{
    global $settings;
    $date = date('D d/m/Y');
    $time = date('G:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $error = $e->getMessage();
    $errorcode = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();

    $errorstring = "\r\n
|----------------------------Error al conectar con Dynamite-----------------------------------
|Fecha: $date, Hora: $time, From: $ip
|Lugar: $file(Line: $line) Código de Error: $errorcode
|Error: $error
|----------------------------Error al conectar con Dynamite-----------------------------------";

    $f = fopen("soaperror.log", "a+");
    fwrite($f, $errorstring);
    fclose($f);

    //IF $debug == true the error will be shown in HTML
    if($settings['DEBUG'])
        print $errorstring;
}

$connection = new SoapClient(NULL,
    array(
        "location" => "http://".$settings['IP'].":".$settings['PORT']."/",
        "uri" => "urn:TC",
        "style" => SOAP_RPC,
        "login" => $settings['USERNAME'],
        "password" => $settings['PASSWORD'],
    )
);


$soap_command = ExecuteSoapCommand('send item Soir "Hola" "Items" 43087[1]');
if($soap_command['sent'])
    echo("<center>Envio de objeto realizado satisfactoriamente.</center>");


else
    echo "Hay un error, vuelvelo a intentar más tarde.";

?>

<script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "No se ha seleccionado un personaje." ); form.mycharacter.focus(); return false; }
				 if (form.newname.value == "") { alert( "No se ha escrito un nombre nuevo." ); form.newname.focus(); return false; } else { if (form.newname.value.length < 2) { alert( "El nuevo nombre es demasiado corto." ); form.newname.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia - Renombrar Personaje<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Karakter átnevezés" />
				 
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
						  
						  Aquí puedes renombrar un personaje de tu cuenta.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=donate1" method="POST" onsubmit="return checkform(charrename);" name="charrename"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="left">
					 Personajes en mi Cuenta: <select name="mycharacter">
					 
					 <option SELECTED value="">Ninguno Seleccionado</option>
					 
					 <?php
					 
					 while($results_charrename_characters = mysqli_fetch_array($query_charrename_characters)){
					 
						 echo '<option value="'.$results_charrename_characters["guid"].'">'.$results_charrename_characters["name"].'</option>';
						 
					 }
					 
					 ?>
					
					 
				     </td>
				   </tr>
					<tr>
<td>
</select>  Nuevo nombre de mi PJ: <input maxlength="12" type="text" name="newname" />
</td>
<td>
<input type="submit" value="Actualizar" class="input-sbm" />
</td>
					</tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
