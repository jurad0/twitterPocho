<?php 
    require_once "..\connection\connection.php";
    session_start();
    $con = $pdo;
    
    //Comprueba si el mail está seteado, y a continuación le quita los espacios a los lados y guarda el email y la contraseña en los arrays
    if (isset($_POST["email"]) && isset($_POST["email"])) {
        $email = trim($_POST["email"]);
        $pass = $_POST["pass"];
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $pdo->query($sql);

    
    if ($result && $result->rowCount() == 1) {
        $usuario = $result->fetch(PDO::FETCH_ASSOC);
    
        //Verifica la contraseña con el metodo "password_verify" y si es valido, te redirije hasta la pagina de welcome
        if (password_verify($pass, $usuario["password"])) {
            $_SESSION["usuario"] = $usuario;
            header("Location: ../index.php");
        } else {
            $_SESSION["error_login"] = "Login incorrecto";
            header("Location:../index.php");
        }
    } else {
        $_SESSION["error_login"] = "Login iiincorrecto";
        header("Location: ../index.php");
    }
    

?> 