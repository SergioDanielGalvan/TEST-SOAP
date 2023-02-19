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
\n                <Token>PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/Pgo8c3NvIHZlcnNpb249IjIuMCI+CiAgICA8aWQgc3JjPSJDTj13c2FhLCBPPUFGSVAsIEM9QVIsIFNFUklBTE5VTUJFUj1DVUlUIDMzNjkzNDUwMjM5IiB1bmlxdWVfaWQ9IjQxMDc3MTA0NTAiIGdlbl90aW1lPSIxNjcwMjQzMjU3IiBleHBfdGltZT0iMTY3MDI4NjUxNyIvPgogICAgPG9wZXJhdGlvbiB0eXBlPSJsb2dpbiIgdmFsdWU9ImdyYW50ZWQiPgogICAgICAgIDxsb2dpbiBlbnRpdHk9IjMzNjkzNDUwMjM5IiBzZXJ2aWNlPSJ3Y29uc2RlY2xhcmFjaW9uIiB1aWQ9IkM9YXIsIFNUPWNhYmEsIEw9Y2FiYSwgTz1hbmFiZWwgcGVyZXogYmVtcG9yYXQsIE9VPWZhY3R1cmFjaW9uLCBTRVJJQUxOVU1CRVI9Q1VJVCAyNzIwNDI4MjE4MywgQ049YW5hYmVsIiBhdXRobWV0aG9kPSJjbXMiIHJlZ21ldGhvZD0iMjIiPgogICAgICAgICAgICA8cmVsYXRpb25zPgogICAgICAgICAgICAgICAgPHJlbGF0aW9uIGtleT0iMjcyMDQyODIxODMiIHJlbHR5cGU9IjQiLz4KICAgICAgICAgICAgPC9yZWxhdGlvbnM+CiAgICAgICAgPC9sb2dpbj4KICAgIDwvb3BlcmF0aW9uPgo8L3Nzbz4K</Token>
\n                <Sign>Qznmsyxghbg3/mavFAWciDmzOKigUntzQdT+XRU6d3zFhOH0ZXpTDZn7/6XgLppgGJH1EH4yA6zgWf/rzucPUHvS6K2wH/+8sdyF8SnR/30rEzcQMHQFwHuzFF/w5NIcA5OHhGI8RWpL9hypPcLMgZn6dlZdR4IFKE2hDDhkqKQ=</Sign>
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