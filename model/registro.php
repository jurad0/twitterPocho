<?php
   
if (isset($_POST)) {
    require_once("../connection/connection.php");
    session_start();
    $con = $pdo;
    

    // Recoger los datos
    $username = isset($_POST['username']) ? $_POST['username'] : false;
    $mail = isset($_POST['mail']) ? trim($_POST['mail']) : false;
    $pass = isset($_POST['password']) ? $_POST['password'] : false;
    $desc = isset($_POST['description']) ? $_POST['description'] : false;

    $arrayErrores = array();
    // Si el nombre de usuario no está vacío y no tiene valor numérico devuelve true
    if (!empty($username) && !is_numeric($username)) {
        $usernameValidado = true;
    } else {
        $usernameValidado = false;
        $arrayErrores["username"] = "El username no es válido";
    }

    // Si el email no está vacío y es válido, devuelve true

    if (!empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $mailValidado = true;
    } else {
        $mailValidado = false;
        $arrayErrores["mail"] = "El mail no es válido";
    }

    // Si la contraseña no está vacía, devuelve true

    if (!empty($pass)) {
        $passValidado = true;
    } else {
        $passValidado = false;
        $arrayErrores["password"] = "El password no es válido";
    }

    // Cuenta número de índices en la array de errores, si el valor es igual a 0 guarda el usuario
    $guardarUsuario = false;
    if (count($arrayErrores) == 0) {
        $guardarUsuario = true;

        // Utiliza el metodo para hashear la contraseña y el siguiente metodo "PASSWORD_BCRYPT" para encriptarlo
        $passSegura = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 4]);
        // Preparamos la consulta para insertar el usuario en la base de datos
        $sql = "INSERT INTO users (username, email, password, description, createDate) VALUES (:username, :email, :password, :description, NOW())";
    
        // Preparamos la consulta y le pasamos los parámetros
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $mail);
        $stmt->bindParam(":password", $passSegura);
        $stmt->bindParam(":description", $desc);

        // Ejecutamos la consulta
        $stmt->execute();

        // Si la consulta se ha ejecutado correctamente, redirigimos al usuario a la página principal
        if ($stmt) {
            $_SESSION["completado"] = "Registro completado";
            header("Location: ../index.php");
        } else {
            $_SESSION["errores"]["general"] = "Fallo en el registro";
            header("Location: ../error/error.php");
        }
    } else {
        $_SESSION["errores"] = $arrayErrores;
        header("Location: ../error/error.php");
    }
}
?>

        
        