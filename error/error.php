<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de error</title>
    <link rel="stylesheet" href="..\css\errorst.css">
</head>
<body>

    
    <div class="error-container">
        <h1 class="error-message">¡Error!</h1>
        <p class="error-details">
            Se ha producido un error en la aplicación.
        </p>
        <p class="error-details">
            <strong class="error-code">Código de error:</strong> <?php echo $error->getCode(); ?>
        </p>
        <p class="error-details">
            <strong class="error-file">Archivo:</strong> <?php echo $error->getFile(); ?>
        </p>
        <p class="error-details">
            <strong class="error-line">Línea:</strong> <?php echo $error->getLine(); ?>
        </p>
        <p class="error-details">
            Por favor, inténtelo de nuevo más tarde.
        </p>
    </div>
</body>
</html>