<h1 class="nombre-pag">Restablecimiento</h1>
<p class="descripcion-pag">Restablece tu password</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php"
?>

<?php
if ($error) {
    return null;
}
?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <input type="submit" class="boton" value="Guardar Nueva Password">
    
</form>

<div class="acciones">
    <a href="/" class="">¿ya tienes cuenta? Inicia Sesion AQUI</a>
    <a href="/crear-cuenta" class="">¿Aun no tienes cuenta? Obten una AQUI</a>
</div>