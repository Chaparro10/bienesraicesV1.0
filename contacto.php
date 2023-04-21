<?php
require 'includes/funciones.php';
incluirTemplate('header', $inicio = false);
?>

<main class="contenedor seccion contenido-centrado">
    <h1>contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="">
    </picture>
    <h2>Llene el Formulario de Contacto</h2>
    <form class="formulario">
        <fieldset>
            <legend>Informacion Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre">

            <label for="email">email</label>
            <input type="email" placeholder="E-Mail" id="email">

            <label for="Telefono">Telefono</label>
            <input type="tel" placeholder="Telefono" id="Telefono">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" cols="70" rows="3"></textarea>
        </fieldset>

        <fieldset>
            <legend>Sobre La Propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select name="" id="opciones">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Precio o Presupuesto" id="presupuesto">

        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>


<!--FOOTER-->
<?php
//include './includes/templates/footer.php';
incluirTemplate('footer');
?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>