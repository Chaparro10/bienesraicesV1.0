<?php

$id = $_GET['id']; //OBTENER EL ID
$id = filter_var($id, FILTER_VALIDATE_INT); //VALIDAR QUE SEA ENTERO

if (!$id) { //SI NO ES EL ID
    header('Location:/index.php');
}

//CONECTAR BD(IMPORTA LA CONEXION)
require  'includes/config/database.php';
$db = conectarBd();

//CONSULTAR
$query = "SELECT * FROM propiedades WHERE id =$id";

//OBTENER RESULTADOS
$resultado = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultado);


require 'includes/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h2><?php echo $propiedad['titulo']; ?></h2>

    <img loading="lazy" src="/src/img/anuncio1.jpg/?php echo $propiedad['imagen']; ?>" alt="anuncio">

    <div class="resumen-propiedad">
        <p><?php echo $propiedad['descripcion'] ?></p>
        <p class="precio"><?php echo $propiedad['precio'] ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc'] ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono parking">
                <p><?php echo $propiedad['estacionamiento'] ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono icono_dormitorio">
                <p><?php echo $propiedad['habitaciones'] ?></p>
            </li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sagittis est eget sapien finibus, non hendrerit magna vehicula. Vestibulum vestibulum viverra urna eget sagittis. Aliquam velit erat, sagittis id ultrices nec, porta non justo.</p>
        <p>Mauris enim arcu, dictum ut diam non, placerat venenatis leo. Pellentesque rutrum elit ornare, consequat neque tristique, dictum magna. Nulla sit amet faucibus elit. </p>
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

<?php
//CERRRA CONEXION
mysqli_close($db);
?>