<?php
	include_once('../scripts/funciones.php');
	$Error = 0;
	$_SESSION["enable_disable"] = "disabled";
	$_SESSION["enable_disable_asesor"] = "disabled";
	if ($_SESSION["tipo"] == "Sadmin") {
		include_once('../includes/superadmin_header.php');
		include_once('../superadmin/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Admin") {
		include_once('../includes/admin_header.php');
		include_once('../admin/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Vincu") {
		include_once('../includes/vinculador_header.php');
		include_once('../vinculador/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Coord") {
		include_once('../includes/coordinador_header.php');
		include_once('../coordinador/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Volun") {
		include_once('../includes/asesor_header.php');
		include_once('../asesor/side_navbar.php');
		$_SESSION["enable_disable_asesor"] = "";
	} else if ($_SESSION["tipo"] == "Alumn") {
		include_once('../includes/alumno_header.php');
		include_once('../alumno/side_navbar.php');
		$_SESSION["enable_disable"] = "";
	} else {
		$Error = 1;
	}
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	if ($Error == 1) {
		header('Location: ../error.php');
	} else {
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>
<style>
	.close {
		position:absolute;
		right:-30px;
		top:0;
		z-index:999;
		font-size:2rem;
		font-weight: normal;
		color:#fff;
		opacity:1;
	}

	video::-internal-media-controls-download-button {
		display:none;
	}

	video::-webkit-media-controls-enclosure {
		overflow:hidden;
	}

	video::-webkit-media-controls-panel {
		width: calc(100% + 35px);
	}
</style>

<div class="mx-5 px-5 mt-3 mb-5 pb-5">
	<div class="card shadow">
		<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">CAPACITACIONES DELL</div>
		<div class="card-body">

			<div class="container">
				<div class="row mb-5">
					<div class="col-sm">
						<h5>Dirección General</h5>
						<img src="../sesiones/videos/Direccion_General.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Direccion_General.webm" data-target="#Modal_capacitacion" data-capac="Dir_Gral">Ver Capacitación de Dirección General</button>
					</div>
					<div class="col-sm">
						<h5>Finanzas</h5>
						<img src="../sesiones/videos/Finanzas.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Finanzas.webm" data-target="#Modal_capacitacion" data-capac="Finanzas">Ver Capacitación de Finanzas</button>
					</div>
				</div>

				<div class="row mb-5">
					<div class="col-sm">
						<h5>Mercadotecnia</h5>
						<img src="../sesiones/videos/Mercadotecnia.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Mercadotecnia.webm" data-target="#Modal_capacitacion" data-capac="Mercadot">Ver Capacitación de Mercadotecnia</button>
					</div>
					<div class="col-sm">
						<h5>Producción</h5>
						<img src="../sesiones/videos/Produccion.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Produccion.webm" data-target="#Modal_capacitacion" data-capac="Producc">Ver Capacitación de Producción</button>
					</div>
				</div>

				<div class="row mb-5">
					<div class="col-sm">
						<h5>Recursos Humanos</h5>
						<img src="../sesiones/videos/Recursos_Humanos.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Recursos_Humanos.webm" data-target="#Modal_capacitacion" data-capac="RRHH">Ver Capacitación de Recursos Humanos</button>
					</div>
					<div class="col-sm">
						<h5>Ventas</h5>
						<img src="../sesiones/videos/Ventas.png" class="img-fluid rounded-lg mb-2">
						<button type="button" class="btn btn-warning video-btn float-right" data-toggle="modal" data-src="../sesiones/videos/Ventas.webm" data-target="#Modal_capacitacion" data-capac="Ventas">Ver Capacitación de Ventas</button>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" id="Modal_capacitacion" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i class="fas fa-times fa-lg"></i>
			</button>
			<div class="modal-body">
				<video id="video" autoplay controls controlsList="nodownload">
					<source src="" type="video/webm">
				</video>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		var videoSrc;
		var capac;
		$('.video-btn').click(function() {
			videoSrc = $(this).data("src");
			capac = $(this).data("capac");
			$("#video").attr('src',videoSrc);
			$('#video').bind('contextmenu',function() { return false; });
			$('#Modal_capacitacion').modal('show');
		});

		$('#Modal_capacitacion').on('hide.bs.modal', function (e) {
			var v = document.getElementById("video");
			var parametros = {
				"tiempo" : v.currentTime,
				"capacitacion" : capac
			};
			$.ajax({
				data:  parametros,
				url: '../scripts/ajax/videos_vistas.php',
				type: 'post',
				success: function(data){}
			});
			$("#video").attr('src',"");
		})
	});

</script>


<?php
		if ($_SESSION["tipo"] == "Sadmin") {
			include_once('../includes/superadmin_footer.php');
		} else if ($_SESSION["tipo"] == "Admin") {
			include_once('../includes/admin_footer.php');
		} else if ($_SESSION["tipo"] == "Vincu") {
			include_once('../includes/vinculador_footer.php');
		} else if ($_SESSION["tipo"] == "Coord") {
			include_once('../includes/coordinador_footer.php');
		} else if ($_SESSION["tipo"] == "Volun") {
			include_once('../includes/asesor_footer.php');
		} else if ($_SESSION["tipo"] == "Alumn") {
			include_once('../includes/alumno_footer.php');
		}
	}
?>

