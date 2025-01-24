<h1 class="nombre-pag">login</h1>
<p class="descripcion-pag">Inicia sesion con tus datos</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">
    
</form>

<div class="acciones">
    <a href="/crear-cuenta" class="">¿No estas registrado? Crea una cuenta AQUI</a>
    <a href="/olvide" class="">¿Olvidaste tu Password?</a>
</div>