<?php

/*
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */

@session_start();
include_once(dirname(__FILE__) . '/../../core/data.access.objects/access.dao.class.php');

class desktop_gui {

    private $dao;
    
    function desktop_gui() {
        $this->dao = new access();
    }
    
    function generate_icons() {
        $result = $this->dao->search_access_favorite($_SESSION['profile']);
        $y = 20;
        $x = 20;
        $icons_in_column = 7;
        $icons_counter = 0;
        while (!$result->EOF) {
            $icons_counter ++;
            echo '<a class="abs icon" style="left:'.$x.'px;top:'.$y.'px;" href="#icon_dock_'.$result->fields['identificador'].'">';
            echo '<img src="../images/desktop/icons/64/'.$result->fields['icono'].'" /> ';
            echo $result->fields['nombre'];
            echo '</a>';
            $y += 80;
            
            if($icons_counter == $icons_in_column){
                $icons_counter = 0;
                $x += 110;
                $y = 20;
            }
            
            $result->MoveNext();
        }
    }
    
    function generate_menu() {
        $result = $this->dao->search_access_category($_SESSION['profile']);
        while (!$result->EOF) {
            echo '<li>';
            echo '<a class="menu_trigger" href="#">'.$result->fields['nombre'].'</a>';
            echo '<ul class="menu">';
            $result_links = $this->dao->search_access_module_for_category($_SESSION['profile'], $result->fields['id']);
            while (!$result_links->EOF) {
                echo '<li>';
		echo '<a href="#icon_dock_'.$result_links->fields['identificador'].'" class="lnk_window">'.$result_links->fields['nombre'].'</a>';
		echo '</li>';
                $result_links->MoveNext();
            }
            echo '</ul>';
            echo '</li>';
            $result->MoveNext();
        }
    }
    
    function generate_taskbar() {
        $result = $this->dao->search_access($_SESSION['profile']);
        while (!$result->EOF) {
            echo '<li id="icon_dock_'.$result->fields['identificador'].'">';
            echo '<a href="#window_'.$result->fields['identificador'].'">';
            echo '<img src="../images/desktop/icons/32/'.$result->fields['icono'].'" />';
            echo $result->fields['nombre'];
            echo '</a>';
            echo '</li>';
            $result->MoveNext();
        }
    }
    
    function generate_windows() {
        $result = $this->dao->search_access($_SESSION['profile']);
        while (!$result->EOF) {
            include_once('modules/'.$result->fields['ruta'].'/window.php');
            $result->MoveNext();
        }
    }

}

?>