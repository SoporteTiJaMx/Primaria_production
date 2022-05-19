<?php
	include_once('../includes/alumno_header.php');
	include_once('../scripts/funciones.php');
	include_once('../alumno/side_navbar.php');


	if ($_SESSION["tipo"] != "Alumn") {
		header('Location: ../error.php');
	} else {

	$eventos = include_once('ajax/calendar_eventos.php');

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>
<link rel="stylesheet" type="text/css" href="../css/fullcalendar.core.main.css">
<link rel="stylesheet" type="text/css" href="../css/fullcalendar.daygrid.main.css">
<link rel="stylesheet" type="text/css" href="../css/fullcalendar.bootstrap.main.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">
<script src="../js/moment.min.js"></script>
<script src='../js/fullcalendar.core.main.js'></script>
<script src='../js/fullcalendar.daygrid.main.js'></script>
<script src='../js/fullcalendar.bootstrap.main.js'></script>
<script src="../js/fullcalendar.locale.es.js"></script>
<script src='../js/fullcalendar.interaction.main.js'></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker.es.min.js"></script>

<h5 class="text-center text-dark_gray pt-3 pb-1">
	Calendario operativo de Emprendedores y Empresarios: <?php echo $_SESSION["licencia_nombre"]; ?>.
</h5>
<div class="mx-5 mt-3 mb-5 pb-5">
	<div id='calendar-container'>
		<div id='calendario'></div>
	</div>
</div>

<script type="text/javascript">

	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendario');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'dayGrid', 'bootstrap' ],
			themeSystem: 'bootstrap',
			locale: 'es',
			events: <?php echo $eventos; ?>,
			allDayDefault: true,
		});
		calendar.render();
	});

	$(document).ready(function(){
		$( "a.fc-event" ).each(function() {
			$( this ).attr({'data-toggle':'tooltip', 'data-placement':'top', 'title':$(this).find('span.fc-title').text()});
		});
		$('#calendario').css('float','left');
		$('#calendario').css('width','100%');
		$('.fc-toolbar h2').css('font-size','1.25em');
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

<?php
}
include_once('../includes/alumno_footer.php');
?>