<?php

$curl = curl_init();

echo( "<pre>" );
	print_r( $curl );
echo( "</pre>" );

curl_setopt_array( $curl, array(
  CURLOPT_URL => 'https://webservicesadu.afip.gob.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:ar="Ar.Gob.Afip.Dga.wconsdeclaracion">
    <soap:Header/>
    <soap:Body>
        <ar:DetalladaListaDeclaraciones>
            <ar:argWSAutenticacionEmpresa>
                <ar:Token>PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/Pgo8c3NvIHZlcnNpb249IjIuMCI+CiAgICA8aWQgc3JjPSJDTj13c2FhLCBPPUFGSVAsIEM9QVIsIFNFUklBTE5VTUJFUj1DVUlUIDMzNjkzNDUwMjM5IiB1bmlxdWVfaWQ9IjM1MjA0MzM3MDIiIGdlbl90aW1lPSIxNjc2NDY5NTEwIiBleHBfdGltZT0iMTY3NjUxMjc3MCIvPgogICAgPG9wZXJhdGlvbiB0eXBlPSJsb2dpbiIgdmFsdWU9ImdyYW50ZWQiPgogICAgICAgIDxsb2dpbiBlbnRpdHk9IjMzNjkzNDUwMjM5IiBzZXJ2aWNlPSJ3Y29uc2RlY2xhcmFjaW9uIiB1aWQ9IkM9YXIsIFNUPWNhYmEsIEw9Y2FiYSwgTz1hbmFiZWwgcGVyZXogYmVtcG9yYXQsIE9VPWZhY3R1cmFjaW9uLCBTRVJJQUxOVU1CRVI9Q1VJVCAyNzIwNDI4MjE4MywgQ049YW5hYmVsIiBhdXRobWV0aG9kPSJjbXMiIHJlZ21ldGhvZD0iMjIiPgogICAgICAgICAgICA8cmVsYXRpb25zPgogICAgICAgICAgICAgICAgPHJlbGF0aW9uIGtleT0iMjcyMDQyODIxODMiIHJlbHR5cGU9IjQiLz4KICAgICAgICAgICAgPC9yZWxhdGlvbnM+CiAgICAgICAgPC9sb2dpbj4KICAgIDwvb3BlcmF0aW9uPgo8L3Nzbz4K</ar:Token>
                <ar:Sign>MseVBnUb4wUZHRHq99gAHcmqVcKLUCnO5N70lb/ps1hBKedvWdCPjiPTpcWshwqtAroYdh4WvoXNhvlbx2Wffx/t8usks7zjF3KSLeYUF0IW1rgHZSgbAPAm1kz/m1opOa8wfsileuohkELzHa0rufpSFqM9yA7pBO0cPNk568E=</ar:Sign>
                <ar:CuitEmpresaConectada>27204282183</ar:CuitEmpresaConectada>
                <ar:TipoAgente>DESP</ar:TipoAgente>
                <ar:Rol>DESP</ar:Rol>
            </ar:argWSAutenticacionEmpresa>
            <ar:argDetalladasListaParams>
                <ar:IdentificadorDeclaracion></ar:IdentificadorDeclaracion>
                <ar:CuitImportadorExportador></ar:CuitImportadorExportador>
                <ar:CuitDespachante>27204282183</ar:CuitDespachante>
                <ar:CodigoAduanaRegistro></ar:CodigoAduanaRegistro>
                <ar:CodigoSubregimen></ar:CodigoSubregimen>
                <ar:FechaOficializacionDesde>2023-01-01T00:00:00-03:00</ar:FechaOficializacionDesde>
                <ar:FechaOficializacionHasta>2023-01-31T00:00:00-03:00</ar:FechaOficializacionHasta>
                <ar:CodigoEstadoDeclaracion></ar:CodigoEstadoDeclaracion>
                <ar:CodigoTipoOperacion></ar:CodigoTipoOperacion>
            </ar:argDetalladasListaParams>
        </ar:DetalladaListaDeclaraciones>
    </soap:Body>
    </soap:Envelope>'
  ),
) ;

$response = curl_exec($curl);
echo( "<pre>" );
    echo( '$response -> ' );
    print_r( $response );
    echo( '<- $response' );
echo( "</pre>" );

if ( empty( $response ) ) {
    echo( "<pre>" );
	    echo( 'empty -> $response');
    echo( "</pre>" );
    curl_close($curl);
}
else {
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ( empty( $httpcode['http_code'] ) ) {
        echo( "<pre>" );
	        echo( 'empty -> $httpcode' . PHP_EOL );
            echo( '$response -> ' );
            print_r( $response );
            echo( '<- $response' );
            echo( $response );
            echo( "</pre>" );
    }
    else {
        if( $httpcode == 200 ) {
            echo( "<pre>" );
                echo( '$response -> ' );
                print_r( $response );
                echo( '<- $response' );
            echo( "</pre>" );
        }
        else {
            echo( "<pre>" );
            echo( "HTTP Code  -> " . $httpcode . PHP_EOL);
            echo( '$response -> ' );
            print_r( $response );
            echo( '<- $response' );
        echo( "</pre>" );
        }
    }
}

echo $response;