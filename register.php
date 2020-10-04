<?php
/*
 * Sistema de Tesorería
 * Copyright 2014, Nelson David Garzón Mosquera.  Todos los derechos reservados.
 * Iglesia Adventista del Séptimo Día
 */
?>

<form class="register">
    <h3>Registro</h3>
    <div class="column">
        <div>
            <label>Nombres:</label>
            <input type="text" />
            <span class="error">This is an error</span>
        </div>
        <div>
            <label>Apellidos:</label>
            <input type="text" />
            <span class="error">This is an error</span>
        </div>
        <div>
            <label>Sitio Web:</label>
            <input type="text" value="http://"/>
            <span class="error">This is an error</span>
        </div>
    </div>
    <div class="column">
        <div>
            <label>Usuario:</label>
            <input type="text"/>
            <span class="error">This is an error</span>
        </div>
        <div>
            <label>Correo:</label>
            <input type="text" />
            <span class="error">This is an error</span>
        </div>
        <div>
            <label>Contrase&ntilde;a:</label>
            <input type="password" />
            <span class="error">This is an error</span>
        </div>
    </div>
    <div class="bottom">
        <div class="remember">
            <input type="checkbox" />
            <span>Enviarme actualizaciones</span>
        </div>
        <input type="submit" value="Registrarme!" />
        <a href="index.php" rel="login" class="linkform">Usted tiene una cuenta actualmente? Inicie aqu&iacute;</a>
        <div class="clear"></div>
    </div>
</form>