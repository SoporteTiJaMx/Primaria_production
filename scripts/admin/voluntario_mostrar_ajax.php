<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	include_once('../conexion2.php');
	$Escuela_ID = $_POST["Escuela_ID"];
	$Centro_ID = $_SESSION["centro_ID"];
	$escuelas_cuenta = 0;
	$stmt=$con->prepare("SELECT DISTINCT grupos.Grupo_ID, grupos.Proyecto_ID, grupos.Grupo_nombre, grupos.Grupo_estatus, grupos.Grado FROM grupos WHERE Grupo_estatus = 'activo' AND Escuela_ID = ? ORDER BY Grupo_nombre");
	$stmt->bind_param("i", $Escuela_ID);
	$stmt->execute();
	$stmt->bind_result($Grupo_ID, $Proyecto_ID, $Grupo_nombre, $Grupo_estatus, $Grado);

	$tabla="<table class='table table-striped table-hover' id='grupos_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Grupo</th>
				<th>Voluntario 1</th>
				<th>Voluntario 2</th>
				<th>Voluntario 3</th>
			</tr>
		</thead>
		<tbody>";
		while ($stmt->fetch()) {

            $stmt3=$con2->prepare("SELECT asesores_x_grupo.Asesor_ID, asesores_x_grupo.Num_ases, asesores.Asesor_nombre, asesores.Asesor_ap_paterno FROM asesores_x_grupo LEFT JOIN asesores ON asesores.Asesor_ID = asesores_x_grupo.Asesor_ID WHERE asesores_x_grupo.Grupo_ID=? ORDER BY Num_ases");
            $stmt3->bind_param('i', $Grupo_ID);
            $stmt3->execute();
			$stmt3->bind_result($Asesor_ID, $num_ases, $Asesor_nombre, $Asesor_ap);
            $count = 0;
			$selected_option_1='';
            $selected_option_2='';
            $selected_option_3='';
			$asesor_1=0;
			$asesor_2=0;
			$asesor_3=0;
            while($stmt3->fetch()){
                if($num_ases == 1){
                        $asesor_1 = $Asesor_ID;
                        $selected_option_1 = '
                        <option value="'.$asesor_1.'" class="" selected>'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                    ';
                }
                if($num_ases == 2){
                        $asesor_2 = $Asesor_ID;
                        $selected_option_2 = '
                        <option value="'.$asesor_2.'" class="" selected>'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                    ';
                }
                if($num_ases == 3){
                        $asesor_3 = $Asesor_ID;
                        $selected_option_3 = '
                        <option value="'.$asesor_3.'" class="" selected>'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                    ';
                }
                $count++;
            }
            $stmt3->close();
            
			$stmt2=$con2->prepare("SELECT asesores.Asesor_ID, asesores.Asesor_nombre, asesores.Asesor_ap_paterno FROM asesores WHERE Asesor_ID != ? AND Asesor_ID != ? AND Asesor_ID != ? AND Centro_ID = ? ORDER BY Asesor_nombre");
			$stmt2->bind_param('iiii', $asesor_1, $asesor_2, $asesor_3, $Centro_ID);
			$stmt2->execute();
			$stmt2->bind_result($Asesor_ID, $Asesor_nombre, $Asesor_ap);
            $count_ases1 = 0;
            $contados1 = 0;
			$count_ases2 = 0;
            $contados2 = 0;
			$count_ases3 = 0;
            $contados3 = 0;
			$options_select_1 ='';
			$options_select_2 ='';
			$options_select_3 ='';
			while ($stmt2->fetch()) {
				$options_select_1 .='
                    <option value="'.$Asesor_ID.'" class="">'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                ';
				if($count_ases1 == 0 AND $contados1 == 0){
					$count_ases1 = 1;
				}
				if($count_ases1 > 0){
					$count_ases1++;
				}
				$contados1 = 1;
			}
            $stmt2->bind_param('iiii', $asesor_1, $asesor_2, $asesor_3, $Centro_ID);
			$stmt2->execute();
			$stmt2->bind_result($Asesor_ID, $Asesor_nombre, $Asesor_ap);
			while ($stmt2->fetch()) {
				$options_select_2 .='
                    <option value="'.$Asesor_ID.'" class="">'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                ';
				if($count_ases2 == 0 AND $contados2 == 0){
					$count_ases2 = 1;
				}
				if($count_ases2 > 0){
					$count_ases2++;
				}
				$contados2 = 1;
			}
            $stmt2->bind_param('iiii', $asesor_1, $asesor_2, $asesor_3, $Centro_ID);
			$stmt2->execute();
			$stmt2->bind_result($Asesor_ID, $Asesor_nombre, $Asesor_ap);
			while ($stmt2->fetch()) {
				$options_select_3 .='
                    <option value="'.$Asesor_ID.'" class="">'.$Asesor_nombre.' '.$Asesor_ap.'</option>
                ';
				if($count_ases3 == 0 AND $contados3 == 0){
					$count_ases3 = 1;
				}
				if($count_ases3 > 0){
					$count_ases3++;
				}
				$contados3 = 1;
			}
            $select_1 = '
                <select name="Asesor_1_'.$escuelas_cuenta.'" id="Asesor_1_'.$escuelas_cuenta.'" class="form-control">
					<option value="0" class="">Selecciona un asesor</option>
					'.$selected_option_1.'
					'.$options_select_1.'
				</select>
            ';
			$select_2 = '
                <select name="Asesor_2_'.$escuelas_cuenta.'" id="Asesor_2_'.$escuelas_cuenta.'" class="form-control">
					<option value="0" class="">Selecciona un asesor</option>
					'.$selected_option_2.'
					'.$options_select_2.'
				</select>
            ';
			$select_3 = '
                <select name="Asesor_3_'.$escuelas_cuenta.'" id="Asesor_3_'.$escuelas_cuenta.'" class="form-control">
					<option value="0" class="">Selecciona un asesor</option>
					'.$selected_option_3.'
					'.$options_select_3.'
				</select>
            ';
			
			$tabla.="
				<tr>
					<td class= 'align-middle'>
						".$Grupo_nombre."
						<input type='hidden' id='grupo_".$escuelas_cuenta."' class='' value='".$Grupo_ID."'>
					</td>
					<td class= 'align-middle'>
						".$select_1."
						<input type='hidden' id='asesor_1_".$escuelas_cuenta."' class='' value='".$asesor_1."'>
					</td>
					<td class= 'align-middle'>
						".$select_2."
						<input type='hidden' id='asesor_2_".$escuelas_cuenta."' class='' value='".$asesor_2."'>
					</td>
					<td class= 'align-middle'>
						".$select_3."
						<input type='hidden' id='asesor_3_".$escuelas_cuenta."' class='' value='".$asesor_3."'>
					</td>
				</tr>
			";
			$escuelas_cuenta++;
		}
	$tabla.="</tbody>
		</table>";
	echo $tabla;
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Fallo en la operación</h5>
						<p class="card-text">No se completó la petición <br><br>En unos segundos serás redirigido</p>
						<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Regresar</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}

?>