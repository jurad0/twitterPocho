<?php
require_once("connection/connection.php");
session_start();
$con = $pdo;

if (isset($_POST['botonlogin'])) {
    header("Location: ../login.php");
}

// Check if the user is logged in
if (isset($_SESSION["usuario"])) {
    // User is logged in, display the cards
    $sql = "SELECT * FROM users ";
    $result = $pdo->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Añado la fuente Roboto -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Bootstrap -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
            defer></script>
        <link rel="stylesheet" href="css\style.css">
    </head>

    <body>
        <header class="navbar navbar-expand-lg bg-body-tertiary rounded" data-bs-theme="dark">
            <div class="container-fluid">
                <a href="#">JURAGRAM</a>
                <a href="/model/siguiendo.php">Siguiendo</a>
                <a href="/model/logout.php">
                    <button class="btn btn-danger rounded-pill px-3">Logout</button>
                </a>
            </div>

        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="model/profiles.php?id=<?= $_SESSION['usuario']['id'] ?>">
                                    <?= $_SESSION['usuario']['username']; ?>
                                </a>
                            </h5>
                            <p class="card-text">
                                <?= $_SESSION['usuario']['description']; ?>
                            </p>
                            <p class="card-text">
                                <?= $_SESSION['usuario']['createDate']; ?>
                            </p>

                            <form form action="..\controller\tweet.php" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="text" id="text" class="form-control" placeholder="Gramear">
                                </div>
                                <input class="btn btn-primary" id="tweetear" type="submit" value="Gramear" name="tweetear">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <?php
                    $pub = "SELECT * FROM publications as pub JOIN users as us ON pub.userId=us.id 
                   where pub.userId=us.id ;";
                    $result = $pdo->query($pub);


                    // $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
                    // Sustituir esta linea por la de abajo cuando se haga POO
                
                    while ($row = $result->fetch(\PDO::FETCH_ASSOC)): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="view/profiles.php?id=<?= $row['userId'] ?>">
                                        <?= $row['username'] ?>
                                    </a>
                                </h5>

                                <p class="card-text">
                                    <?= $row['text'] ?>
                                </p>
                                <p class="card-text">
                                    <?= $row['createDate'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>


    </body>

    </html>

    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Añado la fuente Roboto -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
            defer></script>
    </head>

    <body>

        <?php
        if (isset($_SESSION['errores'])) {
            echo $_SESSION["completado"];
            $_SESSION["completado"] = "";
        }
        ?>

        <div class="container-sm">
            <h3>Register</h3>
            <hr>
            <div>
                <form action="model\registro.php" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Name:</label>
                        <input type="text" id="username" name="username" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="mail" class="form-label">Mail:</label>
                        <input type="email" id="mail" name="mail" class="form-control"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" />
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" id="description" name="description" class="form-control" required />
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Register" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <hr>

            <h3>Login</h3>
            <hr>
            <div>
                <?php
                if (isset($_SESSION["error_login"])) {
                    echo $_SESSION["error_login"];
                    $_SESSION["error_login"] = "";
                }
                ?>

                <form action="model\login.php" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Mail:</label>
                        <input type="email" id="email" name="email" class="form-control"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="pass" class="form-control" required
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" />
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Login" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
    <?php
}
?>