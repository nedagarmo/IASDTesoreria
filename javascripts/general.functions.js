/* 
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */

jQuery(document).ready(function() {
    jQuery.preloadCssImages();
    var nt_system_datenow = new Date();
    $(".nt_system_datepicker").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: "1950:" + nt_system_datenow.getFullYear()}, $.datepicker.regional['es']);
});
