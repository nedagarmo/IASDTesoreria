<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/configuration.consignment.dao.class.php');

$dao = new configuration_consignment();
$jtable_result = array();

switch($action){
	case "create":
                $total_percent = $dao->get_sum_configuration_by_dealing($entrada)->fields['total'];
                if(($total_percent + $porcentaje) <= 100){
                    $result = $dao->insert_configuration_consignment($remesa, $porcentaje, $entrada);
                    if($result){
                            $jtable_result['Result'] = "OK";
                            $jtable_result['Record'] = $dao->get_configuration_consignment($dao->last_insert_id)->fields;
                    } else {
                            $jtable_result['Result'] = "ERROR";
                            $jtable_result['Message'] = "No se guardaron los datos en el sistema.";
                    }
                }else{
                    if($total_percent == 100){
                        $jtable_result['Result'] = "ERROR";
                        $jtable_result['Message'] = "Esta estrada se encuentra totalmente asignada en remesas y rubros.";
                    }else{
                        $jtable_result['Result'] = "ERROR";
                        $jtable_result['Message'] = "A esta entrada le resta por se asignado un ".(100 - $total_percent)."%.  Por favor, asigne a esta remesa una cantidad menor o igual.";
                    }
                }
		break;
	case "update":
		$result = $dao->update_configuration_consignment($id, $remesa, $porcentaje, $entrada);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "delete":
		$result = $dao->delete_configuration_consignment($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
                $result = $dao->get_all_configuration_consignment($consignment, $jtSorting, $jtStartIndex, $jtPageSize);
                $count_rows = $dao->get_all_count_configuration_consignment($consignment)->fields[0];

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
