<!DOCTYPE html>
<html lang="en">
    <?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    
    if (!isset($_SESSION['name']) ) {
        header('location:index.php');
    }
    
    $serverName = "localhost";
    $user = "root";
    $password = "";
    $dbname = "track_and_treat";

    try {
      $pdo = new PDO("mysql:host=$serverName;dbname=$dbname", $user, $password);
      // set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>track and treat</title>
        <link href="style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <h1 id="webAppName">track and treat</h1>
            <a href="company_list.php" class="linkToOtherPage">company list</a>
            <a href="costumer_home.php" class="linkToOtherPage">home</a>
            <a href="logout.php" class="linkToOtherPage">logout</a>
        </header>
        <main>