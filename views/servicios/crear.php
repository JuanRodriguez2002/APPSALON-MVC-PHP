<h1 class="nombre-pag">Crear Servicios</h1>
<p class="descripcion-pag">Crea los Servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/formulario.php';
    ?>
    <input type="submit" value="Guardar Servicio" class="boton">

</form>