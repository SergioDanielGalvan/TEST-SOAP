<?php
	// Inicio session
    $_SESSION["usuario"] = "Anabel";
	$_SESSION["permisos"] = "admin";

	if ( date_default_timezone_set( 'America/Argentina/Buenos_Aires' ) ) {
		$fechafinal = date( "Y-m-d" );
		$fechainicial = date( "Y-m-d", strtotime($fechafinal."-30 day") );
	}

	$hoy = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL)

	echo( "<pre>" );
		echo( '$fechainicial -> ' . $fechainicial . "</br." );
		echo( '$fechafinal -> ' . $fechafinal );
	echo( "</pre>" );

?>
<section class = "IngresarDatos" >
	<h1 class="titulo" >Datos DetalladaListaDeclaraciones </h1>
	<form method = "post" id = "formDetallada" >

		<label class="labelIngresar" for="NroCUITImportador">Nº CUIT Importador:</label>
        <input type="numer" class = "input_ingresar" value="" name="NroCUITImportador" maxlength="11" required />
		<label class="labelIngresar" for="NroCUITDespachante">Nº CUIT Despachante:</label>
        <input type="numer" class = "input_ingresar" value="" name="NroCUITDespachante" maxlength="11" required />
		<label class="labelIngresar" for="NroDeclaracion">Nº Declaración:</label>
        <input type="email" class = "input_ingresar" value="" name="NroDeclaracion" maxlength="16" placeholder="23073IC03000999A" />
        <div id = "GrupoDatosRangoFechas">
            <label class="labelIngresar" for="FechaInicio">Fecha Inicio: </label>
            <input type = "date" class = "input_ingresar" name = "FechaInicio" value=<?php echo( $fechainicial ) ?> />
            <label class="labelIngresar" for="FechaFin">Fecha Fin: </label>
            <input type = "date" class = "input_ingresar" name = "FechaInicio" value=<?php echo( $fechafinal ) ?> />
            <!-- Faltan más campos 
			-->
        </div>

		<?php
			require_once "./controladores/formularios.controlador.php";
			$actualizar = ControladorFormularios::crtDetalladaListaDeclaraciones();

			if ( $actualizar == "ok" ) {

				echo '<script>
				if ( window.history.replaceState ) {
					window.history.replaceState( null, null, window.location.href );
				}
				</script>';

				echo '<div class="alert alert-success">El usuario ha sido actualizado</div>
				<script>
					setTimeout(function(){
						window.location = "index.php?pagina=inicio";
					},3000);
				</script>
				';
			}
		?>
	
		<button type="submit" class="botonIngresar">Enviar</button>

	</form>

</section>