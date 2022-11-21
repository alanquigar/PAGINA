<?php

  require 'database.php';
  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password, username, imagen FROM users WHERE id = :id');
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--====================BOXICONS==================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <!--=================HEADER===================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo"><?= $user['username']?></a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#news" class="nav__link">
                            <i class="bx bx-news nav__icon"></i>
                            <span class="nav__name">News</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#profile" class="nav__link">
                            <i class="bx bx-user nav__icon"></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="logout.php" class="nav__link">
                            <i class="bx bx-log-out nav__icon" style="color: red"></i>
                            <span class="nav__name" style="color: red" >Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php if(!empty($user['imagen'])): ?>
                    <img src="<?='./img/'.$user['imagen'] ?>" class="nav__img">
            <?php else: ?>
                    <img src="./img/gamer.png" class="nav__img">
            <?php endif;?>
        </nav>
    </header>
    <!--=================MAIN===================-->
    <main>
         <!--=================News===================-->
        <section class="container section section__height" id="news">
            <h2 class="section__title">News</h2>
            <div class="img">
                <img src="./img/Humaaans - Space.png">
            </div>
            <a href="#" class="button">News</a>
        </section>
         <!--=================Profile===================-->
        <section class="container section section__height" id="profile">
            <h2 class="section__title">Profile</h2>
            <div class="img">
                <img src="./img/Humaaans - Wireframe.png">
            </div>
            <a href="profile.php" class="button">Profile</a>
        </section>

    </main>
    <!--=================MAIN JS===================-->
    <script src="./js/main.js"></script>
</body>
</html>