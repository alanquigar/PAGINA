<?php
  session_start();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!--============CSS===============-->
    <link rel="stylesheet" href="./assets/css/profile_style.css">
    <!--============BOX ICONS CSS===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <main>
        <div class="profile-card">
            <div class="image">
                <?php if(!empty($user['imagen'])): ?>
                    <img src="<?='./img/'.$user['imagen'] ?>" class="profile-img">
                <?php else: ?>
                    <img src="./img/gamer.png" class="profile-img">
                <?php endif;?>
            </div>
            <div class="text-data">
                <!---Arreglar el username-->
                <?php if(!empty($user)): ?>
                    <span class="name"><?= $user['username']; ?></span>
                <?php else: ?>
                    <span class="name">Anonimo</span>
                <?php endif;?>
                <span class="job" >&middot; User &middot;</span>
            </div>
            <br><br>
            <div class="media-buttons">
                <a href="#" style="background: #335cad;" class="link">
                    <i class="bx bxl-linkedin"></i>
                </a>
                <a href="#" style="background: #1da1f2;" class="link">
                    <i class="bx bxl-twitter"></i>
                </a>
                <a href="#" style="background-color: #e1306c;" class="link">
                    <i class="bx bxl-instagram"></i>
                </a>
                <a href="#" style="background: #222;" class="link">
                    <i class="bx bxl-github"></i>
                </a>
            </div>
            <div class="button_home" style="background-color: #4070f4; width: 100%; height: 40px; border-radius: 2px; display: flex;  justify-content: center;  align-items: center;  margin-top: 5px;">
                <a href="index.php" style="text-decoration: none; color: #fff;">Home</a>
            </div>
        </div>
    </main>
</body>
</html>