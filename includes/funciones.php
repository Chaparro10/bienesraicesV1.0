<?php
function incluirTemplate( string $nombre, bool $inicio=false){//DEFINICION DE UNA FUNCION PHP
    include "includes/templates/$nombre.php";
}

function estaAutenticado():bool{
    session_start();
    $auth=$_SESSION['login'];

    if($auth){
        return true;
    }
    return false;
}