<?php

$wsdl = 'https://www.crcind.com/csp/samples/SOAP.Demo.CLS?WSDL'; //URL de nuestro servicio soap

//Basados en la estructura del servicio armamos un array
$params = Array(
    "Arg1" => 5,
    "Arg2" => 10
    );

$options = Array(
	"uri"=> $wsdl,
	"style"=> SOAP_RPC,
	"use"=> SOAP_ENCODED,
	"soap_version"=> SOAP_1_1,
	"cache_wsdl"=> WSDL_CACHE_BOTH,
	"connection_timeout" => 15,
	"trace" => false,
	"encoding" => "UTF-8",
	"exceptions" => false,
);

//Enviamos el Request
$soap = new SoapClient($wsdl, $options);
$result = $soap->AddInteger($params); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
var_dump($result);
echo( "</br>" );
print_r($result);

$wsdl = "https://webservicesadu.afip.gov.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx";
$ns = "https://webservicesadu.afip.gov.ar/";

$client = new SoapClient("http://www.ukverify.co.uk/webservice.asmx?wsdl");
// https://webservicesadu.afip.gob.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx
// https://webservicesadu.afip.gob.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx?WSDL
// Ar.Gob.Afip.Dga.wconsdeclaracion/DetalladaListaDeclaraciones
//Basados en la estructura del servicio armamos un array
$fechafinal = date("c", time() );
$fechainicial = date("c", time() - 30*24*60*60 );

/*
Firma retornada por el WSAA 
Token retornado por el WSAA -> 992 bytes
Sign ->  172 bytes
Firma retornada por el WSAA 
TipoAgente
“IMEX” (Importador/Exportador); “IEOC”
(Importador/Exportador ocasional); “DESP”
(Despachante); “USUD” (Usuarios Directos) 
Rol
“IMEX”;”IEOC”;”DESP”;”USUD” 
*/

$params = Array(
    "IdentificadorDeclaracion" => "",
    "CuitImportadorExportador" => "33693450239", 
	"CuitDespachante" => "27204282183",
	"CodigoAduanaRegistro" => "",
	"CodigoSubregimen" => "",
	"FechaOficializacionDesde" => $fechainicial,
	"FechaOficializacionHasta" => $fechafinal,
	"CodigoEstadoDeclaracion" => "",
	"CodigoTipoOperacion" => ""
    );

$options = Array(
	"uri"=> $wsdl,
	"style"=> SOAP_RPC,
	"use"=> SOAP_ENCODED,
	"soap_version"=> SOAP_1_2,
	"cache_wsdl"=> WSDL_CACHE_BOTH,
	"connection_timeout" => 15,
	"trace" => false,
	"encoding" => "UTF-8",
	"exceptions" => false,
    "local_cert" => "../Documentacion/Anabel.crt",
	// "location" => "https://webservicesadu.afip.gov.ar/DIAV2/",
	// "passphrase"   => self::KEY,
	// "soap_action" => "Ar.Gob.Afip.Dga.wconsdeclaracion/DetalladaListaDeclaraciones",
	// "token" => "",
	// "sign" => "",
);

echo( "<pre>" );
	print_r( $params );
	print_r( $options );
echo( "</pre>" );

try {
	$soap = new SoapClient( $wsdl, $options ) ;
	$result = $soap->DetalladaListaDeclaraciones( $params ); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
}
catch (SoapFault $exp) {
    echo "Message: ".$exp->faultstring."<br />";
    echo "Error Code: ".$exp->faultcode."<br />";
    echo "Line: ".$exp->getLine()."<br />";
    //echo "Detail:<pre>".$exp->xdebug_message."</pre>";
    echo "Trace:<pre>".$exp->getTraceAsString()."</pre>";
}
catch (Exception $result) {
}

//$result = $soap->_SoapCall("wconsdeclaracion", $params); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
var_dump($result);
echo( "</br>" );
print_r($result);
