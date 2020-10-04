<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/entries.dao.class.php');

$dao = new entries();

if (!isset($exclude)) {
    $result = $dao->get_all_entries_list($_SESSION['church']);
} else {
    $result = $dao->get_all_entries_list_exclude($_SESSION['church'], $exclude);
}

if ($result != null) {
    $rows = array();
    $counter = 0;
    $rows[$counter]['DisplayText'] = "--";
    $rows[$counter]['Value'] = '';
    while (!$result->EOF) {
        $counter ++;
        $rows[$counter]['DisplayText'] = $result->fields[1];
        $rows[$counter]['Value'] = $result->fields[0] + 0;
        $result->MoveNext();
    }
    $jtable_result['Result'] = "OK";
    $jtable_result['Options'] = $rows;
} else {
    $jtable_result['Result'] = "ERROR";
    $jtable_result['Message'] = "No se encontraron datos en el sistema.";
}

print json_encode($jtable_result);
?>
