<?php 
// https://www.afip.gob.ar/ws/WSASS/html/index.html

class TimeZone {

    public $zonahoraria;

    function __construct() {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $zonahoraria = date_default_timezone_get();
    }

    public function fechaInicio() {
        // lo atraso 5 minutos porque si está 1 minuto adelantado rebota.
        $fecha = new DateTime();
        $fecha = $fecha->modify("-5 minute");
        return str_replace( ' ', 'T', $fecha->format("Y-m-d H:i:s") );
    }

    public function fechaInicio2() {
        $date_r = getdate();
        return date("Y-m-d",mktime(($date_r["hours"]-4),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]))."T".date("H:i:s-03:00",mktime(($date_r["hours"]-4),($date_r["minutes"]-5),$date_r["seconds"],$date_r["mon"],$date_r["mday"],$date_r["year"]));
    }

    public function fechaFin() {
        // lo doy una ventana de 6 horas.
        $fecha = new DateTime();
        $fecha = $fecha->modify("+6 hour");
        return str_replace( ' ', 'T', $fecha->format("Y-m-d H:i:s") );
    }

}

class Certificados {
    public $url_CRT = "";
    public $Servicio = "";
    private $stream_CRT = "";
    private $clave = "";
    private $datos_CRT = null;
    private $datos = null;
    public $errorInfo = "";
    public $nombre_Certificado = "";
    public $url_Certificado = "";

    public $private_key = "";
    public $public_key = "";
    public $configargs = array();

    function __construct( $_CTR = "" ) {
        if ( $_CTR !== "" ) {
            if ( file_exists( $_CTR ) ) {
                $this->url_CRT = $_CTR;
                /*
                $handle = fopen( $_CTR, "r");
                $this->stream_CRT = fread($handle, filesize( $_CTR ));
                fclose( $handle );
                */
                $this->stream_CRT = file_get_contents( $_CTR );
                $this->nombre_Certificado = basename( $_CTR, '.crt'); 
                $this->url_Certificado = dirname( $_CTR );
                if ( strcmp( $_CTR, "viviana.crt") > 0 ) {
                    $this->clave = "7719";
                }
                else {
                    $this->clave = "1234";
                }
                $this->datos = array();
                $berror = openssl_pkcs12_read( $this->stream_CRT, $this->datos, $this->clave );
                if ( $berror || isset( $this->datos['cert'] ) ) {
                    $this->datos_CRT = openssl_x509_parse( $this->datos['cert'], 0 );
                }
                else {
                    $this->errorInfo = "Error lectura Certificado";
                }             
                $this->Servicio = "wsfe";
            }
            else {
                $this->errorInfo = "Not Found";
            }
            echo( $this->url_CRT );
        }

    }

    public function NewPK() {
        $this->configargs = array(
            'config' => "F:/xampp/php/extras/openssl/openssl.cnf",
            'private_key_bits'=> 2048,
        );
        // 'private_key_type' => OPENSSL_KEYTYPE_RSA,
        // 'default_md' => "sha256",

        $res = openssl_pkey_new( $this->configargs );
        if ( $res ) {
            $key = openssl_pkey_get_details( $res );
            $this->public_key =  $key[ "key" ];
            file_put_contents( $this->url_Certificado . '/' . $this->nombre_Certificado . ".pem", $this->private_key);
            file_put_contents( $this->url_Certificado . '/' . $this->nombre_Certificado . ".key", $this->public_key);
        }
        else {
            $this->errorInfo = "Error generación clave privada nueva";
        }

        return $res;
    }

    public function PKExport( $res = null ) {
        if ( $res == null ) {
            $this->errorInfo = 'Error -> $res = null';
            return false;
        }
        else if ( $this->url_Certificado . $this->nombre_Certificado == "" ) {
            $this->errorInfo = 'Error -> url_Certificado . nombre_Certificado == ""';
            return false;
        }
        else if ( file_exists( $this->url_Certificado . '/' . $this->nombre_Certificado . '.pem' ) ) {
            if ( ! unlink( $this->url_Certificado . '/' . $this->nombre_Certificado . '.pem' ) )  {
                $this->errorInfo = 'Error borrado -> ' . $this->url_Certificado . '/' . $this->nombre_Certificado . ".pem";
                return false;
            }
        }
        $resultado = openssl_pkey_export( $res, $privkey, $this->clave, $this->configargs );
        if ( $resultado ) {
            $this->private_key =  $privkey;
            /*
            $key = openssl_pkey_get_details( $res );
            $this->public_key =  $key[ "key" ];
            */
            file_put_contents($this->url_Certificado . '/' . $this->nombre_Certificado . '.pem', $this->private_key);
        }
        else {
            $this->errorInfo = 'Error -> openssl_pkey_export() -> ' . openssl_error_string();
        }
        return $resultado;
    }

    Public Function XmlLogin() {
        $Servicio = "wsfe";
        // "wconsdeclaracion" "ws_sr_constancia_inscripcion";

        // 'este es el xml que se envía para el logueo del cliente en la web de afip, como se hace esta en 'http://www.afip.gov.ar/ws/WSAA/Especificacion_Tecnica_WSAA_1.2.0.pdf'
        // https://www.afip.gob.ar/ws/WSAA/Especificacion_Tecnica_WSAA_1.2.2.pdf
        $XmlLogin = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.authws.sua.dvadac.desein.afip.gov"> /n';
        $XmlLogin = $XmlLogin . '<soapenv:Header/>/n' . '<soapenv:Body>/n' . '<ser:loginCms soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">/n';
        $XmlLogin = $XmlLogin . '<request xsi:type="xsd:string">';
        $XmlLogin = $XmlLogin . $this->FirmarXML( $this->GenerarTRA( $this->url_Certificado, $Servicio), $this->url_Certificado);

        $XmlLogin = $XmlLogin . '</request>/n' . '</ser:loginCms>/n' . '</soapenv:Body>/n' . '</soapenv:Envelope>/n';
        return $XmlLogin;
    }

    private function FirmarXML( $xml, $Certificado ) {
        $file_xml = $this->url_Certificado . '/' . $this->nombre_Certificado . ".xml";
        echo( $file_xml );
        if ( file_exists( $file_xml ) ) {
            if ( ! unlink( $file_xml ) )  {
                $this->errorInfo = 'Error borrado -> ' . $file_xml;
                return false;
            }
        }
        echo( '</br>$file_xml -> ' . $file_xml );
        echo( '</br>$Certificado csm -> ' . $this->url_Certificado . '/' . $this->nombre_Certificado . '.cms' );
        echo( '</br>$file_xml -> ' . $file_xml );
        echo( '</br>$Certificado crt -> ' . $this->url_Certificado . '/' . $this->nombre_Certificado . '.crt' );
        echo( '</br>$Certificado crt Contenido -> ' . file_get_contents(  $this->url_Certificado . '/' . $this->nombre_Certificado . '.crt') );
        echo( "array() -> " );
        print_r( array( file_get_contents(  $this->url_Certificado . '/' . $this->nombre_Certificado . '.pem'), $this->clave ) );
        if ( file_put_contents( $file_xml, $xml) ) {
            if ( file_exists( $file_xml ) ) {
                if( openssl_pkcs7_sign( $file_xml,  $this->url_Certificado . '/' . $this->nombre_Certificado . '.cms', file_get_contents(  $this->url_Certificado . '/' . $this->nombre_Certificado . '.crt'), array( file_get_contents(  $this->url_Certificado . '/' . $this->nombre_Certificado . '.pem'), $this->clave ), array(), !PKCS7_DETACHED) ) {
                    $a = explode( '\n\n', file_get_contents( 'Certificados/' . $Certificado. '/' . $Certificado . '.cms'));
                    echo "<soapenv:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://services.authws.sua.dvadac.desein.afip.gov\"><soapenv:Header/><soapenv:Body><ser:loginCms soapenv:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\"> <request xsi:type=\"xsd:string\">" . $a[1] ."</request></ser:loginCms></soapenv:Body></soapenv:Envelope>";
                }
                else { 
                    echo "error Firmando " . openssl_error_string();
                    $this->errorInfo = 'Error -> openssl_pkcs7_sign() -> ' . openssl_error_string();
                }
            }
        }
        
    }

    private function GenerarTRA( $Certificado, $Servicio ) {
        $Destination = "cn=wsaa,o=afip,c=ar,serialNumber=CUIT 33693450239";
        $Source = "C=ar, ST=caba, L=caba, O=anabel perez bemporat, OU=facturacion, SERIALNUMBER=CUIT 27204282183, CN=anabel";

        $fechas = new TimeZone();
        $xmltra = '<?xml version="1.0" encoding="UTF-8"?><loginTicketRequest version="1.0"><header><source>';
        $xmltra = $xmltra . $Source . '</source><destination>' . $Destination . '</destination><uniqueId>123456789</uniqueId><generationTime>' . $fechas->fechaInicio() . '</generationTime><expirationTime>' . $fechas->fechaFin() . '</expirationTime></header><service>' . $Servicio . '</service></loginTicketRequest>';
        return $xmltra;
    }
}