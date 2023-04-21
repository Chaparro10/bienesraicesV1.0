<?php
require 'includes/funciones.php';
incluirTemplate('header', $inicio = true);
?>

<main class="contenedor seccion">
    <h1>Mas Sobre Nosostros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono Seguridad">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat dapibus elementum.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono Precio">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat dapibus elementum.</p>
        </div>


        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono Tiempo">
            <h3>A Tiempo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat dapibus elementum.</p>
        </div>

    </div>
</main>


<section class="seccion contenedor">
    <h2>Casas Y Depas en Venta</h2>
        
    <?php
    include 'includes/templates/anuncio.php';
    ?>

    <div class="alinear-derecha">
        <a href="anuncios.php" class="  boton-verde">
            Ver Todas
        </a>
    </div>

</section>

<!--Contacto-->
<section class="imagen-contacto">
    <h2> Encuentra la Casa de tus Sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondra en contatco a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo-inline">Contactanos</a>
</section>


<!--Blog-->
<div class="contenedor seccion seccion-inferior">
    <section class="blog ">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada a blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>31/4/2023</span> Por :<span>EL Jubilado</span></p>

                    <p>Consejos para construir una terraza en tu casa con los mejores materiales y ahorrando dinero!
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada a blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Guia para la decoracion de tu casa</h4>
                    <p>Escrito el: <span>31/4/2023</span> Por :<span>EL Jubilado</span></p>

                    <p>Consejos para construir una terraza en tu casa con los mejores materiales y ahorrando dinero!
                    </p>
                </a>
            </div>
        </article>
    </section>

    <!--Testimoniales-->
    <section class="Testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                Glossier tiene una gran marca: su diseño, redes sociales y páginas de destino son consistentes y
                atractivas.
            </blockquote>
            <p>-KMLCH</p>
        </div>
    </section>
</div><!--BLOG -TESTIMONIALES-->

<!--FOOTER-->
<?php
incluirTemplate('footer');
//include './includes/templates/footer.php';
?>


<script src="build/js/bundle.min.js"></script>
</body>

</html>