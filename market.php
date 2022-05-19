<?php
include_once('/includes/admin_header.php');
include_once('/scripts/funciones.php');
include_once('/admin/side_navbar.php');
if ($_SESSION["tipo"] != "Admin") {
	header('Location: /error.php');
} else {
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>
<link rel="stylesheet" href="/css/responsive.bootstrap4.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.css">


<?php if (isset($_SESSION["licencia_activa"])) { ?>
<h5 class="text-center text-dark_gray pt-3 pb-1">
    Observa los Productos de las Empresas juveniles de
    <?php if (isset($_SESSION['nombre_licencia'])) { echo " " . $_SESSION['nombre_licencia']; } ?>.
</h5>
<div class="mx-3 my-2">
    <div class="card bg-dark mb-3">
        <h5 class="card-header text-white">Aquí puedes dar un vistazo a los <b>Productos</b> que están siendo
            trabajados.</h5>
        <div class="card-body px-5">
            <div class="row">
                <div class="col-4">
                    <div class="card px-2 py-2">
                        <img src="../images/prototipos/1.jpg" class="card-img-top" alt="..." style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Prototipo 1</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Apoyanos</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card px-2 py-2">
                        <img src="../images/prototipos/2.jpg" class="card-img-top" alt="..." style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Prototipo 2</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Apoyanos</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card px-2 py-2">
                        <img src="../images/prototipos/5.jpg" class="card-img-top" alt="..." style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Prototipo 3</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Apoyanos</a>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg">
                            <li class="page-item"><a class="page-link" href="#"><i
                            class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente &nbsp;&nbsp;<i
                            class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
<?php } else { ?>
<br>
<br>
<div class="text-center">
    <div style="display: block" class="w-50 py-2 text-center text-dark_gray rounded mx-auto">
        Actualmente no tienes licencia habilitada para revisar el TOP 3 de Empresas juveniles. Dirígete a <a href="
<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span
                class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a>
        para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".
    </div>
</div>
<?php }
}
include_once('/includes/admin_footer.php');
?>