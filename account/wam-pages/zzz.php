<?php

// Comprobación
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin,charrename");

$settings = array(
    "IP"        => "127.0.0.1",
    "PORT"        => 7878, 
    "USERNAME"    => "SOIR", 
    "PASSWORD"    => "socuello33", 
    "DEBUG"        => true, //No lo toques diego ¬¬
);

function ExecuteSoapCommand($command)
{
    global $connection;

    try 
    {
        $result = $connection->executeCommand(new SoapParam($command, "command"));
    }
    catch(Exception $e) 
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
|Fecha: $date, Hora: $time, De: $ip
|Error: $error   
|----------------------------Error al conectar con Dynamite-----------------------------------";

    $f = fopen("soaperror.log", "a+");
    fwrite($f, $errorstring);
    fclose($f);

    //
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

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,not-banned");

// Csatlakozás a characters adatbázishoz
db_select($mysql_db_characters);

// Inputok kitöltésének ellenõrzése
if(!empty($_POST["playername"])){

	// Posztolt adatok átalakítás
	$post_playertransaction_playername = variable($_POST["playername"], "", "db");

	// Posztolt adatok ellenõrzése
	string_check($post_playertransaction_playername, 32, ">", "Error con el nombre de PJ");

	// Játékos ellenõrzése
	$query_playertransaction_check = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_playertransaction_playername."'");
	$results_playertransaction_check = mysqli_fetch_array($query_playertransaction_check);
	if($results_playertransaction_check[0] == 0){

		system_message("El Personaje no existe.");

	}

	// Mûvelet elvégzése
	switch($site_post_action){

		
		// Szint nullázás
		case "level":
		$soap_command = ExecuteSoapCommand("tele name soir ventormenta");
		break;

		// Pénz nullázás
		case "money":
		db_query("UPDATE characters SET money = '0' WHERE name = '".$post_playertransaction_playername."'");
		break;

		// Creditos de Cuenta
		case "creditos":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET creditos = (creditos +10) WHERE username = '".$post_playertransaction_playername."'");
		break;

		// Bloquear cuenta
		case "bloq":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET locked = 1, last_ip = 1 WHERE username = '".$post_playertransaction_playername."'");
		break;

		// Bloquear cuenta
		case "unloq":
		db_select($mysql_db_realmd);
		db_query("UPDATE account SET locked = 0 WHERE username = '".$post_playertransaction_playername."'");
		break;

		default:
		system_message("Error al realizar la operacion!");
		break;

	}

	system_message("Operación realizada con éxito.");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Indica el nombre del jugador!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "A játékos név túl rövid!" ); form.playername.focus(); return false; } }
				 if (form.action.value == "") { alert( "Nem választottál mûveletet!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Operaciones con PJs<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="Játékos mûveletek" />
				 
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
						  
						  Añade oro predeterminado a un jugador, borra el jugador...
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=asoirlegustaelsexo2" method="POST" onsubmit="return checkform(playertransaction);" name="playertransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Nombre de Jugador o Cuenta: <input name="playername" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>???</option><option value="delete">Borrar</option><option value="level">Reiniciar Nivel a 1</option><option value="money">Reiniciar Oro a 0</option><option value="creditos">Añadir 10 Créditos</option><option value="bloq">Baneo Preventivo</option><option value="unloq">Desbaneo</option></select> <input type="submit" value="Enviar" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
