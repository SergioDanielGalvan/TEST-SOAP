<?php
error_reporting(E_ALL ^ E_NOTICE);
if($_GET["op"] == "EstadoIp"){
	if($_GET["Puerto"]!=""){
		$fp = @fsockopen("tcp://reportsystem.ddns.net",$_GET["Puerto"],$errno, $errstr, 5); 
		if($fp){ echo "OK".$_GET["Puerto"]; } else { echo "NO CONECTA ".$errstr.$_GET["Puerto"]; }
	}else{
		$fp = @fsockopen("tcp://reportsystem.ddns.net",'44462',$errno, $errstr, 5); 
		if($fp){ echo "OK"; } else { echo "NO CONECTA PUERTO 44462 ".$errstr; }
	}

	exit;
}

if($_GET["op"] == "eliminarlogs"){
    if(is_dir("Logs")){exec ("rm -R Logs");}
    exit;
}

if($_GET["op"] == "darlogs"){
    if(is_dir("Logs")){
        $dir = opendir("Logs");
        while ($elemento = readdir($dir)){
            if($elemento!="." and $elemento!=".."){
                echo "BOUNDARY:6d534a68bd56ffd735e7b4a130d378b7".$elemento."||-||".file_get_contents("Logs/".$elemento);;
            }
        }
        closedir($dir);
    }
exit;
}

if($_POST["op"] == "actualiza2"){
    $dir = "Certificados_test";

    if(is_dir($dir)){exec ("rm -R ".$dir);}
    mkdir($dir);
    $AliasClientes = explode("|",eregi_replace(" ","+",$_POST["AliasClientes"]));
    $CodigosClientes = explode("|",eregi_replace(" ","+",$_POST["CodigosClientes"]));
    $SourcesClientes = explode("|",eregi_replace(" ","+",$_POST["SourcesClientes"]));
    $CertificadosClientes = explode("|",eregi_replace(" ","+",$_POST["CertificadosClientes"]));
    $PassClientes = explode("|",eregi_replace(" ","+",$_POST["PassClientes"]));
    $PemClientes = explode("|",eregi_replace(" ","+",$_POST["PemClientes"]));

    for($a=0;$a<=count($AliasClientes)-1;$a++){
        $cert=strtoupper(base64_decode($AliasClientes[$a]));
        $daPem=$PemClientes[$a];
        if (!file_exists($dir.'/'.$cert)) {
            mkdir($dir."/".$cert);
        }
        file_put_contents($dir."/".strtoupper(base64_decode($CodigosClientes[$a])).".txt",$cert);
        file_put_contents($dir."/".$cert."/".$cert.".pss",base64_decode($PassClientes[$a]));
        file_put_contents($dir."/".$cert."/".$cert.".sou",base64_decode($SourcesClientes[$a]));
        file_put_contents($dir."/".$cert."/".$cert.".crt","-----BEGIN CERTIFICATE-----".chr(10).$CertificadosClientes[$a].chr(10)."-----END CERTIFICATE-----".chr(10));
        file_put_contents($dir."/".$cert."/".$cert.".pem","-----BEGIN RSA PRIVATE KEY-----".chr(10)."Proc-Type: 4,ENCRYPTED".chr(10)."DEK-Info: DES-EDE3-CBC,".substr($daPem,0,16).chr(10).chr(10).substr($daPem,16).chr(10)."-----END RSA PRIVATE KEY-----".chr(10));
    }
    echo "OK Certificados_test";
    exit;
}

if($_POST["op"] == "actualiza"){
    $AliasClientes = explode("|",eregi_replace(" ","+",$_POST["AliasClientes"]));
    $CodigosClientes = explode("|",eregi_replace(" ","+",$_POST["CodigosClientes"]));
    $SourcesClientes = explode("|",eregi_replace(" ","+",$_POST["SourcesClientes"]));
    $CertificadosClientes = explode("|",eregi_replace(" ","+",$_POST["CertificadosClientes"]));
    $PassClientes = explode("|",eregi_replace(" ","+",$_POST["PassClientes"]));
    $PemClientes = explode("|",eregi_replace(" ","+",$_POST["PemClientes"]));

    for($a=0;$a<=count($AliasClientes)-1;$a++){
        $cert=strtoupper(base64_decode($AliasClientes[$a]));
        $daPem=$PemClientes[$a];
		if(is_dir('Certificados/'.$cert)){exec ("rm -R Certificados/".$cert);}
        //if (!file_exists('Certificados/'.$cert)) {
			mkdir("Certificados/".$cert);
		//}
        file_put_contents("Certificados/".strtoupper(base64_decode($CodigosClientes[$a])).".txt",$cert);
        file_put_contents("Certificados/".$cert."/".$cert.".pss",base64_decode($PassClientes[$a]));
        file_put_contents("Certificados/".$cert."/".$cert.".sou",base64_decode($SourcesClientes[$a]));
        file_put_contents("Certificados/".$cert."/".$cert.".crt","-----BEGIN CERTIFICATE-----".chr(10).$CertificadosClientes[$a].chr(10)."-----END CERTIFICATE-----".chr(10));
        file_put_contents("Certificados/".$cert."/".$cert.".pem","-----BEGIN RSA PRIVATE KEY-----".chr(10).$daPem.chr(10)."-----END RSA PRIVATE KEY-----".chr(10));
    }
    echo "OK";
    exit;
}


if($_GET["Codigo"] == ""){
    echo "Falta Codigo";
    exit;
}
$Codigo=strtoupper($_GET["Codigo"]);

if(!file_exists("Certificados/".$Codigo.".txt")){
    echo "NO";
    exit;
}
else{
    if($_GET["op"] == "verificarcodigo"){
        echo "SI";
        exit;
    }
}

if($_GET["Serv"] == ""){
    echo "Falta Servicio";
    exit;
}

$serv = $_GET["Serv"];

if($_GET["PROD"] == "S"){
    $dest = "cn=wsaa,o=afip,c=ar,serialNumber=CUIT 33693450239";
    $url = "https://wsaa.afip.gov.ar/ws/services/LoginCms";
}
else{
    $dest = "cn=wsaahomo,o=afip,c=ar,serialNumber=CUIT 33693450239";
    $url = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";
}

$Cert = strtoupper(file_get_contents("Certificados/".$Codigo.".txt"));

if($_POST["op"] == "log"){
    if(!is_dir("Logs")){mkdir("Logs");}
    if ($_POST["nroidentificacion"]!= "" ){
        for($a=0;$a<=100;$a++){
            $nombreArchivo = "Logs/".$Cert."-".$_POST["re"]."-".$_POST["fo"]."-".$_POST["nroidentificacion"]."[".$a."].xml";
		if(!file_exists($nombreArchivo)){break;}
        }
    }else{
        for($a=0;$a<=100;$a++){
            $nombreArchivo = "Logs/".$Cert."-".$_POST["re"]."-".$_POST["fo"]."-".date("Y-m-d-H-i-s")."[".$a."].xml";
		if(!file_exists($nombreArchivo)){break;}
        }
    }
    file_put_contents($nombreArchivo,eregi_replace("_ampersand_","&",$_POST["datos"]));
    echo "OK";
    exit;
}


if($_POST["nuevodn"]!=""){
    $sour = base64_decode(eregi_replace(" ","+",$_POST["nuevodn"]));
    file_put_contents("Certificados/".$Cert."/".$Cert.".sou",$sour);
}
else{
    $sour = file_get_contents("Certificados/".$Cert."/".$Cert.".sou");
}

$pass =file_get_contents("Certificados/".$Cert."/".$Cert.".pss");

$date_r = getdate();

$FechaIni = date("Y-m-d",mktime(($date_r["hours"]-4),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]))."T".date("H:i:s-03:00",mktime(($date_r["hours"]-4),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]));
$FechaFin = date("Y-m-d",mktime(($date_r["hours"]+6),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]))."T".date("H:i:s-03:00",mktime(($date_r["hours"]+6),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]));
$xmltra = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><loginTicketRequest version=\"1.0\"><header><source>".$sour."</source><destination>".$dest."</destination><uniqueId>123456789</uniqueId><generationTime>".$FechaIni."</generationTime><expirationTime>".$FechaFin."</expirationTime></header><service>".$serv."</service></loginTicketRequest>";

file_put_contents("Certificados/".$Cert."/".$Cert.".xml",$xmltra);

if(openssl_pkcs7_sign("Certificados/".$Cert."/".$Cert.".xml","Certificados/".$Cert."/".$Cert.".cms", file_get_contents("Certificados/".$Cert."/".$Cert.'.crt'),array(file_get_contents("Certificados/".$Cert."/".$Cert.'.pem'), $pass),array(),!PKCS7_DETACHED)){
    $a = explode("\n\n",file_get_contents("Certificados/".$Cert."/".$Cert.'.cms'));
    echo "<soapenv:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://services.authws.sua.dvadac.desein.afip.gov\"><soapenv:Header/><soapenv:Body><ser:loginCms soapenv:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\"> <request xsi:type=\"xsd:string\">".eregi_replace("\n","",$a[1])."</request></ser:loginCms></soapenv:Body></soapenv:Envelope>";
}
else{echo "error Firmando ".openssl_error_string();}


?>