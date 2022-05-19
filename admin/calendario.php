<?php
include_once('../includes/admin_header.php');
include_once('../scripts/funciones.php');
include_once('../admin/side_navbar.php');
if ($_SESSION["tipo"] != "Admin") {
	header('Location: ../error.php');
} else {
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

<?php if (isset($_SESSION["licencia_activa"])) { ?>
	<h5 class="text-center text-dark_gray pt-3 pb-1">
		Configura el calendario operativo del ciclo
		<?php if (isset($_SESSION['nombre_licencia'])) { echo " " . $_SESSION['nombre_licencia']; } ?>.
	</h5>
<?php $eventos = include_once('ajax/calendar_eventos.php'); ?>
	<div class="mx-5 mt-3 mb-5 pb-5">
		<div id='external-events' class="mt-5">
			<h5>Sesiones</h5>
			<div id="sesiones"></div>
		</div>
		<div id='calendar-container'>
			<div id='calendario'></div>
		</div>
	</div>

	<script type="text/javascript">

	document.addEventListener('DOMContentLoaded', function() {
		var containerEl = document.getElementById('external-events');
		var calendarEl = document.getElementById('calendario');
		var Draggable = FullCalendarInteraction.Draggable;

		new Draggable(containerEl, {
			itemSelector: '.fc-event',
			eventData: function(eventEl) {
				return {
					title: eventEl.innerText,
				};
			}
		});

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid', 'bootstrap' ],
			themeSystem: 'bootstrap',
			locale: 'es',
			timeZone: 'America/Mexico_City',
			editable: true,
			droppable: true,
			resizable: true,
			displayEventTime: false,
			events: <?php echo $eventos; ?>,
			disableResizing: false,
			allDayDefault: true,
			eventResizeStart:true,

			drop: function(info) {
				info.draggedEl.parentNode.removeChild(info.draggedEl);
			},
			eventReceive: function(info) {
				var parametros = {
					"Sesiones_ID" : info.draggedEl.id,
					"Eventos_inicio" : info.event.start.toISOString()
				};
				accion = "agregar";
				$.ajax({
				  data:  parametros,
				  url: 'ajax/calendar_modificar_sesion.php?accion='+accion,
				  type: 'post',
				  success: function(data)
				  {
					//console.log(data);
					location.reload();
				  },
				});
			},
			dateClick:function(info){
				$('#btnAgregar').prop("disabled",false);
				$('#btnEliminar').prop("disabled",true);
				$('#btnModificar').prop("disabled",true);
				limpiarFormulario();
				$('#tituloEvento').html("Agregar Evento");
				$('#txtFechaInicio').val(info.dateStr);
				$("#ModalEventos").modal();
			},
			eventClick:function(info){
				$('#btnAgregar').prop("disabled",true);
				$('#btnEliminar').prop("disabled",false);
				$('#btnModificar').prop("disabled",false);
				$('#tituloEvento').html("Editar Evento");
				$('#Eventos_ID').val(info.event.id);
				$('#txtTitulo').val(info.event.title);
				$('#txtDescripcion').val(info.event.extendedProps.descripcion);
				$('#txtFechaInicio').val(getFormattedDate(info.event.start));
				$('#txtColor').val(info.event.backgroundColor);
				$("#ModalEventos").modal();
			},
			eventResize: function(info) {
				var parametros = {
					"Eventos_ID" : info.event.id,
					"Eventos_fin" : info.event.end.toISOString()
				};
				accion = "resize";
				$.ajax({
				  data:  parametros,
				  url: 'ajax/calendar_modificar_sesion.php?accion='+accion,
				  type: 'post',
				  success: function(data)
				  {
					//console.log(data);
					location.reload();
				  }
				});
			},
			eventDrop:function(info){
				var parametros = {
					"Eventos_ID" : info.event.id,
					"Eventos_inicio" : info.event.start.toISOString(),
					"Eventos_fin" : info.event.end.toISOString()
				};
				accion = "mover";
				$.ajax({
				  data:  parametros,
				  url: 'ajax/calendar_modificar_sesion.php?accion='+accion,
				  type: 'post',
				  success: function(data)
				  {
					//console.log(data);
					location.reload();
				  }
				});
			},
			eventRender:function(info){
				$('a.fc-event').addClass('fc-resizable');
				$('div.fc-content').after('<div class="fc-resizer fc-end-resizer"></div>');
			},
			viewSkeletonRender:function(info){
				$('a.fc-event').addClass('fc-resizable');
				$('div.fc-content').after('<div class="fc-resizer fc-end-resizer"></div>');
			},
		});

		calendar.render();
	});

		$(document).ready(function(){
			//alert("ready");
			$.ajax({
				url:'../admin/ajax/calendar_mostrar_sesiones.php',
				success: function(data){
					$('#sesiones').html(data);
				}
			});
			//$('a.fc-event').addClass('fc-resizable');
			//$('div.fc-content').after('<div class="fc-resizer fc-end-resizer"></div>');
			$( "a.fc-event" ).each(function() {
				$( this ).attr({'data-toggle':'tooltip', 'data-placement':'top', 'title':$(this).find('span.fc-title').text()});
			});
			$('.fc-toolbar h2').css('font-size','1.25em');
		});
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})

		function getFormattedDate(date) {
			var year = date.getFullYear();

			var month = (1 + date.getMonth()).toString();
			month = month.length > 1 ? month : '0' + month;

			var day = date.getDate().toString();
			day = day.length > 1 ? day : '0' + day;

			return year + '-' + month + '-' + day;
		}
	</script>
	<!-- Modal Operaciones-->
	<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tituloEvento">
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form role="form">
						<div class="text-center mb-3"><div id="error" class="bg-danger w-75 py-2 text-center text-white rounded mx-auto">Campos marcados con * son obligatorios, de lo contrario no se registrará el evento.</div></div>
						<input type="hidden" id="Eventos_ID" name="Eventos_ID">
						<div class="form-row">
							<div class="form-group col-1"></div>
							<div class="form-group col-md-10">
								<label>Evento: *</label>
								<input type="text" id="txtTitulo" name="txtTitulo" class="form-control rounded" value="" required>
								<small id="txtTitulo_help" class="form-text w200">Nombre del Evento que estás agregando.</small>
							</div>
							<div class="form-group col-1"></div>
						</div>
						<div class="form-row">
							<div class="form-group col-1"></div>
							<div class="form-group col-md-5">
								<label>Fecha del Evento: *</label>
								<input type="text" id="txtFechaInicio" value="" class="form-control rounded datepicker" value="" required>
								<small id="txtFechaInicio_help" class="form-text w200">Fecha de inicio del evento.</small>
							</div>
							<div class="form-group col-md-5">
								<label>Color:</label>
								<input type="color" value="#FF0000" id="txtColor" class="form-control rounded">
								<small id="txtColor_help" class="form-text w200">Color para identificar en Calendario.</small>
							</div>
							<div class="form-group col-1"></div>
						</div>
						<div class="form-row">
							<div class="form-group col-1"></div>
							<div class="form-group col-md-10">
								<label>Descripción: *</label>
								<textarea id="txtDescripcion" rows="3" class="form-control rounded" required></textarea>
								<small id="txtDescripcion_help" class="form-text w200">Como identificar el evento en el Calendario.</small>
							</div>
							<div class="form-group col-1"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnAgregar" class="btn btn-warning">Agregar</button>
					<button type="submit" id="btnModificar" class="btn btn-success">Modificar</button>
					<button type="submit" id="btnEliminar" class="btn btn-danger">Borrar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var NuevoEvento;
		$('#btnAgregar').click(function(){
			RecolectarDatosGUI();
			EnviarInformacion('agregar',NuevoEvento);
		}
							  );
		$('#btnEliminar').click(function(){
			RecolectarDatosGUI();
			EnviarInformacion('eliminar',NuevoEvento);
		}
							   );
		$('#btnModificar').click(function(){
			RecolectarDatosGUI();
			EnviarInformacion('modificar',NuevoEvento);
		}
								);
		function RecolectarDatosGUI(){
			NuevoEvento = {
				id:$('#Eventos_ID').val(),
				title:$('#txtTitulo').val(),
				start:$('#txtFechaInicio').val(),
				color:$('#txtColor').val(),
				descripcion:$('#txtDescripcion').val(),
				textColor:"#FFFFFF",
				end:$('#txtFechaInicio').val()
			};
		}

		function EnviarInformacion(accion,objEvento,modal){
			$.ajax({
				type:'POST',
				url:'../admin/ajax/calendar_guardar_calendario.php?accion='+accion,
				data:objEvento,
				success:function(msg){
					location.reload();
				},
				error:function(){
					alert("Hay un error 1...");
				}
			});
		}

		$('.datepicker').datepicker({
			format: "yyyy-mm-dd",
			maxViewMode: 1,
			language: "es"
		})

		function limpiarFormulario(){
			$('#Eventos_ID').val('');
			$('#txtTitulo').val('');
			$('#txtColor').val('');
			$('#txtDescripcion').val('');
		}

	</script>

<?php } else { ?>
<br>
<br>
<div class="text-center">
	<div style="display: block" class="w-50 py-2 text-center text-dark_gray rounded mx-auto">
		Actualmente no tienes licencia habilitada para configurar el calendario. Dirígete a <a href="
<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a>
		para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".
	</div>
</div>
<?php }
}
include_once('../includes/admin_footer.php');
?>