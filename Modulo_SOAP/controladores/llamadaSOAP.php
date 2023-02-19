<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://webservicesadu.afip.gob.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'SOAPAction' => 'Ar.Gob.Afip.Dga.wconsdeclaracion/DetalladaListaDeclaraciones',
  'Content-Type' => 'text/xml; charset=utf-8',
  'Cookie' => 'f5avraaaaaaaaaaaaaaaa_session_=ELDDGOGLLMJNKCAEIKMIGLKFIOGJLMIMGLGBOAKNANHAMNBBJEOEBOBHMKNJBFPGDCDDMLPHJGOBLCMBFOFACNLLAILOGFKOAMDOMNLMLCMHANFPCCMDANLMIJFKPECB; TS019fbd8e=0145b27a97dfd243bb5c56fc0c167dfbf2c86b6f9d90b66487445ee94fda9749fbe80d5610a674e44854295da7f2e4a70883b1d5d36b06dfacd4992295428644b5ac925e6b'
));
$request->setBody('<?xml version="1.0" encoding="utf-8"?>
\n<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
\n    <soap:Body>
\n        <DetalladaListaDeclaraciones xmlns="Ar.Gob.Afip.Dga.wconsdeclaracion">
\n            <argWSAutenticacionEmpresa>
\n                <Token></Token>
\n                <Sign></Sign>
\n                <CuitEmpresaConectada>33693450239</CuitEmpresaConectada>
\n                <TipoAgente>DESP</TipoAgente>
\n                <Rol>DESP</Rol>
\n            </argWSAutenticacionEmpresa>
\n            <argDetalladasListaParams>
\n                <IdentificadorDeclaracion></IdentificadorDeclaracion>
\n                <CuitImportadorExportador>33693450239</CuitImportadorExportador>
\n                <CuitDespachante>27204282183</CuitDespachante>
\n                <CodigoAduanaRegistro></CodigoAduanaRegistro>
\n                <CodigoSubregimen></CodigoSubregimen>
\n                <FechaOficializacionDesde>2023-01-02</FechaOficializacionDesde>
\n                <FechaOficializacionHasta>2023-01-31</FechaOficializacionHasta>
\n                <CodigoEstadoDeclaracion>string</CodigoEstadoDeclaracion>
\n                <CodigoTipoOperacion>string</CodigoTipoOperacion>
\n            </argDetalladasListaParams>
\n        </DetalladaListaDeclaraciones>
\n    </soap:Body>
\n</soap:Envelope>');
try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
