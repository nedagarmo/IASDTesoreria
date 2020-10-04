<?php

/* 
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */

mysql_connect("localhost","root","");
mysql_select_db("ec_tesoreria");

$sql = "SELECT * FROM modulo";
$exe = mysql_query($sql);

while($row = mysql_fetch_array($exe)){
    $sql_update = "UPDATE modulo SET nombre = '".utf8_encode($row['nombre'])."', descripcion = '".utf8_encode($row['descripcion'])."' WHERE id = ".$row['id'];
    mysql_query($sql_update);
    echo "->".utf8_encode($row['nombre'])."<br />";
}