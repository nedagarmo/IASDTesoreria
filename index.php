<?php
/*
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>.:: IASD | Sistema de Tesorería ::.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Tesorería de la Iglesia Adventista del Séptimo Día" />
        <meta name="keywords" content="tesorería, tesoreria, iasd, iglesia, adventista, septimo, dia"/>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="stylesheets/general.style.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/login.style.css" />

        <script type="text/javascript" src="libraries/jquery/jquery.js"></script>
        <script type="text/javascript" src="libraries/jquery/jquery.ui.js"></script>
        
        <!-- Import Javascript files for Tooltip JQuery -->
        <script type="text/javascript" src="../libraries/jquery/modules/jquery.tooltip.js"></script>
        
        <script type="text/javascript" src="libraries/jquery/preloadcssimages.jquery.js"></script>

        <!-- Import Javascript files for General Functions -->
        <script type="text/javascript" src="../javascripts/general.functions.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <h1><img src="images/general/logo.gif" width="100" title="Logo" /> | Sistema de Tesorer&iacute;a <span>SITIAD</span></h1>
            <h2>La soluci&oacute;n para la tesorer&iacute;a de la <span>Iglesia Adventista del S&eacute;ptimo D&iacute;a</span></h2>
            <div class="content">
                <div id="form_wrapper" class="form_wrapper">
                    <?php
                    if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
                        echo '<div class="box-success session_on">
                                    Usted ya había iniciado sesi&oacute;n &#124; Est&aacute; siendo redireccionado... <span class="timer" id="timer" style="margin-left: 10px;"></span>
                              </div>';
                        echo "<script> $('#timer').fadeIn(300); setTimeout(function(){ location.href = 'system'},2500); </script>";
                    } else {
                        include_once 'register.php';
                        include_once 'login.php';
                        include_once 'forgot_password.php';
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <a class="back" href="http://www.elcaminoadventista.org">Regresar al Portal El Camino</a>
        </div>


        <!-- The JavaScript -->
        <script type="text/javascript">
            $(function() {
                //the form wrapper (includes all forms)
                var $form_wrapper = $('#form_wrapper'),
                        //the current form is the one with class active
                        $currentForm = $form_wrapper.children('form.active'),
                        //the change form links
                        $linkform = $form_wrapper.find('.linkform');

                //get width and height of each form and store them for later						
                $form_wrapper.children('form').each(function(i) {
                    var $theForm = $(this);
                    //solve the inline display none problem when using fadeIn fadeOut
                    if (!$theForm.hasClass('active'))
                        $theForm.hide();
                    $theForm.data({
                        width: $theForm.width(),
                        height: $theForm.height()
                    });
                });

                //set width and height of wrapper (same of current form)
                setWrapperWidth();

                /*
                 clicking a link (change form event) in the form
                 makes the current form hide.
                 The wrapper animates its width and height to the 
                 width and height of the new current form.
                 After the animation, the new form is shown
                 */
                $linkform.bind('click', function(e) {
                    var $link = $(this);
                    var target = $link.attr('rel');
                    $currentForm.fadeOut(400, function() {
                        //remove class active from current form
                        $currentForm.removeClass('active');
                        //new current form
                        $currentForm = $form_wrapper.children('form.' + target);
                        //animate the wrapper
                        $form_wrapper.stop()
                                .animate({
                                    width: $currentForm.data('width') + 'px',
                                    height: $currentForm.data('height') + 'px'
                                }, 500, function() {
                                    //new form gets class active
                                    $currentForm.addClass('active');
                                    //show the new form
                                    $currentForm.fadeIn(400);
                                });
                    });
                    e.preventDefault();
                });

                function setWrapperWidth() {
                    $form_wrapper.css({
                        width: $currentForm.data('width') + 'px',
                        height: $currentForm.data('height') + 'px'
                    });
                }

                /*
                 for the demo we disabled the submit buttons
                 if you submit the form, you need to check the 
                 which form was submited, and give the class active 
                 to the form you want to show
                 */
                $form_wrapper.find('input[type="submit"]')
                        .click(function(e) {
                            e.preventDefault();
                        });
            });
        </script>
    </body>
</html>