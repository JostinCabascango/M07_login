
<?php

    // Constantes para BBDD

    define("DB_HOST","localhost");
    define("DB_NAME","users");
    define("DB_USER","root");
    define("DB_PSW", "");
    // Definir el puerto diferente a 3306
    define("DB_PORT",3306);

    // Conexion a la BBDD
    $connect = mysqli_connect(DB_HOST,DB_USER,DB_PSW,DB_NAME,DB_PORT);

    // Comprobacion de la conexion

    if(!$connect){
        echo "Error de connexió: " . mysqli_connect_error();
    }
    else{

        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $password = $_POST["password"];
        $rol = $_POST["rol"];
        if (isset ($_POST["active"])){
            $active = 1;
        }
        else {
            $active = 0;
        }
        $query = "INSERT INTO user (user_id,name,surname,password,rol,active)
        VALUES('$user_id','$name','$surname','$password','$rol','$active')";

        if (mysqli_query($connect,$query))
        {
        header('Location: mostrar.php');
}
else{
    echo "Error al insertar datos " . mysqli_error($connect);
    }
}
    mysqli_close($connect);
?>