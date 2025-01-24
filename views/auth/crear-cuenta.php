<h1 class="nombre-pag">Registrate</h1>
<p class="descripcion-pag">Registrate con tus datos</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="Nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo s($usuario->nombre)?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" placeholder="Tu Apellido" name="apellido" value="<?php echo s($usuario->apellido)?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" placeholder="Tu Telefono" name="telefono" value="<?php echo s($usuario->telefono)?>">
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($usuario->email)?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <input type="submit" class="boton" value="Crear Cuenta">
    
</form>

<div class="acciones">
    <a href="/" class="">¿Ya tienes una cuenta? inicia sesion AQUI</a>
    <a href="/olvide" class="">¿Olvidaste tu Password?</a>
</div>