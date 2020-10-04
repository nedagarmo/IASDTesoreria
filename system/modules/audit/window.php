<!-- Scripts -->
<script type="text/javascript" src="modules/audit/javascripts/functions.js"></script>

<div id="window_audit" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/64/Settings.png" />
				Pantalla de Auditor&iacute;a
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_audit" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				M&oacute;dulo para auditor&iacute;a del sistema.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Iglesia: <input type="text" name="church_name" id="church_name" />
						<button type="submit" id="search_audit_records">Buscar</button>
					</form>
				</div>

				<div id="audit_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>