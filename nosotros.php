<?php
require 'includes/funciones.php';
 incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac nisl leo.
                Pellentesque ut urna tellus. Phasellus porta nec neque et interdum.
                Pellentesque hendrerit, lectus tempor sodales egestas, nisi libero tempor augue, vel vehicula nulla
                magna quis libero.
                Cras finibus ut eros eu dapibus. Aliquam nisl sapien, pulvinar sit amet viverra quis, suscipit non
                nisl.
                Phasellus nibh leo, accumsan eget risus et, porta tristique mi.
            </p>
            <p>
                Proin vel imperdiet lacus. Nunc sed justo eleifend, interdum sapien quis, lacinia dolor. Suspendisse
                potenti.
                Etiam fermentum nulla tempus sollicitudin porttitor. Mauris fermentum auctor metus non fermentum.
                Nulla facilisi
            </p>
        </div>
    </div>
</main>


<!--FOOTER-->
<?php
//include './includes/templates/footer.php';
incluirTemplate('footer');
?>


<script src="build/js/bundle.min.js"></script>
</body>

</html>