<body>
    <?php
        require_once './modelos/servicio.certificados.php';

        $fechas = new TimeZone();
        echo( "<pre>" );
        echo( 'fechaInicio -> ' . $fechas->fechaInicio() . '</br>' );
        echo( 'fechaFin -> ' . $fechas->fechaFin() . '</br>' );

        $Certificado = new Certificados( "Documentacion/Anabel.crt" );
        print_r( $Certificado );

        /*
        echo( 'Url -> ' . $Certificado->url_CRT . '</br>' );
        $res = $Certificado->NewPK();
        echo( "</br>" );
        echo( "openssl_pkey_new() -> " );
        var_dump( $res );
        var_dump( $Certificado->public_key );
        echo( "</br>" );
        if ( $Certificado->PKExport( $res ) ) {
            echo( 'Creado -> ' . $Certificado->url_Certificado . '/' . $Certificado->nombre_Certificado );
            var_dump( $Certificado->public_key );
            echo( "</br>" );
            var_dump( $Certificado->private_key );
            echo( "</br>" );
        }
        else {
            echo( "Fallo generación Claves" . "</br>" );
            echo( $Certificado->errorInfo );
        }
        echo( "</pre>" );

        echo( "<pre>" );
        echo( "</br>" );
        echo( "</br>" );
        echo( "</br>" );
        $ndays = 365;
        $config = array(
            'config' => "F:/xampp/php/extras/openssl/openssl.cnf",
            'private_key_bits'=> 2048,);               // use defaults
        $res_privkey = openssl_pkey_new( $config );
        var_dump( openssl_pkey_get_details( $res_privkey ) );
        $dn =  array();
        $res_csr = openssl_csr_new( array(), $res_privkey);
        var_dump( $res_csr );
        $res_cert = openssl_csr_sign( $res_csr, null, $res_privkey, $ndays);
        var_dump( $res_cert );
        echo( "</pre>" );
        */

        echo( "<pre>" );
        echo( "</br>" );
        echo( "</br>" );
        echo( "</br>" );
         echo( $Certificado->XmlLogin() );
        echo( "</pre>" );

    ?>
</body>
