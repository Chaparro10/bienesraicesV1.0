<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">

    <?php
    include 'includes/templates/anuncio.php';
    ?>

</main>


<!--FOOTER-->
<?php
//include './includes/templates/footer.php';
incluirTemplate('footer');
?>


<script src="build/js/bundle.min.js"></script>
</body>

</html>

<?php
//CERRRA CONEXION
mysqli_close($db);
?>