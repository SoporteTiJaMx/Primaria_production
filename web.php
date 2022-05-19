<!doctype html>
<?php
	session_start();
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	$id_web = $_GET["id"];
	include_once('scripts/conexion.php');
	$d1 = mysqli_fetch_array(mysqli_query($con, "SELECT Empresa_ID FROM empresas_info_s3_7 WHERE micrositio='" . $id_web . "'"));
	$Empresa_ID = $d1[0];

	if ($Empresa_ID!=null AND $Empresa_ID>0) {

	$d2 = mysqli_fetch_array(mysqli_query($con, "SELECT nombre_empresa, eslogan_empresa, mision_empresa, vision_empresa, valores_empresa FROM empresas_info_s3_2 WHERE Empresa_ID=" . $Empresa_ID));

	$d3 = mysqli_fetch_array(mysqli_query($con, "SELECT Escuela_nombre FROM escuelas INNER JOIN empresas ON escuelas.Escuela_ID=empresas.Escuela_ID WHERE empresas.Empresa_ID=" . $Empresa_ID));

	$d4 = mysqli_fetch_array(mysqli_query($con, "SELECT producto, valor, segmento FROM empresas_info_s2_9 WHERE Empresa_ID=" . $Empresa_ID));

	$d5 = mysqli_fetch_array(mysqli_query($con, "SELECT valor_accion FROM variables WHERE Licencia_ID IN (SELECT Licencia_ID FROM licencia_empresa WHERE Empresa_ID=" . $Empresa_ID . ")"));

	?>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Emprendedores y Empresarios</title>
		<link rel="icon" type="image/ico" href="images/favicon.ico">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontawesome.css">
		<link rel="stylesheet" href="css/micrositio.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400" rel="stylesheet">
		<script src="js/popper.min.js" crossorigin="anonymous"></script>
		<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
		<script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>
		<script src="js/bootstrap.js" crossorigin="anonymous"></script>
	</head>

	<body id="page-top">

		<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="#page-top">Inicio</a>
			<button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item mx-0 mx-lg-1">
				<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#quienes">¿Quiénes somos?</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1">
				<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#que">¿Qué venderemos?</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1">
				<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#apoyo">¡Apóyanos!</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1">
				<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#programa">Programa</a>
				</li>
			</ul>
			</div>
		</div>
		</nav>

		<header class="masthead bg-primary text-white text-center">
		<div class="container d-flex align-items-center flex-column">

			<img class="rounded mx-auto d-blocks img-thumbnail mb-3" src="<?php echo 'images/logotipos/' . $Empresa_ID . '.jpg'; ?>" alt="Nuestro logotipo" width="250" >

			<h1 class="masthead-heading text-uppercase mb-2"><?php echo $d2["nombre_empresa"]; ?></h1>
			<h5 class="mb-0 font-italic"><?php echo $d2["eslogan_empresa"]; ?></h5>

			<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
			</div>
			<div class="divider-custom-line"></div>
			</div>

			<p class="masthead-subheading font-weight-light mb-0">Es una Empresa Juvenil educativa del programa Emprendedores y Empresarios de JA México</p>
			<small>El programa <strong>Emprendedores y Empresarios</strong> de JA México es una programa educativo internacional de negocios en el cual estudiantes de nivel medio superior y superior dirigen su propia empresa, bajo la asesoría de un voluntario.</small>

		</div>
		</header>

		<section class="page-section" id="quienes">
		<div class="container">

			<h2 class="page-section-heading text-center text-uppercase text-secondary mb-2">¿Quiénes somos?</h2>
			<div class="row">
			<div class="col-lg-12 ml-auto text-center">
				Una Empresa educativa conformada por jóvenes estudiantes de la escuela <?php echo $d3["Escuela_nombre"]; ?>
			</div>
			</div>

			<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
			</div>
			<div class="divider-custom-line"></div>
			</div>

			<div class="row mb-2">
			<div class="col-lg-4 ml-auto">
				<h5>Nuestra Misión</h5>
				<p class="lead"><?php echo $d2["mision_empresa"]; ?></p>
			</div>
			<div class="col-lg-4 mr-auto">
				<h5>Nuestra Visión</h5>
				<p class="lead"><?php echo $d2["vision_empresa"]; ?></p>
			</div>
			<div class="col-lg-4 mr-auto">
				<h5>Nuestros Valores</h5>
				<p class="lead"><?php echo $d2["valores_empresa"]; ?></p>
			</div>
			</div>

		</div>
		</section>

		<section class="page-section bg-primary text-white mb-0" id="que">
		<div class="container">

			<h2 class="page-section-heading text-center text-uppercase text-white">¿Qué venderemos?</h2>

			<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
			</div>
			<div class="divider-custom-line"></div>
			</div>

			<div class="container d-flex align-items-center flex-column mb-3">
			<img class="rounded mx-auto d-blocks img-thumbnail" src="<?php echo 'images/prototipos/' . $Empresa_ID . '.jpg'; ?>" alt="Nuestro producto" width="250" >
			<small>* Esta imagen es un prototipo de nuestro producto final.</small>
			</div>

			<div class="row">
			<div class="col-lg-4 ml-auto">
				<h5>Nuestro Producto</h5>
				<p class="lead"><?php echo $d4["producto"]; ?></p>
			</div>
			<div class="col-lg-4 mr-auto">
				<h5>¿A quién va dirigido?</h5>
				<p class="lead"><?php echo $d4["segmento"]; ?></p>
			</div>
			<div class="col-lg-4 mr-auto">
				<h5>¿Qué aportaremos a nuestros clientes?</h5>
				<p class="lead"><?php echo $d4["valor"]; ?></p>
			</div>
			</div>
		</div>
		</section>

		<section class="page-section" id="apoyo">
		<div class="container">

			<h2 class="page-section-heading text-center text-uppercase text-secondary mb-2">¡Apóyanos!</h2>
			<div class="row">
			<div class="col-lg-12 ml-auto text-center">
				Puedes ser un donante para nuestra Empresa Juvenil, y contribuir con ello a hacer realidad este proyecto educativo.<br>
				Ingresa tus datos y en breve te contactaremos.<br>
				¡Gracias!
			</div>
			</div>

			<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
			</div>
			<div class="divider-custom-line"></div>
			</div>

			<div class="row">
			<div class="col-lg-8 mx-auto">
				<form action="registrar_donante.php" method="post" class="mt-1">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
				<input name="web_ID" type="hidden" id="web_ID" value="<?php echo $id_web; ?>">
				<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php echo $Empresa_ID; ?>">
				<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>

				<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Nombre</label>
					<input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required="required">
					</div>
					<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Correo electrónico</label>
					<input class="form-control" id="email" name="email" type="email" placeholder="Correo electrónico" required="required" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
					</div>
					<?php $validaciones[] = array('email', 'email_input', "'Error en Correo. Favor de corregir.'"); ?>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Teléfono de contacto</label>
					<input class="form-control" id="phone" name="phone" type="tel" placeholder="Teléfono de contacto" required="required">
					</div>
					<?php $validaciones[] = array('phone', 'phone_input', "'Error en Teléfono. Favor de corregir.'"); ?>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Donación potencial:</label>
					<input class="form-control" id="donation" name="donation" type="number" min="1" max="<?php echo $d5['valor_accion']; ?>" placeholder="Donación ($1 - $<?php echo $d5['valor_accion']; ?>)" required="required">
					</div>
					<?php $validaciones[] = array('donation', 'donation_input', "'Error en Donación (entre $1 y $" . $d5['valor_accion'] . "). Favor de corregir.'"); ?>
				</div>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-xl">Registrar</button>
				</div>
				</form>
			</div>
			</div>

		</div>
		</section>

		<section class="page-section bg-primary text-white mb-0" id="programa">
		<div class="container">

			<h2 class="page-section-heading text-center text-uppercase text-white">Programa<br> Emprendedores y Empresarios</h2>

			<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
			</div>
			<div class="divider-custom-line"></div>
			</div>

			<div class="row">
			<div class="col-lg-6 ml-auto">
				<p class="lead">Los integrantes de las empresas de <strong>Emprendedores y Empresarios</strong> de JA México se enfrentan a los mismos retos y responsabilidades que tienen las empresas en la actualidad. De esta manera los estudiantes comprenden el sistema de economía de mercado, desarrollan confianza en sí mismos, habilidades de liderazgo y ganan experiencia en las distintas áreas de la empresa.</p>
			</div>
			<div class="col-lg-6 mr-auto">
				<p class="lead"><strong>Su inversión: </strong>Al final del ejercicio (etapa de liquidación), las empresas del programa convierten todos sus logros en dinero. Una carta es enviada a todos los donantes para informarle de los resultados de su donación.</p>
				<p class="lead">Esta donación se hace exclusivamente a representantes autorizados de las empresas de este programa para brindarles una oportunidad educativa a la juventud.</p>
			</div>
			</div>
		</div>
		</section>

		<footer class="footer text-center">
		<div class="container">
			<div class="row">

			<div class="col-lg-5 mb-5 mb-lg-0">
				<h4 class="text-uppercase mb-4">JA México</h4>
				<p class="lead mb-0">JA Centro de Emprendedores Paul Reichmann
				<br>Paseo de la Reforma No. 505, Torre Mayor - Piso 53
				<br>Col. Cuauhtémoc CP 06500, Ciudad de México
				<br>Teléfono: 55 5211 9444
				<br>www.jamexico.org.mx</p>
			</div>

			<div class="col-lg-2 mb-5 mb-lg-0"></div>

			<div class="col-lg-4 mb-5 mb-lg-0">
				<h4 class="text-uppercase mb-4">Conoce más</h4>
				<a class="btn btn-outline-light mx-1" href="https://www.facebook.com/jamexico.org/" target="_blank">
				<i class="fab fa-3x fa-facebook-square"></i>
				</a>
				<a class="btn btn-outline-light mx-1" href="https://twitter.com/JAMexico_org" target="_blank">
				<i class="fab fa-3x fa-twitter-square"></i>
				</a>
				<a class="btn btn-outline-light mx-1" href="https://www.instagram.com/jamexico_org/" target="_blank">
				<i class="fab fa-3x fa-instagram"></i>
				</a>
				<a class="btn btn-outline-light mx-1" href="https://www.linkedin.com/company/impulsa-m%C3%A9xico/" target="_blank">
				<i class="fab fa-3x fa-linkedin"></i>
				</a>
			</div>

			</div>
		</div>
		</footer>

		<section class="copyright py-4 text-center text-white">
		<div class="container">
			<small>Un Programa de </small><a href="https://www.jamexico.org.mx" target="_blank"><img src="images/logo_ja_blanco.png" alt="Logo JA México" height="40"></a>
		</div>
		</section>

		<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
		<div class="scroll-to-top d-lg-none position-fixed ">
		<a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
			<i class="fa fa-chevron-up"></i>
		</a>
		</div>


	<script type="text/javascript">
		var error = document.getElementById('error');
	<?php
		for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
			echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
			echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
				event.preventDefault();
				if (! event.target.validity.valid) {
					error.textContent	 = " . $validaciones[$i][2] . ";
					error.style.display = 'block';
					error.classList.add('animated');
					error.classList.add('shake');
					" . $validaciones[$i][1] . ".classList.add('input_error');
				}
			});

			" . $validaciones[$i][1] . ".addEventListener('input', function(event){
				if ( 'block' === error.style.display ) {
					error.style.display = 'none';
					error.classList.remove('animated');
					error.classList.remove('shake');
				" . $validaciones[$i][1] . ".classList.remove('input_error');
				}
			});
			";
		}
	?>
	</script>

	</body>
	</html>

<?php } else {
	header("Location: 404.php");
}?>