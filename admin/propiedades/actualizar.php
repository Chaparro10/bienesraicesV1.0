<?php
require '../../includes/funciones.php';
$auth=estaAutenticado();

if(!$auth){
    header('Location: /');
}

//VALIDAR URL POR ID VALIDO
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT); //FILTRA PARA QUE SEA DE TIPO INT
if (!$id) {
    header('location: /admin');
}

//CONECTAR BD
require '../../includes/config/database.php';
$db = conectarBd();


//CONSULTA PARA OBTENER LAS PROPIEDADES
$consultaPropiedad = "SELECT * FROM propiedades WHERE id={$id}";
$resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
$resultadoPro = mysqli_fetch_assoc($resultadoPropiedad);

echo "<pre>";
var_dump($resultadoPro);
echo "</pre>";

//CONSULTA PARA OBTENER LOS VENDEDORES
$consulta = "SELECT * FROM vendedores ";
$resultado = mysqli_query($db, $consulta);

//ARREGLO CON MENSAJES DE ERRORES:alamacena los tipos de errores
$errores = [];

//Declarar Variables vacias - y las rellenamos con el GET
$titulo = $resultadoPro['titulo'];
$precio = $resultadoPro['precio'];
$descripcion = $resultadoPro['descripcion'];
$habitaciones = $resultadoPro['habitaciones'];
$wc = $resultadoPro['wc'];
$estacionamiento = $resultadoPro['estacionamiento'];
$vendedor = $resultadoPro['vendedor'];
$imagenPropiedaa = $resultadoPro['imagen'];

//EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIE EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitacion'];
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


    //VALIDACION POR TAMALÑO DE IMAGEN[1mb]
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen supera el tamaño permitido";
    }

    //REVISAR QUE EL ARRAY DE ERRORES ESTE VACIO
    if (empty($errores)) {

        //CREAR CARPETA
        $carpetaImagenes = '../../imagenessubidas/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }


        $nombreImagen = '';
        //****************************SUBIR ARCHIVOS********************
        if ($imagen['name']) {
            //ELIMINAR LA IMAGEN PREVIA AL ACTUALIZAR
            unlink($carpetaImagenes . $imagenPropiedaa['imagen']);

            //NOMBRE DE LAS IMAGENES UNICAS
            $nombreImagen = md5(uniqid(rand(), true));
            //SUBIR LA IMAGEN
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");
        } else {
            $nombreImagen = $imagenPropiedaa['imagen']; //SI NO HAY IMAGEN NUEVA SE DEJA LA MISMA
        }




        //INSERTAR EN LA BD
        $query = "UPDATE propiedades set titulo='{$titulo}',precio=$precio,imagen=$nombreImagen,descripcion='{$descripcion}',habitaciones=$habitaciones,
        wc=$wc,estacionamiento=$estacionamiento,vendedores_id=$vendedor WHERE id={$id}";
        echo $query;

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //echo "Insertado Correctamente";
            //Redireccionar al usuario
            header('Location:/admin?resultado=2');
        }
    }
}




include '../../includes/templates/header.php';
//require '../../includes/funciones.php';NO jalo
//incluirTemplate('header');


?>

<main class="contenedor seccion">
    <h1>ACTUALIZAR</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <!--MOSTRANDO LOS ERRORES EN PANTALLA-->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <!--FORMULARIO-->
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="titulo propiedad" value="<?php echo $titulo ?>"><!---php para dejar valores de default-->

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg , image/png" name="imagen">

            <img class="imagen-small" src="/imagenessubidas/<?php echo $imagenPropiedaa; ?>" alt="">


            <label for="descripcion">Descripcion</label>
            <input type="textarea" value="<?php echo $descripcion ?>" name="descripcion" id="descripcion">


        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>
            <label for="habitacion">Habitacion</label>
            <input type="number" id="habitacion" name="habitacion" placeholder="Ej.2" min="1" max="5" value="<?php echo $habitaciones ?>"><!---php para dejar valores de default-->

            <label for="wc">WC</label>
            <input type="number" id="wc" name="wc" placeholder="Ej.2" min="1" max="5" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.3" min="1" max="5" value="<?php echo $estacionamiento ?>">

        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="id=0">---seleccione alguno---</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?><!---Recorrer los valores del arreglo de la BD--->
                    <option <?php echo $vendedor === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"] . "" . $vendedor["apellido"]; ?></option><!--Obtenemos el nombre y apellido del arreglo de la BD-->
                <?php endwhile; ?><!--FIN WHILE-->
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
include '../../includes/templates/footer.php';
?>