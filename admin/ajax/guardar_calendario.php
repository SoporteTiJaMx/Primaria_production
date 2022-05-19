<?php
$pdo=new PDO("mysql:dbname=eye;host=localhost","root","25430718");
$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';
switch($accion){
    //Instruccion agregar
    case'agregar':
        $sentenciaSQL = $pdo->prepare("INSERT INTO eventos(Eventos_nombre,Eventos_descripcion,Eventos_color,Eventos_textColor,Eventos_inicio,Eventos_fin) VALUES(:title,:descripcion,:color,:textColor,:start,:end)");
        $respuesta=$sentenciaSQL->execute(array(
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']
        ));
        echo json_encode($respuesta);
        break;
    //Instruccion eliminar
    case'eliminar':
        $respuesta=false;
        if(isset($_POST{'id'})){
            $sentenciaSQL= $pdo->prepare("DELETE FROM eventos WHERE Eventos_ID=:ID");
            $respuesta= $sentenciaSQL->execute(array("ID"=>$_POST['id']));
        }
        echo json_encode($respuesta);
        break;
    //Instruccion modificar
    case'modificar':
        $sentenciaSQL=$pdo->prepare("UPDATE eventos SET
            title=:title,
            descripcion=:descripcion,
            color=:color,
            textColor=:textColor,
            start=:start,
            end=:end
            WHERE ID=:ID");
        $respuesta=$sentenciaSQL->execute(array(
            "ID"=>$_POST['id'],
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']));
        echo json_encode($respuesta);
        break;
    default:
    // seleccionar eventos del calendario
    $sentenciaSQL= $pdo->prepare("SELECT* FROM eventos");
    $sentenciaSQL->execute();
    $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
    break;
}
?>
