<!-- Scripts -->
<script type="text/javascript" src="modules/envelope/javascripts/functions.js"></script>

<div id="window_envelope" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Edit.png" />
				Administraci&oacute;n de Sobres
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_envelope" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para la administración de sobres.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre del Donante: <input type="text" name="envelope_donor_name" id="envelope_donor_name" /> <br />
                                                Entre las fechas: <input type="text" name="envelope_date_start" id="envelope_date_start" class="nt_system_datepicker" /> y <input type="text" name="envelope_date_end" id="envelope_date_end" class="nt_system_datepicker" /> <br />
						<button type="submit" id="search_envelope_records">Buscar</button>
					</form>
				</div>

				<div id="envelope_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>