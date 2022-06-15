<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	include_once('../../scripts/funciones.php');

    $Grupo_ID=$_POST['Grupo_ID'];

    $query = "SELECT Control_Acceso_Sesiones.Activado, Control_Acceso_Sesiones.Sesion_ID, Sesiones.Nombre, Sesiones.Descripcion FROM Control_Acceso_Sesiones LEFT JOIN Sesiones ON Control_Acceso_Sesiones.Sesion_ID = Sesiones.Sesiones_ID WHERE Control_Acceso_Sesiones.Grupo_ID = ?";
    
    if($stmt = $con->prepare($query)){
        $stmt->bind_param("i", $Grupo_ID);
		$stmt->execute();
        $stmt->bind_result($estatus, $Sesion_ID, $Sesion_nombre, $Sesion_desc);
        $indice = 0;
        $sesiones_rows = "";
        while ($stmt->fetch()) {
            if($estatus == 1){
                $options = '
                    <option value="1" class="">Activa</option>
                    <option value="0" class="">Inactiva</option>
                ';
            }else if($estatus == 0){
                $options = '
                    <option value="0" class="">Inactiva</option>
                    <option value="1" class="">Activa</option>
                ';
            }
            $sesiones_rows .= '
                <tr class="">
                    <td>
                        '.$Sesion_nombre.'
                        <input type="hidden" name="sesion_id_'.$indice.'" class="" value="'.$Sesion_ID.'">
                    </td>
                    <td>'.$Sesion_desc.'</td>
                    <td>
                        <select name="estatus_'.$indice.'" id="estatus_'.$indice.'" class="form-control">
                            '.$options.'
                        </select>
                    </td>
                </tr>
            ';
            $inidice++;
        }
        $table = '
            <table id="Datos-filtrados" class="table table-hover">
                <thead class="text-center">
                    <th class="">Sesión</th>
                    <th class="">Descripción</th>
                    <th class="">Estatus</th>
                </thead>
                <tbody class="">
                    '.$sesiones_rows.'
                </tbody>
            </table>
        ';
    }
    echo $table;
}
?>
