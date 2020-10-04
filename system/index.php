<?php
/*
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */
?>

<?php include_once("../core/secure.classes/session.validation.secure.class.php"); ?>
<?php include_once("gui/desktop.gui.class.php"); ?>
<?php
$gui = new desktop_gui();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge, chrome=1" />
        <meta name="description" content="HI Desktop.  Sistema de tesorería para la iglesia adventista del séptimo día." />

        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <title>.:: IASD | Sistema de Tesorería ::.</title>

        <!--[if lt IE 7]>
                <script>
                        window.top.location = 'ie.html';
                </script>
        <![endif]-->

        <link rel="stylesheet" href="../stylesheets/reset.style.css" />
        <link rel="stylesheet" href="../stylesheets/desktop.style.css" />

        <!--[if lt IE 9]>
                <link rel="stylesheet" href="../stylesheets/ie.style.css" />
        <![endif]-->

        <script src="../libraries/jquery/jquery.js"></script>
        <script src="../libraries/jquery/jquery.ui.js"></script>
        <script type="text/javascript" src="../libraries/jquery/modules/jquery.ui.datepicker-es.js"></script>

        <script src="../javascripts/jquery.desktop.js"></script>

        <!--  JTable Scripts  -->
        <script type="text/javascript" src="../libraries/jtable/jquery.jtable.js"></script>
        <script type="text/javascript" src="../libraries/jtable/extensions/jquery.jtable.toolbarsearch.js"></script>
        <script type="text/javascript" src="../libraries/jtable/localization/jquery.jtable.es.js"></script>

        <link href="../libraries/jtable/themes/lightcolor/gray/jtable.css" rel="stylesheet" type="text/css" />
        <link href="../libraries/jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css" />
        <link href="../libraries/jquery/themes/jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />

        <!--  Preload Images -->
        <script type="text/javascript" src="../libraries/jquery/preloadcssimages.jquery.js"></script>

        <!-- Import CSS file for validation engine (in Head section of HTML) -->
        <link href="../libraries/jvalidation_engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

        <!-- Import Javascript files for validation engine (in Head section of HTML) -->
        <script type="text/javascript" src="../libraries/jvalidation_engine/js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="../libraries/jvalidation_engine/js/languages/jquery.validationEngine-es.js"></script>

        <!-- Import Javascript files for General Functions -->
        <script type="text/javascript" src="../javascripts/general.functions.js"></script>

    </head>
    <body>
        <div class="abs" id="wrapper">
            <div class="abs" id="desktop">

                <!--   Iconos del escritorio   -->
                <?php $gui->generate_icons(); ?>
                <!--   Fin Iconos del escritorio   -->

                <!-- Ventanas -->
                <?php $gui->generate_windows(); ?>
                <!-- Fin Ventanas -->

            </div>

            <!-- Menu -->
            <div class="abs" id="bar_top">
                <span class="float_right" id="clock"></span>
                <ul>
                    <?php $gui->generate_menu(); ?>
                    <li>
                        <a class="menu_trigger" href="#">Sistema</a>
                        <ul class="menu">
                            <li>
                                <a href="#" onclick="system_exit(); return false;" target="_self">Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Fin Menu -->

            <!-- Barra de tareas -->
            <div class="abs" id="bar_bottom">
                <a class="float_left" href="#" id="show_desktop" title="Mostrar Escritorio">
                    <img src="../images/desktop/icons/icon_22_desktop.png" />
                </a>
                <ul id="dock">
                    <?php $gui->generate_taskbar(); ?>
                </ul>
                <a class="float_right" href="#" title="Nelson D. Garz&oacute;n M. &copy; Todos los derechos reservados">
                    <img src="../favicon.ico" />
                </a>
            </div>
            <!-- Fin Barra de tareas -->


        </div>
    </body>
</html>