<h1 class="nombre-pag">Actualizar Servicios</h1>
<p class="descripcion-pag">Modifica los Servicios</p>


<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="" method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/formulario.php';
    ?>
    <input type="submit" value="Actualizar Servicio" class="boton">

</form>