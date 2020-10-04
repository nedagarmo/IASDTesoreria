<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/envelope.dao.class.php');

$dao = new envelope();
$jtable_result = array();

switch ($action) {
    case "create":
        $result = $dao->insert_envelope_inflow($entrada, $sobre, $valor);
        if ($result) {
            $jtable_result['Result'] = "OK";
            $jtable_result['Record'] = $dao->get_envelope_inflow($dao->last_insert_id)->fields;
        } else {
            $jtable_result['Result'] = "ERROR";
            $jtable_result['Message'] = "No se guardaron los datos en el sistema.";
        }
        break;
    case "update":
        $result = $dao->update_envelope_inflow($id, $entrada, $sobre, $valor);
        if ($result) {
            $jtable_result['Result'] = "OK";
        } else {
            $jtable_result['Result'] = "ERROR";
            $jtable_result['Message'] = "No se guardaron los datos en el sistema.";
        }
        break;
    case "delete":
        $result = $dao->delete_envelope_inflow($id);
        if ($result) {
            $jtable_result['Result'] = "OK";
        } else {
            $jtable_result['Result'] = "ERROR";
            $jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
        }
        break;
    case "search":
        $count_rows = 0;
        $result = $dao->get_all_inflows_by_envelope($envelope, $jtSorting);
        $count_rows = $dao->get_all_count_inflows_by_envelope($envelope)->fields[0];

        $rows = array();
        if ($result != null) {
            while (!$result->EOF) {
                $rows[] = $result->fields;
                $result->MoveNext();
            }
        }
        $jtable_result['Result'] = "OK";
        $jtable_result['Records'] = $rows;
        $jtable_result['TotalRecordCount'] = $count_rows;

        break;
    default:
        $jtable_result['Result'] = "ERROR";
        $jtable_result['Message'] = "El sistema ha identificado un error en los parametros. Utilice la interfaz desarrollada para usted.";
        break;
}

print json_encode($jtable_result);
?>
