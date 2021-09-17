<?php

// configurar datos de acceso a la bd


$dbuser="jherry";
$userpass="123456";

/* pasar toda la cadena de conexion-> inicia con el tipo de bd ->sqlsrv
luego el servidor ->Server=LAPTOP-T2N9M2M6 . despues el nombre de la base de datos */



try{
    //crear conexion a sql
    $conn = new PDO("sqlsrv:Server=localhost;Database=notas_php",$dbuser,$userpass);

    //mostrar mensaje si la conexion es correcta

    if($conn){
        /*   */
    }
}
catch(\PDOException $e){
    //si hubiera error
    echo $e->getMessage();
}
