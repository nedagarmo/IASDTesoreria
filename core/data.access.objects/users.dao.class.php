<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla usuarios
 *
 * @author Nelson D. Garzón M.
 */
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class users {

    private $conn;
    public $result_count;

    function users() {
        $this->conn = new connection();
    }

    function get_all_count_users() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM usuario');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_users($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT u.*, CONCAT(i.nombre, " |", i.id, "|") as iglesia_nombre FROM usuario u INNER JOIN iglesia i ON u.iglesia = i.id ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_users($username) {
        $record_set = $this->conn->db->Execute('SELECT id, usuario, clave, perfil, iglesia FROM usuario WHERE usuario LIKE ?', array('%' . $username . '%'));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_user($username) {
        $record_set = $this->conn->db->Execute('SELECT * FROM usuario WHERE usuario LIKE ?', array($username));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_user_search($name = "", $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT u.*, CONCAT(i.nombre, " |", i.id, "|") as iglesia_nombre FROM usuario u INNER JOIN iglesia i ON u.iglesia = i.id WHERE usuario LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $name . "%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT u.*, CONCAT(i.nombre, " |", i.id, "|") as iglesia_nombre FROM usuario u INNER JOIN iglesia i ON u.iglesia = i.id ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function get_user_login($username, $password) {
        $record_set = $this->conn->db->Execute("SELECT id, usuario, clave, perfil, iglesia FROM usuario WHERE usuario = ? AND clave = ? ", array($username, $password));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_user_login_simple($username) {
        $record_set = $this->conn->db->Execute("SELECT id, usuario, clave, perfil, iglesia FROM usuario WHERE usuario = ? ", array($username));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_user($username, $password, $profile, $church) {
        $response = $this->conn->db->Execute('INSERT INTO usuario(usuario, clave, perfil, iglesia) VALUES(?,?,?,?) ', array($username, $password, $profile, $church));
        return $response;
    }

    function update_user($id, $username, $password, $profile, $church) {
        return $this->conn->db->Execute('UPDATE usuario SET usuario = ?, clave = ?, perfil = ?, iglesia = ? WHERE id = ? ', array($username, $password, $profile, $church, $id));
    }

    function delete_user($id) {
        return $this->conn->db->Execute('DELETE FROM usuario WHERE id = ?', array($id));
    }

    function change_password($id, $password) {
        return $this->conn->db->Execute('UPDATE usuario SET clave = ? WHERE id = ?', array($password, $id));
    }

}

?>
