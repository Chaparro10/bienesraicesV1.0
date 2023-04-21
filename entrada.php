<?php
require 'includes/funciones.php';
 incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta</h1>

    <picture>
        <source srcset="build/img/destacada2.webp" type="imagen/webp">
        <source srcset="build/img/destacada2.jpg" type="imagen/jpeg">
        <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen Propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">3,000,000</p>
    </div>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Morbi quam turpis, aliquam a auctor at, convallis ac lacus.
        Suspendisse sed justo eget justo hendrerit facilisis blandit id tortor.
        Sed ac lacus et nisi posuere vulputate. Nam vel porta eros.</p>

    <p>
        Nunc scelerisque cursus massa non pretium.
        Vivamus ultrices neque non felis fermentum, eu consectetur magna volutpat.
        Mauris fringilla, massa ac vulputate sagittis, tellus nunc aliquet ante, sit amet gravida tellus tellus ut mi.
        Proin eu nulla sit amet magna dictum tincidunt.
    </p>
</main>


<!--FOOTER-->
<?php
//include './includes/templates/footer.php';
incluirTemplate('footer');
?>


<script src="build/js/bundle.min.js"></script>
</body>

</html>