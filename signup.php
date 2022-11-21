<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) ) {
    $sql = "INSERT INTO users (email, password, username, imagen) VALUES (:email, :password, :username, :imagen)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':imagen', $_POST['imagen']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
    
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style_form.css">
</head>
<body>
    <div class="container">
        <?php if(!empty($message)): ?>
          <p> <?= $message ?></p>
        <?php endif; ?>
        <header>Sign up</header>
        <form action="signup.php" method="POST">
          <div class="field email-field">
            <div class="input-field">
              <input  type="email"  placeholder="crlos19@outlook.com" class="email" name="email"/>
            </div>
          </div>
          <div class="field email-field">
            <div class="input-field">
              <input  type="text"  placeholder="NoobMaster69" class="email" name="username"/>
            </div>
          </div>
          <div class="field email-field">
            <div class="input-field">
              <input  type="password"  placeholder="Kitty123!" class="password" name="password"/>
            </div>
          </div>
          <div class="field email-field">
            <div class="input-field">
              <input  type="password"  placeholder="Kitty123!" class="cPassword" name="confirm_password"/>
            </div>
          </div>
          <input type="file" name="imagen">
          <div class="input-field button">
              <input type="submit" value="Sign in" />
          </div>
          <a href="login.php">Go back</a>
        </form>
    </div>
</body>
</html>
