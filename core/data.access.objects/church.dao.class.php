<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla modulos
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class church {

    private $conn;
    public $last_insert_id;

    function church() {
        $this->conn = new connection();
    }

    function get_all_count_church() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM iglesia');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_church_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM iglesia');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_church($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT i.*, d.id as departamento, p.id as pais, CONCAT(p.nombre, " | ", d.nombre, " | ", m.nombre) as ubicacion, di.asociacion FROM iglesia i INNER JOIN municipio m ON i.municipio = m.id INNER JOIN departamento d ON m.departamento = d.id INNER JOIN pais p ON d.pais = p.id INNER JOIN distrito di ON i.distrito = di.id ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_church($name) {
        $record_set = $this->conn->db->Execute('SELECT id, nombre, direccion, telefono, municipio, distrito FROM iglesia WHERE nombre LIKE ?', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_church($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM iglesia WHERE id = ?', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_church_search($name = "", $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM iglesia WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $name . "%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM iglesia ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_church($name, $address, $telephone, $town, $district) {
        $response = $this->conn->db->Execute('INSERT INTO iglesia(nombre, direccion, telefono, municipio, distrito) VALUES(?, ?, ?, ?, ?) ', array($name, $address, $telephone, $town, $district));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_church($id, $name, $address, $telephone, $town, $district) {
        return $this->conn->db->Execute('UPDATE iglesia SET nombre = ?, direccion = ?, telefono = ?, municipio = ?, distrito = ? WHERE id = ? ', array($name, $address, $telephone, $town, $district, $id));
    }

    function delete_church($id) {
        return $this->conn->db->Execute('DELETE FROM iglesia WHERE id = ?', array($id));
    }

}

?>
