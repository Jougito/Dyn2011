<?php

// Comprobación
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

// Información de oro de cuenta
$query_orogastado = db_query("SELECT creditos_gastados FROM account WHERE id = '".$user_check_accountid."'");
$results_orogastado = mysqli_fetch_array($query_orogastado);


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
|----------------------------Error al conectar con Dynamite-----------------------------------<br>
|Fecha: $date, Hora: $time, De: $ip<br>
|Error: $error   <br>
|----------------------------Error al conectar con Dynamite-----------------------------------<br>";

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





?>

<table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Tienda de Vesperia<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Tienda" />
				 
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
						  
						  Envia un objeto a tu cuenta desde esta web.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=enviar_1_2" method="POST" onsubmit="return checkform(chartrans);" name="chartrans" > 
				 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
					     <td width="150px" align="center">
						 Titular de la cuenta: <b><?php echo $user_check_accountname; ?></b>
						</p>
						 </td>
					   </tr>
					   <tr>
					     <td width="150px" align="center">
						 Creditos de la cuenta: <b><font color="green"><?php echo $results_oro["creditos"]; ?></font></b>
						</p>
						 </td>
					   </tr>
					   <tr>
					     <td width="150px" align="center">
						 Creditos gastados de la cuenta: <b><font color="red"><?php echo $results_orogastado["creditos_gastados"]; ?></font></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						 Identificador de la cuenta: <b><?php echo $user_check_accountid; ?></b>
						</p>
						 </td>
					   </tr>

					   <tr>
					     <td width="150px" align="center">
						  <img src="/imagesv/objetos/lupa.png" onMouseOver="this.src='/imagesv/objetos/manzana.jpg'" onMouseOut="this.src='/imagesv/objetos/lupa.png'" style="cursor:pointer;">
						</p>
						 </td>
					   </tr>
				   <tr>
				     <td align="center">
					 <?php $soap_command = ExecuteSoapCommand('send item '.$_POST["pj"].' "Objetos de Recompensa" "Casa de Regalos: Aquí tienes el objeto que pediste desde nuestra web, recuerda que si no lo has pedido tu, ¡es un regalo de un amigo!." 43087[1]');
if($soap_command['sent'])
    echo("<center>Envio de objeto realizado satisfactoriamente.</p>Revisa tu correo para recoger los objetos.</center>");


else
    echo "Hay un error, vuelvelo a intentar en un rato, puede que el personaje al que intentas enviar el objeto no exista.";
?>
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>
