<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = 'Sorry, something went wrong';
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log in</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style_form.css">
</head>
<body>
    <div class="container">
        <?php if(!empty($message)): ?>
          <p> <?= $message ?></p>
        <?php endif; ?>
        <header>Log in</header>
        <form action="login.php" method="POST">
          <div class="field email-field">
            <div class="input-field">
              <input  type="email"  placeholder="Email address" class="email" name="email"/>
            </div>
          </div>
          <div class="field email-field">
            <div class="input-field">
              <input  type="password"  placeholder="Password" class="password" name="password"/>
            </div>
          </div>
          <div class="input-field button">
              <input type="submit" value="Log in" />
          </div>
          <a href="signup.php">Do you not have an account?</a>
        </form>
    </div>
</body>
</html>
