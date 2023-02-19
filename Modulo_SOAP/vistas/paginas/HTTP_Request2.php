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
\n                <ar:Token></ar:Token>
\n                <ar:Sign></ar:Sign>
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
