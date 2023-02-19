<?php

class despachantes {
    private $despachante = "";
    public $registro = [];

    function __construct( $despachante = "") {
    }

    function __destruct() {
        // Liberar recursos.
    }

    static function checkcliente( $despachante = "" ) {
        include("../controladores/conexion_db.php");

        $existe = false;
        if ( $despachante !== "" ) {
            if ( $conection ) {
                // Checks
                $sql = "SELECT Codigo FROM despachantes WHERE Codigo = " . $despachante . ";";
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

    function leerdespachante( $despachante = "" ) {
        if ( $despachante !== "" ) {
            include("../controladores/conexion_db.php");
            if ( $conection ) {
                // Checks
                $sql = "SELECT * FROM despachantes WHERE Codigo = " . $despachante . ";";
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