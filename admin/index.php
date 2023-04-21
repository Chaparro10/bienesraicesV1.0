<?php
require '../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /');
}

//CONECTAR BD(IMPORTA LA CONEXION)
require '../includes/config/database.php';
$db = conectarBd();

//ESCRIBIR EL QUERY PARA TRAE PROPIEDADES(GET)
$query = "SELECT * FROM propiedades";

//CONSULTAR LA BD 
$resultadoConsulta = mysqli_query($db, $query);

//MUESTRA MENSAJE
$resultado = $_GET['resultado'] ?? null; //para el menssaje de creado exitosamente o Actualizado o Eliminado

//ELIMINAR REGISTROS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {  //SI ID ES VALIDO --->ELIMINAR EN LA BD

        //ELIMINAR EL ARCHIVO DE IMAGEN TAMBIEN
        $query = "SELECT imagen FROM propiedades WHERE id={$id}";
        $resultadoEliminar=(mysqli_query($db, $query));
        unlink('../imagenes/' . $propiedad['imagen']);

        //ELIMINAR PROPIEDADES
        $query = "DELETE FROM propiedades WHERE id={$id}";
        $resultadoEliminar = mysqli_query($db, $query);

    
        if ($resultadoEliminar) { //SI EL RESULTADO ES CORRECTO RECARGA ADMIN
            header('location: /admin?resultado=3');
        }
    }
}

//INCLUYE EL TEMPLATE
include '../includes/templates/header.php';
?>

<main class="contenedor seccion">
    <h1>Administrador</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Exitosamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Exitosamente</p>
    <?php elseif (intval($resultadoEliminar) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado Exitosamente</p>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>TITULO</th>
                <th>IMAGEN</th>
                <th>PRECIO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?><!--WHILE PARA RECORRER LA BD Y OBTENER LOS DIFERENTES REGISTROS-->
                <tr><!--MOSTRAR LOS RESULTADOS--->

                    <td> <?php echo $propiedad['id']; ?></td>
                    <td> <?php echo $propiedad['titulo']; ?></td>
                    <td><img src="../imagenessubidas/<?php $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td> $<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-azul-block">ACTUALIZAR</a>

                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value=" <?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>




<?php
//CERRAR CONEXION DB
mysqli_close($db);
include '../includes/templates/footer.php';
?>