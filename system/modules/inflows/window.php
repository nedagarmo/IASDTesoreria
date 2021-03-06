<!-- Scripts -->
<script type="text/javascript" src="modules/inflows/javascripts/functions.js"></script>

<div id="window_inflows" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Invoice.png" />
				Administraci&oacute;n de Entradas
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_inflows" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para la administración de entradas.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre de la entrada: <input type="text" name="inflow_name" id="inflow_name" />
						<button type="submit" id="search_inflows_records">Buscar</button>
					</form>
				</div>

				<div id="inflows_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>