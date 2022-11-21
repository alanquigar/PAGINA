<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password, username FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ForReal</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style_main.css">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <?php require 'partials/main.php'?>
    <?php else: ?>
     <?php require 'partials/index_main.php'?>
    <?php endif; ?>

  </body>
</html>
