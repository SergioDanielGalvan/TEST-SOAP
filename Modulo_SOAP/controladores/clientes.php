<?php

class clientes {
    private $cliente = "";
    public $registro = [];

    function __construct( $cliente = "" ) {
        if ( $cliente !== "" ) {
            $this->cliente = $cliente;
        }
    }

    function __destruct() {
        // Liberar recursos.
    }

    static function checkcliente( $cliente = "" ) {
        $existe = false;
        if ( $cliente !== "" ) {
            include("../controladores/conexion_db.php");
            if ( $conection ) {
                // Checks
                $sql = "SELECT Codigo FROM clientes WHERE Codigo = " . $cliente . ";";
                $resultado = $conection->query( $sql );
                if ( $resultado->num_rows > 0 ) {
                    $existe = true;
                }
                $resultado->free_result();
                $conection->close();
            }
        }
        return $existe;
    }

    function leercliente( $cliente = "" ) {
        if ( $cliente !== "" ) {
            include("../controladores/conexion_db.php");
            if ( $conection ) {
                // Checks
                $sql = "SELECT * FROM cliente WHERE Codigo = " . $cliente . ";";
                $resultado = $conection->query( $sql );
                if ( $resultado->num_rows == 1 ) {
                    $resultado->data_seek( 0 );
                    $this->registro = $resultado->fetch_assoc();
                }
                $resultado->free_result();
                $conection->close();
            }
        }
        return $this->registro;
    }
}