<?php
include_once('../includes/alumno_header.php');
include_once('../scripts/funciones.php');
include_once('../alumno/side_navbar.php');
if ($_SESSION["tipo"] != "Alumn") {
	header('Location: ../error.php');
} else {
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

?>
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../css/morris.css">
<link rel="stylesheet" href="../css/chardinjs.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.js"></script>
<script src="../js/chardinjs.min.js" crossorigin="anonymous"></script>

	<h3 class="text-center py-2" data-intro="¡Bienvenidos al Simulador de Ventas de Emprendeores y Empresarios! <br><br> Tomarás decisiones, realizarás eventos, venderás, y así ¡podrás seguir haciendo crecer a tu empresa! <br><br>Esta guía te ayudará a comprender su funcionamiento. <br><br> ¡Vamos!" data-position="bottom" data-sequence=1>
		Simulador de Ventas de Emprendedores y Empresarios.
	</h3>
	<div class="col-12 text-center" data-intro="Siempre puedes regresar a este menú de ayuda para resolver dudas sobre el funcionamiento del simulador. <br><br> Te deseamos mucho éxito durante tus 'ventas virtuales', esperando que tu y tus compañeros se consoliden como grandes empresarios. <br><br> ¡Adelante con las decisiones!" data-position="bottom" data-sequence=28><a href="#" onclick="ayuda()"><i class="fas fa-chevron-left fa-lg fa-fw mr-2 text-orange"></i><i class="fas fa-question fa-lg fa-fw mr-2 text-orange fa-2x"></i><i class="fas fa-chevron-right fa-lg fa-fw mr-2 text-orange"></i></a></div> <br>

	<div class="row justify-content-center px-5 pb-3" data-intro="Tendremos 3 semanas de ventas. Cada semana simulará un trimestre de operaciones de tu empresa." data-position="top" data-sequence=2>
		<div class="col-12 col-lg-3">
			<div class="card" data-intro="En esta sección tomarás decisiones sobre: <br><br>&nbsp&nbsp - Cuánto producir (a partir de la segunda semana), <br><br>&nbsp&nbsp - A qué precio vender (a partir de la segunda semana), <br><br>&nbsp&nbsp - Cuanto invertirás en mercadotecnia, <br><br>&nbsp&nbsp - Cuanto invertirás en responsabilidad social, <br><br>&nbsp&nbsp - Cuanto invertirás para hacer crecer tu empresa (a partir de la segunda semana) y <br><br>&nbsp&nbsp - Cuanto invertirás en innovación (en la tercer semana) " data-position="right" data-sequence=3>
				<div class="card-body">
					<h5 class="text-center py-2">
						Decisiones
					</h5>
					<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/simul_registrar_decisiones.php" method="post" class="my-4 needs-validation" novalidate>
						<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
						<input name="trim1" type="hidden" id="trim1" value="1">
						<div class="form-group row" data-intro="Aquí decidirás el precio de tu producto/servicio a partir de la segunda semana. <br><br> En la primera el precio ya está fijado con base en lo que trabajaste en la sesión 8. <br><br> ¡Observa muy bien el comportamiento de tus ventas durante la semana para que definas si el precio se modificará para la siguiente!" data-position="right" data-sequence=4>
							<label for="precio" class="col-sm-5 col-form-label">Precio</label>
							<div class="col-sm-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$ </div>
									</div>
									<input type="number" class="form-control rounded text-center" name="precio" id="precio" value="" step="0.01" pattern="\d+(,\d{2})?" required>
									<div class="invalid-feedback">Ingresar Precio de Venta</div>
								</div>
							</div>
						</div>
						<div class="form-group row" data-intro="Aquí decidirás los niveles de producción de tu empresa a partir de la segunda semana. <br><br> En la primera, la producción ya está fijada con base en lo que trabajaste en la sesión 7. <br><br> Recuerda que en esa sesión trabajaste los niveles de producción de dos meses, por lo que la cantidad mostrada en el primer trimestre ya incluye este mes adicional, y será lo que tengas disponible para vender. <br><br> Desde el primer momento en que inicia la simulación tu empresa comienza a producir, aunque sólo podrás vender cuando tu empresa esté en horario de servicio, como se explica más adelante." data-position="right" data-sequence=5>
							<label for="produccion" class="col-sm-5 col-form-label">Producción</label>
							<div class="col-sm-7">
								<input type="number" class="form-control rounded text-center" id="produccion" name="produccion" required>
								<div class="invalid-feedback">Ingresar Producción</div>
							</div>
						</div>
						<div class="form-group row capital" data-intro="Aquí podrás ampliar tus capacidades de producción (tu capacidad instalada), ¡por si requieres tener más unidades de las que originalmente planeaste para vender!" data-position="right" data-sequence=6>
							<label for="capital" class="col-sm-5 col-form-label">Inv. Cap.</label>
							<div class="col-sm-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$ </div>
									</div>
									<input type="number" class="form-control rounded text-center" name="capital" id="capital" value="" step="0.01" pattern="\d+(,\d{2})?" required>
									<div class="invalid-feedback">Ingresar Inversión de capital</div>
								</div>
							</div>
						</div>
						<div class="form-group row i_and_d" data-intro="Aquí podrás destinar recursos para realizar innovaciones en tu producto/servcio, y así poder mantener a tus clientes siempre a la vaguardia" data-position="right" data-sequence=7>
							<label for="i_and_d" class="col-sm-5 col-form-label">I & D</label>
							<div class="col-sm-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$ </div>
									</div>
									<input type="number" class="form-control rounded text-center" name="i_and_d" id="i_and_d" value="" step="0.01" pattern="\d+(,\d{2})?" required>
									<div class="invalid-feedback">Ingresar Inversión de I&D</div>
								</div>
							</div>
						</div>
						<div class="form-group row" data-intro="Aquí podrás destinar recursos para promover tu producto/servicio. <br><br> Debes agregar qué porcentaje del total de tus utilidades [= (precio - costo) * unidades vendidas] destinarás para este fin. El máximo que podrás destinar es de un 8% de este total. <br><br> Más adelante te explicamos cómo distribuir esta inversión entre las zonas geográficas que determines." data-position="right" data-sequence=8>
							<label for="mkt" class="col-sm-5 col-form-label">Mercadot.</label>
							<div class="col-sm-7">
								<div class="input-group">
									<input type="number" class="form-control rounded text-center" name="mkt" id="mkt" value="" min="0" max="8" step="0.01" pattern="\d+(,\d{2})?" required>
									<div class="input-group-append">
										<div class="input-group-text">% </div>
									</div>
									<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia (8% máximo recomendado)</div>
								</div>
							</div>
						</div>
						<div class="form-group row" data-intro="Aquí podrás destinar un porcentaje de tus utilidades [= (precio - costo) * unidades vendidas] a acciones de resonsabilidad social. Revisa en los contenidos de la sesión 11 este tema. El máximo que podrás destinar es de un 5% de este total. <br><br>" data-position="right" data-sequence=9>
							<label for="rse" class="col-sm-5 col-form-label">Resp. Soc.</label>
							<div class="col-sm-7">
								<div class="input-group">
									<input type="number" class="form-control rounded text-center" name="rse" id="rse" value="" min="0" max="5" step="0.01" pattern="\d+(,\d{2})?" required>
									<div class="input-group-append">
										<div class="input-group-text">% </div>
									</div>
									<div class="invalid-feedback">Ingresar % de inversión en Resp. Soc.  (5% máximo recomendado)</div>
								</div>
							</div>
						</div>
						<div class="form-group row" data-intro="Todas las decisiones que tomes en este apartado deberás registrarlas dando clic en este botón." data-position="right" data-sequence=10>
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-warning text-center px-4 my-2" id="btn_registrar_decisiones">Registrar decisiones</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="card-body px-1" data-intro="A medida que avance la semana (el trimestre de ventas), aquí podrás ver graficados los resulados de la empresa o de cada vendedor por separado." data-position="bottom" data-sequence=25>
				<h5 class="card-title"></h5>
				<div class="text-center" id="carga_calendario" data-intro="Aquí podrás seguir el avance de la <b>fecha simulada</b> en la que estamos. <br><br> Este calendario únicamente avanzará mientras se encuentre tu empresa abierta, durante los horarios de atención que estableciste." data-position="bottom" data-sequence=26></div>

				<form>
					<div class="form-row justify-content-end" data-intro="Aquí podrás ver cuánto has producido al momento, así como las ventas totales registradas y los consiguientes ingresos y utilidades generados." data-position="bottom" data-sequence=27>
						<div class="col-6 col-lg-3 mb-3">
							<label for="prod_tot">Producción Total</label>
							<input type="text" class="form-control text-center" id="prod_tot" name="prod_tot" disabled>
						</div>
						<div class="col-6 col-lg-3 mb-3">
							<label for="ventas_tot">Ventas Totales</label>
							<input type="text" class="form-control text-center" id="ventas_tot" name="ventas_tot" disabled>
						</div>
						<div class="col-6 col-lg-3 mb-3">
							<label for="ing_tot">Ingresos Totales</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">$ </span>
								</div>
								<input type="text" class="form-control text-center" id="ing_tot" disabled>
							</div>
						</div>
						<div class="col-6 col-lg-3 mb-3">
							<label for="util_tot">Utilidades Totales</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">$ </div>
								</div>
								<input type="text" class="form-control text-center" id="util_tot" disabled>
							</div>
						</div>
					</div>
				</form>
				<?php /*
				<div class="card-text" data-intro="Y aquí los gráficos de la actuación de tu empresa durante las semanas de venta." data-position="bottom" data-sequence=27>
					<div class="form-row">
						<div class="col-1"></div>
						<div class="form-group row col-10">
							<label for="select_empresa" class="col-sm-2 col-form-label text-right">Gráfico:</label>
							<div class="col-sm-10">
								<select name="select_grafico" type="text" id="select_grafico" class="form-control rounded" onChange="filtro_grafico()">
									<option value="">Selecciona gráfico a revisar</option>
									<option value="generales">Ventas globales</option>
									<option value="zona">Ventas por zona</option>
									<option value="produccion">Ventas vs producción</option>
									<option value="eventos">Atención a eventos</option>
								</select>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div id="grafico_pers" style="height: 180px;"></div>
							</div>
						</div>
					</div>
				</div>
				*/ ?>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="card">
				<div class="card-body" data-intro="En esta sección defines el horario de atención <b>real</b> a tus clientes en este simulador. <br><br> Este horario determina lo siguiente: <br><br>&nbsp&nbsp - Las horas 'reales' del día que tu empresa esta abierta y vendiendo (fuera de este horario no es posible realizar ventas) <br><br>&nbsp&nbsp - El lapso de tiempo <b>real</b> durante el día en que pueden aparecer <b>eventos</b> para tu empresa, como se explica más adelante <br><br> Te recomendamos que el horario establecido aquí sea aquél en el que los integrantes de la empresa pueden estar monitoreando el simulador, para atender los eventos que te explicaremos a continuación." data-position="left" data-sequence=11>
					<h5 class="text-center py-2">
						Horario de atención
					</h5>
					<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/simul_registrar_decisiones2.php" method="post" class="my-4 needs-validation" novalidate>
						<input name="csrf2" type="hidden" id="csrf2" value="<?php echo $_SESSION['token']; ?>">
						<input name="trim2" type="hidden" id="trim2" value="1">
						<div data-intro="Este apartado es sumamente importante, ya que representa que tu empresa está <b>abierta</b> para vender, así que no debes tardar mucho en registrar esta decisión, que podrás modificar hasta el próximo trimestre. <br><br> El <b>Director General</b> puede seleccionar este horario, en acuerdo con sus compañeros, desde las 7:00 am y hasta las 11:00 pm <br><br>" data-position="left" data-sequence=12>
							<div class="form-group row">
								<label for="abre" class="col-sm-4 col-form-label">Abre:</label>
								<div class="col-sm-8">
									<input type="time" class="form-control" id="abre" name="abre" min="07:00" max="23:00" step="60" value="00:00">
									<div class="invalid-feedback">El horario de apertura debe ser a partir de las 07:00 a.m.</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="cierra" class="col-sm-4 col-form-label">Cierra:</label>
								<div class="col-sm-8">
									<input type="time" class="form-control" id="cierra" name="cierra" min="07:00" max="23:00" step="60" value="00:00">
									<div class="invalid-feedback">El horario de cierre debe ser como máximo a las 11:00 p.m.</div>
								</div>
							</div>
						</div>
						<div class="text-orange" data-intro="Aquí podrás ver en todo momento el estatus de la empresa: <b>abierta</b> o <b>cerrada</b>" data-position="left" data-sequence=13>
							<div class="form-group row" id="oficina_abierta">
								<div class="col-sm-12 text-center">¡La empresa está abierta!<br>¡A vender!</div>
							</div>
							<div class="form-group row" id="oficina_cerrada">
								<div class="col-sm-12 text-center">Empresa cerrada<br>Consulte nuestro horario de atención.</div>
							</div>
						</div>
						<div class="form-group row" data-intro="Registrar tu horario de atención dando clic en este botón." data-position="left" data-sequence=14>
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-warning text-center px-4 my-2" id="btn_registrar_horarios">Registrar horarios</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php /*
			<div class="card text-white bg-info">
				<div class="card-body">
					Comentarios<br><br>
				</div>
			</div>
			*/ ?>
		</div>
	</div>

	<div class="row px-5 pb-3">
		<div class="col-2"></div>
		<div class="col-8 card text-white bg-warning">
			<div class="card-body" data-intro="Esta es la sección de <b>Eventos</b>. <br><br> Recuerda que durante las semanas de simulación, independientemente del puesto de cada integrante de la empresa, <b>todos se vuelven vendedores</b>, por lo que es responsabilidad compartida atender los requerimientos y solicitudes de tus clientes." data-position="top" data-sequence=15>
				<h5 class="text-center text-white py-2" data-intro="En esta sección aparecerán de manera aleatoria estos requerimientos/solicitudes, relacionados con ventas, cuya atención es responsabilidad de todos los vendedores de la empresa. <br><br> Una vez que se genere un evento, éste se mostrará de manera simultánea a todos los vendedores conectados en ese momento. <br><br> Pueden ser eventos tan diversos como dar información del producto/servicio, atender un pedido, una llamada o contestar un correo de un cliente, resolver quejas o dudas de funcionamiento, entre otros." data-position="top" data-sequence=16>
					<div id="hay_evento">
						<i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i> ¡Se desarrolla un evento! <i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><br><br>
						¡Es necesaria la intervención de un vendedor!
					</div>
					<div id="no_hay_evento">
						No se está desarrollando evento alguno en este momento.
					</div>
				</h5>
				<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/simul_registrar_evento.php" method="post" class="my-4">
					<input name="csrf4" type="hidden" id="csrf4" value="<?php echo $_SESSION['token']; ?>">
					<input name="id_evento" type="hidden" id="id_evento" value="">
					<div data-intro="Si hay un evento en desarrollo, en esta sección te aparecerá un botón parpadeante que describe de qué se trata. Para atenderlo, como vendedor lo único que debes hacer es dar clic en el botón y así habrás atendido a ese cliente. <br><br> ¡Atender eventos provoca que tu nivel como vendedor crezca! y, por tanto, tus ventas en lo personal sean mayores también. <br><br> ¡Pero apresúrate! ya que si alguno de tus compañeros/vendedores atiende el evento antes que tu, habrás perdido la oportunidad de servir a uno de tus clientes. <br><br> ¡Recuerda que entre más eventos atiendas, mejor vendedor serás!" data-position="top" data-sequence=17>
						<div class="form-group row" id="boton_evento">
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-warning faa-vertical animated faa-fast" id="evento_actual"></button>
							</div>
						</div>
						<div class="form-group row" id="sin_evento">
							<div class="col-sm-12 text-center" id="sin_evento_actual">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-2"></div>
	</div>
	<hr>
	<div class="justify-content-center px-5 pb-5">
		<h5 class="text-center py-2" data-intro="En esta sección podrás realizar lo siguiente <br><br>&nbsp&nbsp - Definir las zonas geográficas de tu interés para las ventas, <br><br>&nbsp&nbsp - Asignar a los vendedores que atenderán esa región, <br><br>&nbsp&nbsp - Distribuirás tu inversión en mercadotecnia, <br><br>&nbsp&nbsp - Definirás el tipo de campaña que realizarás para llegar a tus clientes. <br><br>Mientras no registres la información de esta zona ¡no habrá ventas! porque debes definir en dón de aplicar los recursos de mercadotecnia y asignar vendedores, así que ¡No tardes!" data-position="top" data-sequence=18>
			Campaña a desplegar y Segmentación geográfica para ventas
		</h5>
		<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/simul_registrar_decisiones3.php" method="post" class="my-4 needs-validation" novalidate onsubmit="return validacion()">
			<input name="csrf3" type="hidden" id="csrf3" value="<?php echo $_SESSION['token']; ?>">
			<input name="trim3" type="hidden" id="trim3" value="1">

			<div class="col-12 text-center pb-3" data-intro="Tienes 3 opciones de campañas de mercadotecnia disponibles. <br><br> Cada una de ellas te puede dar resultados diferentes en tu volumen de ventas, que dependerá también del recurso total que hayas asignado a este rubro. <br><br> Debes seleccionar una de estas campañas, que podrás modificar el próximo trimestre, dependiendo de los resultados." data-position="top" data-sequence=19>
				Tipo de Campaña de Marketing a utilizar:&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="campana_mkt" id="campana_mkt_1" value="1" required>
					<label class="form-check-label" for="campana_mkt_1">Publicidad física (volantes)</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="campana_mkt" id="campana_mkt_2" value="2" required>
					<label class="form-check-label" for="campana_mkt_2">Publicidad en sitios web</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="campana_mkt" id="campana_mkt_3" value="3" required>
					<label class="form-check-label" for="campana_mkt_3">Publicidad en redes sociales</label>
					<div class="invalid-feedback">Selecciona campaña a utilizar</div>
				</div>
			</div>

			<div class="row" data-intro="Tienes disponibles hasta 6 zonas geográficas para vender. <br><br> Aquí determinas que cobertura geográfica abarca cada región, así como qué vendedores estarán encargados de la misma y el porcentaje de recursos de mercadotecnia que le destinarás." data-position="top" data-sequence=20>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 1
							<div class="form-group py-2" data-intro="En cada zona puedes asignar una delimitación geográfica. <br><br> Esta cobertura puede ser desde una colonia, una ciudad, estado o una región más amplia. <br><br> ¡Tu decides hasta donde quieres ampliar tus ventas!" data-position="right" data-sequence=21>
								<label for="cobertura_1">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_1" name="cobertura_1" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3" data-intro="Considerando el 100% de recursos de Mercadotecnia que estableciste arriba, en el apartado <b>Decisiones</b>, aquí deberás distribuirlo entre todas las regiones que decidas atender. <br><br> Ten en cuenta que la suma de estos 6 valores que ingreses en cada región, debe ser 100. <br><br> Es posible que establezcas en 0 este campo en una región, lo que significará que no habrá ventas en esa zona." data-position="right" data-sequence=22>
								<label for="mkt_z1" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z1" id="mkt_z1" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div data-intro="Puedes asignar hasta 3 vendedores por zona, no más. <br><br> Entre más vendedores asignes a una zona y mayor el porcentaje de inversión en mercadotecnia, ¡más exitosas serán las ventas ahí! <br><br> ¡Define tu estrategia de ventas con inteligencia! <br><br> Por otra parte, si decides no asignar vendedores a una región o ya no tienes más vendedores por asignar, pero sí le asignas presupuesto de mercadotecnia, ¡también tendrás ventas en esa zona!" data-position="right" data-sequence=23>
								<div class="pb-2">Vendedores:</div>
								<div class="form-row pb-1">
									<label for="z1_v1" class="col-sm-2 col-form-label text-left">1:</label>
									<div class="col-sm-10">
										<select name="z1_v1" type="text" id="z1_v1" class="form-control rounded">
										</select>
									</div>
								</div>
								<div class="form-row pb-1">
									<label for="z1_v2" class="col-sm-2 col-form-label text-left">2:</label>
									<div class="col-sm-10">
										<select name="z1_v2" type="text" id="z1_v2" class="form-control rounded">
										</select>
									</div>
								</div>
								<div class="form-row pb-1">
									<label for="z1_v3" class="col-sm-2 col-form-label text-left">3:</label>
									<div class="col-sm-10">
										<select name="z1_v3" type="text" id="z1_v3" class="form-control rounded">
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 2
							<div class="form-group py-2">
								<label for="cobertura_2">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_2" name="cobertura_2" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3">
								<label for="mkt_z2" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z2" id="mkt_z2" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div class="pb-2">Vendedores:</div>
							<div class="form-row pb-1">
								<label for="z2_v1" class="col-sm-2 col-form-label text-left">1:</label>
								<div class="col-sm-10">
									<select name="z2_v1" type="text" id="z2_v1" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z2_v2" class="col-sm-2 col-form-label text-left">2:</label>
								<div class="col-sm-10">
									<select name="z2_v2" type="text" id="z2_v2" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z2_v3" class="col-sm-2 col-form-label text-left">3:</label>
								<div class="col-sm-10">
									<select name="z2_v3" type="text" id="z2_v3" class="form-control rounded">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 3
							<div class="form-group py-2">
								<label for="cobertura_3">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_3" name="cobertura_3" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3">
								<label for="mkt_z3" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z3" id="mkt_z3" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div class="pb-2">Vendedores:</div>
							<div class="form-row pb-1">
								<label for="z3_v1" class="col-sm-2 col-form-label text-left">1:</label>
								<div class="col-sm-10">
									<select name="z3_v1" type="text" id="z3_v1" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z3_v2" class="col-sm-2 col-form-label text-left">2:</label>
								<div class="col-sm-10">
									<select name="z3_v2" type="text" id="z3_v2" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z3_v3" class="col-sm-2 col-form-label text-left">3:</label>
								<div class="col-sm-10">
									<select name="z3_v3" type="text" id="z3_v3" class="form-control rounded">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 4
							<div class="form-group py-2">
								<label for="cobertura_4">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_4" name="cobertura_4" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3">
								<label for="mkt_z4" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z4" id="mkt_z4" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div class="pb-2">Vendedores:</div>
							<div class="form-row pb-1">
								<label for="z4_v1" class="col-sm-2 col-form-label text-left">1:</label>
								<div class="col-sm-10">
									<select name="z4_v1" type="text" id="z4_v1" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z4_v2" class="col-sm-2 col-form-label text-left">2:</label>
								<div class="col-sm-10">
									<select name="z4_v2" type="text" id="z4_v2" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z4_v3" class="col-sm-2 col-form-label text-left">3:</label>
								<div class="col-sm-10">
									<select name="z4_v3" type="text" id="z4_v3" class="form-control rounded">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 5
							<div class="form-group py-2">
								<label for="cobertura_5">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_5" name="cobertura_5" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3">
								<label for="mkt_z5" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z5" id="mkt_z5" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div class="pb-2">Vendedores:</div>
							<div class="form-row pb-1">
								<label for="z5_v1" class="col-sm-2 col-form-label text-left">1:</label>
								<div class="col-sm-10">
									<select name="z5_v1" type="text" id="z5_v1" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z5_v2" class="col-sm-2 col-form-label text-left">2:</label>
								<div class="col-sm-10">
									<select name="z5_v2" type="text" id="z5_v2" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z5_v3" class="col-sm-2 col-form-label text-left">3:</label>
								<div class="col-sm-10">
									<select name="z5_v3" type="text" id="z5_v3" class="form-control rounded">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-2">
					<div class="card">
						<div class="card-body">
							Zona 6
							<div class="form-group py-2">
								<label for="cobertura_6">Cobertura geográfica</label>
								<textarea class="form-control" id="cobertura_6" name="cobertura_6" rows="3" required></textarea>
								<div class="invalid-feedback">Ingresa cobertura</div>
							</div>
							<div class="row pb-3">
								<label for="mkt_z6" class="col-sm-4 col-form-label">% Mkt.</label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="number" class="form-control rounded text-center" name="mkt_z6" id="mkt_z6" value="" min="0" max="100" step="0.01" pattern="\d+(,\d{2})?" required>
										<div class="invalid-feedback">Ingresar % de inversión en mercadotecnia</div>
									</div>
								</div>
							</div>

							<div class="pb-2">Vendedores:</div>
							<div class="form-row pb-1">
								<label for="z6_v1" class="col-sm-2 col-form-label text-left">1:</label>
								<div class="col-sm-10">
									<select name="z6_v1" type="text" id="z6_v1" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z6_v2" class="col-sm-2 col-form-label text-left">2:</label>
								<div class="col-sm-10">
									<select name="z6_v2" type="text" id="z6_v2" class="form-control rounded">
									</select>
								</div>
							</div>
							<div class="form-row pb-1">
								<label for="z6_v3" class="col-sm-2 col-form-label text-left">3:</label>
								<div class="col-sm-10">
									<select name="z6_v3" type="text" id="z6_v3" class="form-control rounded">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row my-3" id="error_suma_inv_mkt" style="display: none">
				<div class="col-sm-12 text-center">La suma de los %Mkt de las 6 zonas debe ser de 100%. Algunas pueden estar en 0%.</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12 text-center" data-intro="Registra con este botón las decisiones que tomes, y recuerda que las podrás modificar para el próximo trimestre." data-position="top" data-sequence=24>
					<button type="submit" class="btn btn-warning text-center px-4 my-2" id="btn_registrar_zonas">Registrar Campaña, Zonas de venta y Vendedores</button>
				</div>
			</div>
		</form>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
		  url: '../alumno/ajax/empresarios.php',
		  success: function(data)
		  {
			$('#z1_v1').append(data);
			$('#z1_v2').append(data);
			$('#z1_v3').append(data);
			$('#z2_v1').append(data);
			$('#z2_v2').append(data);
			$('#z2_v3').append(data);
			$('#z3_v1').append(data);
			$('#z3_v2').append(data);
			$('#z3_v3').append(data);
			$('#z4_v1').append(data);
			$('#z4_v2').append(data);
			$('#z4_v3').append(data);
			$('#z5_v1').append(data);
			$('#z5_v2').append(data);
			$('#z5_v3').append(data);
			$('#z6_v1').append(data);
			$('#z6_v2').append(data);
			$('#z6_v3').append(data);
		  }
		});

		$.ajax({
		  url: '../alumno/ajax/simulador_data.php',
		  success: function(data)
		  {
			var array = JSON.parse(data);
			trimestre = array.trimestre;
			$("#trim1").val(array.trimestre);
			$("#trim2").val(array.trimestre);
			$("#trim3").val(array.trimestre);
			$("#precio").val(array.precio);
			$("#produccion").val(array.produccion);
			$("#capital").val(array.capital);
			$("#i_and_d").val(array.i_and_d);
			$("#mkt").val(array.mkt);
			$("input[type='radio'][name='campana_mkt'][value='"+array.campana_mkt+"']").prop('checked',true);
			$("#rse").val(array.rse);
			if (array.abre != "") {
				$("#abre").val(array.abre);
			}
			if (array.cierra != "") {
				$("#cierra").val(array.cierra);
			}
			if (trimestre=1) {
				$("#precio").attr("readonly","readonly");
				$("#produccion").attr("readonly","readonly");
				$("#capital").prop('disabled', true);
				$(".capital").hide();
				$("#i_and_d").prop('disabled', true);
				$(".i_and_d").hide();
			}
			if (array.estatus_servicio == 1) {
				$("#oficina_abierta").show();
				$("#oficina_cerrada").hide();
			} else {
				$("#oficina_abierta").hide();
				$("#oficina_cerrada").show();
			}
			if (array.zonas != "") {
				for (var i = 1; i <= 6; i++) {
					zona = array.zonas[i-1][0];
					if (zona > 0) {
						$("#cobertura_"+zona).html(array.zonas[i-1][1]);
						$("#mkt_z"+zona).val(array.zonas[i-1][5]);
						$("#z"+zona+"_v1").val(array.zonas[i-1][2]);
						$("#z"+zona+"_v2").val(array.zonas[i-1][3]);
						$("#z"+zona+"_v3").val(array.zonas[i-1][4]);
					}
				}
			}
			$("#prod_tot").val(array.prod_tot);
			$("#ventas_tot").val(array.ventas_tot);
			$("#ing_tot").val(array.ing_tot);
			$("#util_tot").val(array.util_tot);
		  }
		});

		$.ajax({
		  url: '../alumno/ajax/simulador_eventos.php',
		  success: function(data)
		  {
			var array = JSON.parse(data);
			ID = array.registro_eventos_ID;
			if (ID == 0) {
				$("#boton_evento").hide();
				$("#hay_evento").hide();
				$("#sin_evento").show();
				$("#no_hay_evento").show();
				$("#sin_evento_actual").html(array.evento);
			} else {
				$("#boton_evento").show();
				$("#hay_evento").show();
				$("#sin_evento").hide();
				$("#no_hay_evento").hide();
				$("#id_evento").val(ID);
				$("#evento_actual").html(array.evento);
			}
		  }
		});

		$.ajax({
		  url: '../alumno/ajax/simulador_calendario.php',
		  success: function(data)
		  {
			$("#carga_calendario").html(data);
		  }
		});

	});

	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();

	let timer_eventos = setInterval(function(){
		$.ajax({
		  url: '../alumno/ajax/simulador_eventos.php',
		  success: function(data)
		  {
			var array = JSON.parse(data);
			ID = array.registro_eventos_ID;
			if (ID == 0) {
				$("#boton_evento").hide();
				$("#sin_evento").show();
				$("#sin_evento_actual").html(array.evento);
			} else {
				$("#boton_evento").show();
				$("#sin_evento").hide();
				$("#id_evento").val(ID);
				$("#evento_actual").html(array.evento);
			}
		  }
		})}, 60000);

	function validacion(){
		mkt_z1 = parseFloat(document.getElementById('mkt_z1').value);
		mkt_z2 = parseFloat(document.getElementById('mkt_z2').value);
		mkt_z3 = parseFloat(document.getElementById('mkt_z3').value);
		mkt_z4 = parseFloat(document.getElementById('mkt_z4').value);
		mkt_z5 = parseFloat(document.getElementById('mkt_z5').value);
		mkt_z6 = parseFloat(document.getElementById('mkt_z6').value);
		if (mkt_z1+mkt_z2+mkt_z3+mkt_z4+mkt_z5+mkt_z6 != 100) {
			$("#error_suma_inv_mkt").show();
			return false;
		} else {
			$("#error_suma_inv_mkt").hide();
			return true;
		}
	}

	function filtro_grafico(){
		grafico=document.getElementById("select_grafico").value;
		var parametros = {
			grafico : grafico,
		};

		if(grafico == "generales"){
			$.ajax({
				data: parametros,
				url: '../alumno/ajax/simulador_graficos.php',
				type: "POST",
				dataType: "json",
				success: function (data) {
					graficaGenerales(data);
				},
			});
		}
		if(grafico == 'zona'){
			$.ajax({
			data: parametros,
			url: '../alumno/ajax/simulador_graficos.php',
			type: "POST",
			dataType: "json",
			success: function (data) {
				graficaZona(data);
			},
			});
		}
		if(grafico == 'produccion'){
			$.ajax({
			data: parametros,
			url: '../alumno/ajax/simulador_graficos.php',
			type: "POST",
			dataType: "json",
			success: function (data) {
				graficaProduccion(data);
			},
			});
		}
		if(grafico == 'eventos'){
			$.ajax({
			data: parametros,
			url: '../alumno/ajax/simulador_graficos.php',
			type: "POST",
			dataType: "json",
			success: function (data) {
				graficaEventos(data);
			},
			});
		}
	}

	function graficaGenerales(data) {
		$("#grafico_pers").text("");
		var morris1 = new Morris.Line({
			element: 'grafico_pers',
			data: data,
			xkey: 'team',
			ykeys: ['valor'],
			labels: ['Ventas'],
			resize: true,
			barColors : ['#B4D455', '#FFDA1A', '#f9a80e' ]
		});
	}
	function graficaZona(data) {
		$("#grafico_pers").text("");
		var morris1 = new Morris.Bar({
			element: 'grafico_pers',
			data: data,
			xkey: 'team',
			ykeys: ['valor'],
			labels: ['Ventas'],
			resize: true,
			barColors : ['#B4D455', '#FFDA1A', '#f9a80e' ]
		});
	}
	function graficaProduccion(data) {
		$("#grafico_pers").text("");
		var morris1 = new Morris.Line({
			element: 'grafico_pers',
			data: data,
			xkey: 'team',
			ykeys: ['valor', 'z'],
			labels: ['Ventas', 'Producción'],
			resize: true,
			barColors : ['#B4D455', '#FFDA1A', '#f9a80e' ]
		});
	}
	function graficaEventos(data) {
		$("#grafico_pers").text("");
		var morris1 = new Morris.Bar({
			element: 'grafico_pers',
			data: data,
			xkey: 'team',
			ykeys: ['valor'],
			labels: ['Eventos atendidos'],
			resize: true,
			barColors : ['#B4D455', '#FFDA1A', '#f9a80e' ]
		});
	}

	function ayuda(){
		$('body').chardinJs('start');
	}

</script>


<?php
}
include_once('../includes/alumno_footer.php');
?>