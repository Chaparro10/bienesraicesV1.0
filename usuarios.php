<?php

//IMPORTAR LA CONEXION
require 'includes/config/database.php';
$db=conectarBd();

//CREAR UN USUARIO
$email="prueba3@sinaloa.com";
$password="12345";

//HASHEAR PASSWORD O ENCRIPTAR
$passwordSecre=password_hash($password,PASSWORD_BCRYPT);
//QUERY PARA INSERTAR EL USUARIO
$query="INSERT INTO usuarios(email,password)VALUES ('$email','$passwordSecre')";
//AGREGARLO A LA BASE DE DATOS

echo $query;
mysqli_query($db,$query);
 ?>