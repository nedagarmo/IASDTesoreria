<?php

/**
 * Clase de servidor que loguea al usuario
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');

$dao = new users();
$result = $dao->get_user_login($username, $password);
if ($result != null) {
    while (!$result->EOF) {
        $_SESSION['id'] = $result->fields[0];
        $_SESSION['username'] = $result->fields[1];
        $_SESSION['password'] = $result->fields[2];
        $_SESSION['profile'] = $result->fields[3];
        $_SESSION['church'] = $result->fields[4];

        die("1");
    }
    die("0");
} else {
    die("0");
}
?>
