<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/donors.dao.class.php');

$dao = new donors();
$result = $dao->search_donor($term, $_SESSION['church']);

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
