<?php

/* 
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */

?>
<script type="text/javascript" src="javascripts/login.form.functions.js"></script>

<form class="login active">
    <h3>Inicio de Sesi&oacute;n <span class="timer" id="timer"><img src="images/general/loading.gif" border='0' /></span></h3>
    <div id="alertBoxes"> </div>
    <div>
        <label>Usuario:</label>
        <input type="text" name="login_username" id="login_username" />
        <span class="error">This is an error</span>
    </div>
    <div>
        <label>Contrase&ntilde;a: <a href="forgot_password.php" rel="forgot_password" class="forgot linkform">Olvid&oacute; su contrase&ntilde;a?</a></label>
        <input type="password" name="login_userpass" id="login_userpass" />
        <span class="error">This is an error</span>
    </div>
    <div class="bottom">
        <div class="remember"><input type="checkbox" /><span>Recordarme en este equipo</span></div>
        <input type="submit" value="Entrar" id="login_userbttn" />
        <a href="register.php" rel="register" class="linkform">Usted no tiene una cuenta? Registrese aqu&iacute;</a>
        <div class="clear"></div>
    </div>
</form>
