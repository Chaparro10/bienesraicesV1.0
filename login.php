<?php
//CONECTAR BD(IMPORTA LA CONEXION)
require 'includes/config/database.php';
$db = conectarBd();
//ARREGLO DE ERRORES
$errores = [];
//AUTENTICAR EL USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);


    if (!$email) {
        $errores[]="INGRESA EL EMAIL";
    }
    if (!$password) {
        $errores[]="INGRESA EL PASSWORD";
    }

    if(empty($errores)){//Empty determina si esta vacio
        //REVISAR SI EL USUARIO EXISTE
        $query="SELECT * FROM usuarios WHERE email='$email'";
        $resultado=mysqli_query($db,$query);

        var_dump($resultado);

        if($resultado -> num_rows){//Objeto utilizamos sintaxis ->
            //REVISAR SI EL PASSWORD ES CORRECTO    

            $usuario=mysqli_fetch_assoc($resultado);
            //REVISAR SI ES CORRECTO O NO
            $auth=password_verify($password,$usuario['password']);//LE PASAMOS EL PASSWORD INGRESADO Y EL DE LA DB DEVUELVE TRUE O FALSE
            if($auth){
                //EL USUARIO ESTA AUTENTICADO
                session_start();
                //LLENAR EL ARREGLO DE LA SESION
                    $_SESSION['usuario']=$usuario['email'];
                    $_SESSION['login']=true;

                    header('Location:/admin');
            }else{
                $errores[]="PASSWORD INCORRECTA";
            }
        }else{
            $errores[]="El usuario no existe";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN BR</title>

    <link rel="stylesheet" href="/build/css/app.css">
</head>


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
    <!--MOSTRAR ERRORES-->
    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>



    <!--FORMULARIO-->
    <form action="" method="post" class="formulario">
        <fieldset>
            <legend>Email y password</legend>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="tu email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="tu password" id="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>

</html>