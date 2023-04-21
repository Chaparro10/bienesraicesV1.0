
<?php
function conectarBd():mysqli
{
    $db = mysqli_connect('localhost', 'root', 'Chaparro07', 'bienesraices_crud');

    if (!$db) {
        echo 'No se pudo conectar';
    } 

    return $db;
}
