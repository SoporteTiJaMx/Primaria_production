<?php 
    if (
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    ) {
        session_start();
	    include_once('../../scripts/funciones.php');
	    include_once('../../scripts/conexion.php');
	    include_once('../../scripts/conexion2.php');

        $Empresa_ID=$_POST["Empresa_ID"];

        if ($Empresa_ID>0) {
            if (mysqli_query($con2, "SELECT COUNT(*) FROM accionistas WHERE Empresa_ID=".$Empresa_ID." AND Accionista_nombre!=null")) {
                $num_accionistas = mysqli_fetch_array(mysqli_query($con2, "SELECT COUNT(*) FROM accionistas WHERE Empresa_ID=".$Empresa_ID." AND Accionista_nombre!=null"));
            } else {
                $num_accionistas = 0;
            }if (mysqli_query($con2, "SELECT COUNT(*) FROM donantes WHERE Empresa_ID=".$Empresa_ID."")) {
                $num_donantes = mysqli_fetch_array(mysqli_query($con2, "SELECT COUNT(*) FROM donantes WHERE Empresa_ID=".$Empresa_ID.""));
            } else {
                $num_donantes = 0;
            }
            $query ="SELECT empresas.Empresa_nombre FROM empresas LEFT JOIN empresas_info_s7_6 ON empresas_info_s7_6.Empresa_ID=empresas.Empresa_id LEFT JOIN empresas_info_s8_2 ON empresas.Empresa_ID=empresas_info_s8_2.Empresa_ID WHERE empresas.Empresa_ID=?";
            if ($stmt=$con->prepare($query)) {
                $stmt->bind_param("i", $Empresa_ID);
                $stmt->execute();
                $stmt->bind_result($inversion_inicial, $produccion, $num_meses_sueldo, $Precio_venta, $Empresa_nombre);
                    $info_formula_table='';
                
                while ($stmt->fetch()) {
                    $precio_unitario=$variables/$produccion;
                    //$precio_unitario=$inversion_inicial/$produccion;
                    $Q=$fijos/($Precio_venta - $precio_unitario);
                    if($Q>0){
                        $Q=number_format($Q, 2);
                    }else{
                        $Q="Tu proyecto no es rentable";
                    }
                    $info_formula_table.='
                        <table class="table">
                            <tr>
                                <td class="align-middle text-center" style="font-size: 3rem;">Q</td>
                                <td class="text-center align-middle" style="font-size: 2rem;">=</td>
                                <td class="text-center">
                                    <p style="font-size: 2rem;">$'.$fijos.'</p><br>
                                    <hr>
                                    <br><p style="font-size: 2rem;">$'.$Precio_venta.' - $'.$precio_unitario.'</p>
                                </td>
                                <td class="text-center align-middle" style="font-size: 2rem;">=</td>
                                <td class="text-center align-middle" style="font-size: 2rem;">'.$Q.' Unidades</td>
                            </tr>
                        </table>
                        <br>
                    ';
                }
                $info_formula='
                    <p class="text-justify">A continuación se muestra el <b>Punto de Equilibrio "Q"</b> de la Empresa <b>'.$Empresa_nombre.'</b></p>
                    <ul>
                        <li>
                            <b>Temporalidad (años, meses, semnanas)</b> -> Definido en la sesión 7 -> <b>'.$num_meses_sueldo.' meses</b>.
                        </li>
                        <br>
                        <li>
                            <b>Precio de Venta: basado en precios de competidores</b> -> Definido en esta sesión -> <b>$'.$Precio_venta.'</b>.
                        </li>
                        <br>
                        <li>
                            <b>CF-Costos Fijos: La suma de aquellos costos que no varían</b> -> Definido la sesión 7 -> <b>$'.$fijos.'</b>.
                        </li>
                        <br>
                        <li>
                            <b>CV-Costo Variable Unitario</b>: Resultado de dividir los <b>costos variables ($'.$variables.')</b> entre las <b>unidades/servicios producidas/proporcionados ('.$produccion.')</b> -> Utilizado en esta sesión -> <b>$'.$precio_unitario.'</b>.
                        </li>
                        <br>
                        <li>
                            <b>Q-Cantidad de productos/servicios para alcanzar el punto de equilibrio: </b> Es la cantidad de productos/servicios que deben ser vendidos para estar en un punto donde no haya ni ganancias ni perdidas -> <b>Lo calcularemos a continuación</b>.
                        </li>
                    </ul>
                    <br>
                ';
                $info_formula.=$info_formula_table;
                
            }
            echo $info_formula;
        }
    } else {
	if ($_SESSION['tipo'] == "Volun") {
		$page = "asesor";
	} else if ($_SESSION['tipo'] == "Alumn"){
		$page = "alumno";
	}
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../" . $page . ".php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../<?php echo $page; ?>.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}
?>