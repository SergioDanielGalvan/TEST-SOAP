<?php
    // https://webservicesadu.afip.gov.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx 

    class clienteSOAP {
        public $wsdl = "";

        private $cuit_cliente = "";
        private $options = Array(
            "uri"=> $wsdl,
            "style"=> SOAP_RPC,
            "use"=> SOAP_ENCODED,
            "soap_version"=> SOAP_1_1,
            "cache_wsdl"=> WSDL_CACHE_BOTH,
            "connection_timeout" => 15,
            "trace" => false,
            "encoding" => "UTF-8",
            "exceptions" => false,
            "local_cert" => "");

        function __construct( $url = "", $nro_cuit = "", $url_certificado = "") {
            if ( $url == "" ) {
                $this->wsdl = "https://webservicesadu.afip.gov.ar/DIAV2/wconsdeclaracion/wconsdeclaracion.asmx";
            }
            else {
                $this->wsdl = $url;
            }
            if ( $nro_cuit !== "" ) {
                $this->cuit_cliente = $nro_cuit;
            }
            if ( $url_certificado !== "" ) {
                if ( file_exists( $url_certificado ) ) {
                    $options[ "local_cert" ] = $url_certificado
                }
            }
        }

        function __destruct() {
            // Liberar recursos.
        }

    } 