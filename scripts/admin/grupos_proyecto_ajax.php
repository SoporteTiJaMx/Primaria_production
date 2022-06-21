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

	$tabla="<table class='table table-striped table-hover' id='prog_grupo_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Grupo</th>
				<th>Programa</th>
			</tr>
		</thead>
		<tbody>";
		while ($stmt->fetch()) {

             if($Grado == 1){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 1 AND Grupo_ID = ?";
            }else if($Grado == 2){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 6 AND Grupo_ID = ?";
            }else if($Grado == 3){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 11 AND Grupo_ID = ?";
            }else if($Grado == 4){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 16 AND Grupo_ID = ?";
            }else if($Grado == 5){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 20 AND Grupo_ID = ?";
            }else if($Grado == 6){
                $query = "SELECT Control_Acceso_Sesiones.idCAS FROM Control_Acceso_Sesiones WHERE Sesion_ID = 24 AND Grupo_ID = ?";
            }
            $stmt3=$con2->prepare($query);
            $stmt3->bind_param("i", $Grupo_ID);
            $stmt3->execute();
			$stmt3->bind_result($idcas);
            
            $programa_selected = '';
            $table_rows = '';

            while($stmt3->fetch()){
                if($Grado == 1){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="1" class="" selected>Nuestras Familias</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="1" class="">Nuestras Familias</option>
                        ';
                    } 
                }else if($Grado == 2){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="2" class="" selected>Nuestra Comunidad</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="2" class="">Nuestra Comunidad</option>
                        ';
                    } 
                }else if($Grado == 3){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="3" class="" selected>Nuestra Ciudad</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="3" class="">Nuestra Ciudad</option>
                        ';
                    } 
                }else if($Grado == 4){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="4" class="" selected>Nuestras Regiones</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="4" class="">Nuestras Regiones</option>
                        ';
                    } 
                }else if($Grado == 5){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="5" class="" selected>Nuestra Nación</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="5" class="">Nuestra Nación</option>
                        ';
                    } 
                }else if($Grado == 6){
                    if($idcas != 0){
                        $programa_selected = '
                            <option value="6" class="" selected>Nuestro Mundo</option>
                            <option value="0" class="">Sin programa asignado aún</option>
                        ';
                    }else{
                        $programa_selected = '
                            <option value="0" class="" selected>Sin programa asignado aún</option>
                            <option value="6" class="">Nuestro Mundo</option>
                        ';
                    } 
                }
                $select_programas = '
                    <select name="programa_asoc_'.$escuelas_cuenta.'" id="programa_asoc_'.$escuelas_cuenta.'" class=" form-control">
                        '.$programa_selected.'
                    </select>
                ';
                $stmt3->close();
            }
            
			
			$tabla.="
				<tr>
					<td class= 'align-middle'>
						".$Grupo_nombre."
						<input type='hidden' id='grupo_".$escuelas_cuenta."' class='' value='".$Grupo_ID."'>
					</td>
					<td class= 'align-middle'>
						".$select_programas."
						<input type='hidden' id='programa_asoc_".$escuelas_cuenta."' class='' value='".$Grado."'>
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