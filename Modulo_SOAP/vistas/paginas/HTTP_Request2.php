<?php
require_once './vendor/pear/http_request2/HTTP/Request2.php';
//F:\xampp\htdocs\Modulo_SOAP\vendor\pear\http_request2\HTTP

$request = new HTTP_Request2();
$request->setUrl('https://webservicesadu.afip.gob.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
) );
$request->setHeader(array(
  'Action' => 'Ar.Gob.Afip.Dga.wconsdeclaracion/DetalladaListaDeclaraciones',
  'Content-Type' => 'text/xml+soap; charset=utf-8',
  'Cookie' => 'f5avraaaaaaaaaaaaaaaa_session_=GIEFCFBOOKFCLDBFPDPHGDFEBPFCIPMOCEHIJHBCBFKJILGNMDALKPKAJCADGKFDALHDNPGLFODHDPHCJAEAMAKOLGOPMLJNDAKMHLOJBICJDJHPAIGKHAKADLEJGJBM; TS019fbd8e=0145b27a97c7948f7990b03d66e6cb1013821f47b5a2e8b6caf757e41139a87aafe13de0056dcb6410994261f505568b72e75dc2b0af2d09ad428a5bb30f114166bc7d8579'
));
$request->setBody('<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:ar="Ar.Gob.Afip.Dga.wconsdeclaracion">
\n    <soap:Header/>
\n    <soap:Body>
\n        <ar:DetalladaListaDeclaraciones>
\n            <ar:argWSAutenticacionEmpresa>
\n                <ar:Token>PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/Pgo8c3NvIHZlcnNpb249IjIuMCI+CiAgICA8aWQgc3JjPSJDTj13c2FhLCBPPUFGSVAsIEM9QVIsIFNFUklBTE5VTUJFUj1DVUlUIDMzNjkzNDUwMjM5IiB1bmlxdWVfaWQ9IjM1MjA0MzM3MDIiIGdlbl90aW1lPSIxNjc2NDY5NTEwIiBleHBfdGltZT0iMTY3NjUxMjc3MCIvPgogICAgPG9wZXJhdGlvbiB0eXBlPSJsb2dpbiIgdmFsdWU9ImdyYW50ZWQiPgogICAgICAgIDxsb2dpbiBlbnRpdHk9IjMzNjkzNDUwMjM5IiBzZXJ2aWNlPSJ3Y29uc2RlY2xhcmFjaW9uIiB1aWQ9IkM9YXIsIFNUPWNhYmEsIEw9Y2FiYSwgTz1hbmFiZWwgcGVyZXogYmVtcG9yYXQsIE9VPWZhY3R1cmFjaW9uLCBTRVJJQUxOVU1CRVI9Q1VJVCAyNzIwNDI4MjE4MywgQ049YW5hYmVsIiBhdXRobWV0aG9kPSJjbXMiIHJlZ21ldGhvZD0iMjIiPgogICAgICAgICAgICA8cmVsYXRpb25zPgogICAgICAgICAgICAgICAgPHJlbGF0aW9uIGtleT0iMjcyMDQyODIxODMiIHJlbHR5cGU9IjQiLz4KICAgICAgICAgICAgPC9yZWxhdGlvbnM+CiAgICAgICAgPC9sb2dpbj4KICAgIDwvb3BlcmF0aW9uPgo8L3Nzbz4K</ar:Token>
\n                <ar:Sign>MseVBnUb4wUZHRHq99gAHcmqVcKLUCnO5N70lb/ps1hBKedvWdCPjiPTpcWshwqtAroYdh4WvoXNhvlbx2Wffx/t8usks7zjF3KSLeYUF0IW1rgHZSgbAPAm1kz/m1opOa8wfsileuohkELzHa0rufpSFqM9yA7pBO0cPNk568E=</ar:Sign>
\n                <ar:CuitEmpresaConectada>27204282183</ar:CuitEmpresaConectada>
\n                <ar:TipoAgente>DESP</ar:TipoAgente>
\n                <ar:Rol>DESP</ar:Rol>
\n            </ar:argWSAutenticacionEmpresa>
\n            <ar:argDetalladasListaParams>
\n                <ar:IdentificadorDeclaracion></ar:IdentificadorDeclaracion>
\n                <ar:CuitImportadorExportador></ar:CuitImportadorExportador>
\n                <ar:CuitDespachante>27204282183</ar:CuitDespachante>
\n                <ar:CodigoAduanaRegistro></ar:CodigoAduanaRegistro>
\n                <ar:CodigoSubregimen></ar:CodigoSubregimen>
\n                <ar:FechaOficializacionDesde>2023-01-01T00:00:00-03:00</ar:FechaOficializacionDesde>
\n                <ar:FechaOficializacionHasta>2023-01-31T00:00:00-03:00</ar:FechaOficializacionHasta>
\n                <ar:CodigoEstadoDeclaracion></ar:CodigoEstadoDeclaracion>
\n                <ar:CodigoTipoOperacion></ar:CodigoTipoOperacion>
\n            </ar:argDetalladasListaParams>
\n        </ar:DetalladaListaDeclaraciones>
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
catch( HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}