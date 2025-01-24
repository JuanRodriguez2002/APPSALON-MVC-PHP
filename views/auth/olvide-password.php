<h1 class="nombre-pag">Olvide Password</h1>
<p class="descripcion-pag">Restablece tu password escribiendo tu email</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email">
    </div>

    <input type="submit" class="boton" value="Restablecer">
    
</form>

<div class="acciones">
    <a href="/" class="">¿Ya tienes una cuenta? Inicia sesion AQUI</a>
    <a href="/crear-cuenta" class="">¿Aun no tienes una cuenta? Crea una AQUI</a>
</div>