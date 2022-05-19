<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');

    $Empresa_ID = $_POST['Empresa_ID'];
    $area_emp = $_POST['area_emp'];
    if($_SESSION['tipo']!='Alumn'){

    }else{
        $query = "SELECT COUNT(empresas_info_s5_4_metas.meta) FROM empresas_info_s5_4_metas JOIN empresas_info_s5_4 ON empresas_info_s5_4_metas.info_s5_4_ID=empresas_info_s5_4.info_s5_4_ID  WHERE empresas_info_s5_4.Area_Emp = ? AND empresas_info_s5_4.Empresa_ID=? AND  empresas_info_s5_4.Num_objetivo=1";
        $stmt = $con->prepare($query);
		$stmt->bind_param("si", $area_emp, $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($metas1);
        $stmt->close();

        $query = "SELECT empresas_info_s5_4_metas.meta, empresas_info_s5_4_metas.plan_accion FROM empresas_info_s5_4_metas JOIN empresas_info_s5_4 ON empresas_info_s5_4_metas.info_s5_4_ID=empresas_info_s5_4.info_s5_4_ID  WHERE empresas_info_s5_4.Area_Emp = ? AND empresas_info_s5_4.Empresa_ID=? AND  empresas_info_s5_4.Num_objetivo=1";
        $stmt = $con->prepare($query);
		$stmt->bind_param("si", $area_emp, $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($metas, $planes);
        
        $i=1;
        $metaso1 ="";
        while ($tmt->fetch()) {
            $metaso1.="
                <div class='form-group col-5'>
                    <label for='meta1' class='control-label text-dark-gray'>Meta:</label>
                    <textarea class='form-control rounded meta1' name='meta1[]' id='meta1' aria-describedby='meta1_help' rows='3' ".$_SESSION['enable_disable']." required>".$metas."</textarea>
                </div>
                <div class='form-group col-7'>
                    <label for='pa1' class='control-label text-dark-gray'>Plan de Ación:</label>
                    <textarea class='form-control rounded pa1' name='pa1[]' id='pa<?php echo $i; ?>_1' aria-describedby='pa<?php echo $i; ?>_<?php echo $area_emp; ?>_help' rows='3' ".$_SESSION['enable_disable']." required>".$planes."</textarea>
                </div>
            ";
        }

        $query = "SELECT empresas_info_s5_4.Num_objetivo, empresas_info_s5_4.Objetivo, empresas_info_s5_4.Coments_ases, empresas_info_s5_4_metas.meta, empresas_info_s5_4_metas.plan_accion FROM empresas_info_s5_4 LEFT JOIN empresas_info_s5_4_metas ON empresas_info_s5_4.info_s5_4_ID=empresas_info_s5_4_metas.info_s5_4_ID WHERE empresas_info_s5_4.Area_Emp = ? AND empresas_info_s5_4.Empresa_ID=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("si", $area_emp, $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($Num_objetivo, $Objetivo, $Coments_ases, $meta, $plan_accion);
        //$stmt->close();

        $formo1 = "
            <form action='".$RAIZ_SITIO."scripts/alumno/registrar_5_4.php' method='POST'>
                <label class='control-label text-dark-gray'>Objetivo ".$i.":</label>
				<div class='card px-3 py-2'>			
             		<div class='form-row pb-1'>
			        	<div class='form-group col-3'>
                            <label for='obj".$i."' class='control-label text-dark-gray'>Objetivo:</label>
                            <textarea class='form-control rounded' name='obj".$i."' id='obj".$i."' aria-describedby='obj".$i."_help' rows='3' ".$_SESSION['enable_disable']." required>".$Objetivo."</textarea>
                        </div>
                        <div class='form-group col-9'  id='metaini<?php echo $i; ?>'>
                            <div class='form-row pb-1 meta1' id='meta1div".$i."'>
                                ".$metaso1."
                            </div>
                        </div>
                    </div>
                    <div class='form-row pb-1'>
                        <div class='col-3'></div>
                        <div id='moremetas".$i."' class='form-group col-9'>
                            <div class='meta".$i."' id='meta0_1'></div>
                            <div class='pa".$i."' id='pa0_1'></div>
                        </div>
                    </div>
                    <div class='text-center'>
						<input type='hidden' name='area_emp' id='area_".$i."' value='".$area_emp."'>
						<a class='btn btn-success text-white px-5 my-2' id='btnedit".$i."' onclick='disabled".$i."();'>Editar</a>
						<input type='submit' value='Guardar Datos' id='guardar".$i."' class='btn btn-warning text-white' disabled>
						<a class='btn btn-success text-white px-5 my-2' id='btnadd".$i."' onclick='addmeta".$i."();' disabled><i class='fas fa-plus'></i></a>
						<a class='btn btn-warning text-white px-5 my-2' id='btnrmv".$i."' onclick='rmvmeta".$i."' disabled><i class='fas fa-minus'></i></a>
					</div>
                </div>
                <br>
            </form>
        ";

        echo $formo1;
    }
}
    
?>