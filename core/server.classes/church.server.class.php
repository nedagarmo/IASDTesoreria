<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/church.dao.class.php');

$dao = new church();
$jtable_result = array();

switch($action){
	case "create":
		$result = $dao->insert_church($nombre, $direccion, $telefono, $municipio, $distrito);
		if($result){
			$jtable_result['Result'] = "OK";
			$jtable_result['Record'] = $dao->get_church($dao->last_insert_id)->fields;
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "update":
		$result = $dao->update_church($id, $nombre, $direccion, $telefono, $municipio, $distrito);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "delete":
		$result = $dao->delete_church($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
		$count_rows = 0;
		if(empty($name)){
			$result = $dao->get_all_church($jtSorting, $jtStartIndex, $jtPageSize);
			$count_rows = $dao->get_all_count_church()->fields[0];
		}else{
			$result = $dao->get_church_search($name, $jtSorting, $jtStartIndex, $jtPageSize);
			$count_rows = $dao->result_count;
		}

		if($result != null){
			$rows = array();
			while (!$result->EOF){				
				$rows[] = $result->fields;
				$result->MoveNext();
			}
			$jtable_result['Result'] = "OK";
			$jtable_result['Records'] = $rows;
			$jtable_result['TotalRecordCount'] = $count_rows;
		}else{
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se encontraron datos en el sistema.";
		}
		break;
	default:
		$jtable_result['Result'] = "ERROR";
		$jtable_result['Message'] = "El sistema ha identificado un error en los parametros. Utilice la interfaz desarrollada para usted.";
		break;
}

print json_encode($jtable_result);

?>
