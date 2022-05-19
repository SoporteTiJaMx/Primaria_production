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
        //$S_token=$_POST["token"];
        $Licencia_ID=$_POST["Licencia_ID"];
        $Centro_ID=$_SESSION["centro_ID"];

        if ($Licencia_ID>0) {
            $existe = mysqli_fetch_array(mysqli_query($con2, "SELECT COUNT(Licencia_ID) FROM licencias WHERE Centro_ID=".$Centro_ID));
                if (isset($existe[0]) AND $existe[0]>0) { //existe
                    $query = "UPDATE empresas_info_s8_2_coments SET coments_asesor=?, act_alumno=?, act_asesor=? WHERE Empresa_ID=?";
                } else {
                    $query = "INSERT INTO empresas_info_s8_2_coments (coments_asesor, act_alumno, act_asesor, Empresa_ID) VALUES (?, ?, ?, ?)";
                }
            if ($stmt=$con->prepare($query)) {
                $stmt->bind_param("i", $_SESSION["Centro_ID"]);
                $stmt->execute();
                
                    $info_margen_rows='';
                
                while ($stmt->fetch()) {
                    $info_margen_rows.='
                        <tr>
                            <td rowspan="3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$ </div>
                                    </div>
                                    <input type="number" class="form-control rounded text-center" name="Costo_unitario" id="Costo_unitario" value="300.00"  pattern="\d+(,\d{2})?" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$ </div>
                                    </div>
                                    <input type="number" class="form-control rounded text-center" name="Costo_1" id="Costo_1" value="'.$Costo_1.'"  pattern="\d+(,\d{2})?" step="0.01" required readonly>
                                </div>
                                <div class="input-group">
                                    <input type="url" class="form-control rounded text-center" name="url_1" id="url_1" value="'.$Comp_1.'" required readonly>
                                </div>
                            </td>
                            <td rowspan="3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control rounded text-center" name="Precio_venta" id="Precio_venta" value="'.$Precio_venta.'"  pattern="\d+(,\d{2})?" step="0.01" readonly required>
                                </div>
                            </td>
                            <td rowspan="3">
                                <div class="input-group">
                                    <input type="number" class="form-control rounded text-center" name="Margen_utilidad" id="Margen_utilidad" value="'.$Margen.'" pattern="\d+(,\d{2})?" readonly>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$ </div>
                                    </div>
                                    <input type="number" class="form-control rounded text-center" name="Costo_2" id="Costo_2" value="'.$Costo_2.'"  pattern="\d+(,\d{2})?" step="0.01" required readonly>
                                </div>
                                <div class="input-group">
                                    <input type="url" class="form-control rounded text-center" name="url_2" id="url_2" value="'.$Comp_2.'" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$ </div>
                                    </div>
                                    <input type="number" class="form-control rounded text-center" name="Costo_3" id="Costo_3" value="'.$Costo_3.'"  pattern="\d+(,\d{2})?" step="0.01" required readonly>
                                </div>
                                <div class="input-group">
                                    <input type="url" class="form-control rounded text-center" name="url_3" id="url_3" value="'.$Comp_3.'" required readonly>
                                </div>
                            </td>
                        </tr>
                    ';
                }
                $coment_ases= (isset($coments)) ? ($coment_ases=$coments) : "";
                $stmt->close();
                $info_margen='
                <form action="'.$RAIZ_SITIO.'scripts/alumno/registrar_8_2.php" method="POST" class="needs-validation">
                    <div class="px-2 my-2">
                        <p class="text-center px-2 py-2">Precio de Venta y Margen de Utilidad de la Empresa <b>'.$Empresa_nombre.'</b></p>
                        <table id="tab_sueldos" class="table">
                            <thead>
                                <tr>
                                    <th>Costo Unitario</th>
                                    <th>Competencia</th>
                                    <th>Precio de Venta</th>
                                    <th>Margen de Utilidad</th>
                                </tr>
                            </thead>
                            <tbody>
                ';
                $info_margen.=$info_margen_rows;
                $info_margen.='
                            </tbody>
                        </table>
                    </div>
                    <hr>
                ';
                if ($_SESSION["tipo"]!="Alumn") {
                    if ($_SESSION["tipo"]=="Volun") {
                        $disabled="";
                        $botones_ases='
                            <div class="form-row my-2">
                                <input name="csrf" type="hidden" id="csrf" value="'.$_SESSION["token"].'">
                                <input name="Empresa_ID" type="hidden" id="Empresa_ID" value="'.$Empresa_ID.'">
                                <div class="col-12 text-center"><input type="submit" value="Guardar Comentarios" class="btn btn-warning"></div>
                            </div>
                            <div class="form-row my-2">
                                <div class="form-group col-2"></div>
                                <div class="form-group col-8 text-center">
                                    <div class="checkbox checkbox-green">
                                        <input type="checkbox" class="custom-control-input" id="validacionAsesor" name="validacionAsesor" value="1">
                                        <label class="custom-control-label" for="validacionAsesor">Validación del Asesor. Estoy de acuerdo con la información ingresada. Ya no haré más comentarios.</label>
                                    </div>
                                </div>
                                <div class="form-group col-2"></div>
                            </div>
                            
                    ';
                    }else {
                        $disabled="disabled";
                        $botones_ases='';
                    }
                    $info_margen.='
                    <div class="form-row my-2">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <textarea name="coment_ases" id="coment_ases" cols="30" rows="5" class="form-control" value="" '.$disabled.' required>'.$coment_ases.'</textarea>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    ';
                    $info_margen.=$botones_ases;
                    $info_margen.='
                    </form>
                    ';

                }else {
                    if ($_SESSION["Puesto_ID"]==2 or $_SESSION["Puesto_ID"]==6 or $_SESSION["Puesto_ID"]==5 or $_SESSION["Puesto_ID"]==10) {
                        $disabled2="";
                    }else {
                        $disabled2="disabled";
                    }
                    $info_margen.='
                    <div class="form-row my-2">
                        <div class="col-12 text-center">
                            <input name="csrf" type="hidden" id="csrf" value="'.$_SESSION["token"].'">
                            <input type="hidden" name="Empresa_ID" id="emp_id" value="'.$Empresa_ID.'">
                            <input type="button" value="Modificar Datos" class="btn btn-success" id="modificar_datos" onclick="modif_datos();" '.$disabled2.'>
                            <input type="submit" value="Guardar/Actualizar Datos" class="btn btn-warning" id="calcular_margen" disabled>
                            <input type="button" value="Cancelar" class="btn btn-warning" id="cancelar_datos" onclick="cancel_datos();" disabled>
                        </div>
                    </div>
                    <div class="form-row my-2">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <textarea name="coment_ases" id="coment_ases" cols="30" rows="5" class="form-control" value="" disabled>'.$coment_ases.'</textarea>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </form>
                ';
                }
            }
            echo $info_margen;
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