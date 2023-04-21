<?php

require '../../includes/funciones.php';
$auth=estaAutenticado();

if(!$auth){
    header('Location: /');
}

//CONECTAR BD
require '../../includes/config/database.php';
$db = conectarBd();

//CONSULTA PARA OBTENER LOS VENDEDORES
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//ARREGLO CON MENSAJES DE ERRORES:alamacena los tipos de errores
$errores = [];

//Declarar Variables vacias
$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedor = "";

//EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIE EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    // echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedor = $_POST['vendedor'];
    $creado = date('Y-m-d');

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }
    if (!$descripcion) {
        $errores[] = "Debes añadir una descripcion";
    }
    if (!$wc) {
        $errores[] = "SELECCIONA AL MENOS UNO";
    }
    if (!$imagen['name']) {
        $errores[] = "La imagen es obligatoria";
    }

    //VALIDACION POR TAMALÑO DE IMAGEN[1mb]
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen supera el tamaño permitido";
    }

    //REVISAR QUE EL ARRAY DE ERRORES ESTE VACIO
    if (empty($errores)) {

        /****************************SUBIR ARCHIVOS******************** */
        //CREAR CARPETA
        $carpetaImagenes = '../../imagenessubidas/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        //NOMBRE DE LAS IMAGENES UNICAS
        $nombreImagen = md5(uniqid(rand(), true));
        //SUBIR LA IMAGEN
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");


        //****************INSERTAR EN LA BD*************
        $query = "INSERT INTO propiedades(titulo,precio,imagen,descripcion,habitaciones,wc,creado,estacionamiento,vendedores_id)VALUES(
        '$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$creado','$estacionamiento','$vendedor')";

        echo $query;
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //echo "Insertado Correctamente";
            //Redireccionar al usuario
            header('Location:/admin?resultado=1');
        }
    }
}




include '../../includes/templates/header.php';
//require '../../includes/funciones.php';NO jalo
 //incluirTemplate('header');


?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <!--MOSTRANDO LOS ERRORES EN PANTALLA-->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <!--*********************FORMULARIO************************-->
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="titulo propiedad" value="<?php echo $titulo ?>"><!---php para dejar valores de default-->

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg , image/png" name="imagen" value="<?php echo $imagen ?>">


            <label for="descripcion">Descripcion</label>
            <input type="textarea" value="<?php echo $descripcion ?>" name="descripcion" id="descripcion">

        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>
            <label for="habitaciones">Habitacion</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej.2" min="1" max="5" value="<?php echo $habitaciones ?>"><!---php para dejar valores de default-->

            <label for="wc">WC</label>
            <input type="number" id="wc" name="wc" placeholder="Ej.2" min="1" max="5" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.3" min="1" max="5" value="<?php echo $estacionamiento ?>">

        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">---seleccione alguno---</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?><!---Recorrer los valores del arreglo de la BD--->
                    <option value="<?php echo $vendedor === $vendedor['id'] ? 'selected' : ''; ?>
                    <?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"]; ?></option><!--Obtenemos el nombre y apellido del arreglo de la BD-->
                <?php endwhile; ?><!--FIN WHILE-->
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
include '../../includes/templates/footer.php';
?>