<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/church.dao.class.php');

$dao = new church();
$result = $dao->search_church($term);

if ($result != null) {
    $rows = array();
    $counter = 0;
    while (!$result->EOF) {
        $rows[] = $result->fields[1] . " - |" . $result->fields[0] . "|";
        $counter ++;
        $result->MoveNext();
    }
}

print json_encode($rows);
?>
