<?php

require_once("../connection/connection.php");
session_start();
$con = $pdo;
var_dump($con);


if (isset($_POST['botonlogin'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
        defer></script>
    <link rel="stylesheet" href="css\style.css">
</head>

<body>
<?php
// Check if the user is logged in
if (isset($_SESSION["usuario"])) {
    // User is logged in, display the cards
    $userId = $_SESSION['usuario']['id'];

    $sql = "SELECT p.*, u.username
    FROM publications p
    INNER JOIN follows f ON p.userId = f.userToFollowId
    INNER JOIN users u ON p.userId = u.id
    WHERE f.users_id = :userId";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0): ?>
        <header class="navbar navbar-expand-lg bg-body-tertiary rounded" data-bs-theme="dark">
            <div class="container-fluid">
                <a href="../index.php">JURAGRAM</a>
                <a href="siguiendo.php">Siguiendo</a>
                <a href="logout.php" class="btn btn-danger rounded-pill px-3">Logout</a>
            </div>
        </header>
        <div id="container">
            <div class="row">
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="../view/profiles.php?id=<?= $row['userId'] ?>">
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
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif;
}




 ?>

</body>

</html>

<?php
?>
