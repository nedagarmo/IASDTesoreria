<!-- Scripts -->
<script type="text/javascript" src="modules/church/javascripts/functions.js"></script>

<div id="window_church" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Database.png" />
				Administraci&oacute;n de Iglesias
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_church" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para la administración de iglesias.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre de la Iglesia: <input type="text" name="church_name" id="church_name" />
						<button type="submit" id="search_church_records">Buscar</button>
					</form>
				</div>

				<div id="church_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>