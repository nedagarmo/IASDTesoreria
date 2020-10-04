<!-- Scripts -->
<script type="text/javascript" src="modules/entries/javascripts/functions.js"></script>

<div id="window_entries" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Delete.png" />
				Administraci&oacute;n de Rubros
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_entries" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para la administración de rubros.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre del Rubro: <input type="text" name="entries_name" id="entries_name" />
						<button type="submit" id="search_entries_records">Buscar</button>
					</form>
				</div>

				<div id="entries_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>