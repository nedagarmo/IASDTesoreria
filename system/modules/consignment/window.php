<!-- Scripts -->
<script type="text/javascript" src="modules/consignment/javascripts/functions.js"></script>

<div id="window_consignment" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Login.png" />
				Administraci&oacute;n de Remesa
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_consignment" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para la administración de la remesa.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Concepto: <input type="text" name="consignment_concept" id="consignment_concept" />
						<button type="submit" id="search_consignment_records">Buscar</button>
					</form>
				</div>

				<div id="consignment_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>