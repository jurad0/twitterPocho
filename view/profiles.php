<?php
require_once("../connection/connection.php");
session_start();
$con = $pdo;
$id = ($_GET['id']);

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

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $userRow = $stmt->fetch(\PDO::FETCH_ASSOC);

    ?>

    <header class="navbar navbar-expand-lg bg-body-tertiary rounded" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="../index.php">JURAGRAM</a>
            <a href="../model/siguiendo.php">Siguiendo</a>
            <a href="../model/logout.php" class="btn btn-danger rounded-pill px-3">Logout</a>
        </div>

    </header>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $userRow['username'] ?>
                    </h5>
                    <p class="card-text">
                        <?= $userRow['description']; ?>
                    </p>
                    <p class="card-text">
                        <?= $userRow['createDate']; ?>
                    </p>
                    <?php if ($_SESSION['usuario']['id'] == $id) { ?>
                        <form action="../CRUD/editdesc.php" class="card-text" method="POST">
                            <textarea name="editdesc" id="editdesc" class="card-text"></textarea>
                            <input type="submit" value="Editar" class="btn btn-primary" />
                        </form>
                    <?php } ?>
                    <?php if ($_SESSION['usuario']['id'] != $id) { ?>
                        <div class="d-flex justify-content-between">
                            <a href="../model/follows.php?id=<?= $id ?>" class="btn btn-primary">
                                Follow
                            </a>
                            <a href="../model/unfollows.php?id=<?= $id ?>" class="btn btn-primary">
                                Unfollow
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <?php
        

            $pub = "SELECT * FROM publications WHERE userId = '$id'";
            $stmt = $pdo->prepare($pub);
            $stmt->execute();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)): ?>
                <div class="card mb-3">
                    <div class="card-body">
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