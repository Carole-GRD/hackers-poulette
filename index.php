<?php
    require_once __DIR__.'/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackers poulette</title>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" charset="utf-8" />
</head>
<body>

    <div class="logo">
        <img src="assets/img/logos/hackers-poulette-logo.png" alt="Logo of 'Hackers poulette'">
    </div>
    
    <?php require 'php/form.php'; ?>

    <script type="module" src="script/script.js"></script>
    
</body>
</html>