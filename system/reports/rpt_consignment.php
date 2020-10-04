<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Lista de Usuarios del Sistema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="../../stylesheets/report.style.css" />
<script type="text/javascript" src="../../javascripts/report.functions.js"></script>
</head>

<body>
	<div id="tools">
		<input type="button" value="Imprimir" onclick="print_document(); return false;" class="tools-button" />
		<input type="button" value="Exportar" onclick="export_document(); return false;" class="tools-button" />
	</div>
	<div class="wrapper">
        <h1><img src="../../images/general/logo.gif" width="50" title="Logo" /> | Sistema de Tesorer&iacute;a <span>SITIAD</span></h1>
        <h2>La soluci&oacute;n para la tesorer&iacute;a de la <span>Iglesia Adventista del S&eacute;ptimo D&iacute;a</span></h2>
		<?php
			include_once(dirname(__FILE__) . '/../../libraries/php_report_generator/phpReportGen.php');
			$prg = new phpReportGenerator();
		    $prg->width = "100%";
			$prg->cellpad = "0";
			$prg->cellspace = "0";
			$prg->border = "0";
			$prg->header_color = "#e8e8e8";
			$prg->header_textcolor="#000000";
			$prg->body_alignment = "left";
			$prg->body_color = "#CCCCCC";
			$prg->body_textcolor = "#800022";
			$prg->surrounded = '0';

			mysql_connect("localhost","root","");
			mysql_select_db("ec_tesoreria");
			$res = mysql_query("select ra.* from remesa_acumulado ra inner join remesa r on ra.remesa = r.id left join iglesia i on r.iglesia = i.id where r.iglesia = ".$_SESSION['church']." and ra.enviado = 0 ");
			$prg->mysql_resource = $res;
			
			$prg->title = "Lista de Usuarios del Sistema";
			
			echo "<div class='data' id='data'>";
			$prg->generateReport();
			echo "</div>";
		?>
	<div>
</body>
</html>
