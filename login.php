<?php
  namespace MyApp;
  include(__DIR__ . "/PhpClasses/User.php");
  $errormessage = '⚠️ The details were incorrect. Please try again.';
  $error = false;

  if (!empty($_POST)){
    $inputlogin = htmlspecialchars($_POST['inputlogin'],ENT_QUOTES,"UTF-8");
    $password = htmlspecialchars($_POST['password'],ENT_QUOTES,"UTF-8");
    try{
      $user = new User();

      // Uses this to check if user gave an email, if so search account by email.
      if (filter_var($inputlogin, FILTER_VALIDATE_EMAIL)) {
        $userData = $user->getUserByEmail($inputlogin);
      } else {
        $userData = $user->getUserByUsername($inputlogin);
      }


      if (isset($userData)) {
        if (password_verify($password,$userData['password'])) {
          $error = false;
          // Username and password are correct
          session_start();
          $_SESSION['username'] = $userData['username'];
          $_SESSION['user_id'] = $userData['user_id'];
          $succes ="⭐ Welcome back " . $_SESSION['username'] . "!";
          header("refresh:1; url=homepage.php");
        } else {
          // password incorrect!
          $errormessage = '⚠️ Password incorrect!';
          $error = true;
        }
      } else {
        $errormessage = '⚠️ The given username does not exist!';
        // Username does not exist!
        $error = true;
      }
    } catch (\Throwable $th){
      echo "⚠️ An error occurred: " . $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Log in</title>
</head>
<body>

<div class="custom-shape-divider-bottom-1692189963">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<div id="register">
    <h1 class="title">Welcome back!</h1>
    <h2 class="subtitle">Time to get some tasks done! No account yet? Sign up <a class="link" href="register.php">here</a> to make one!</h2>
</div>


<div class="registerForm">
 
<form action="login.php" method="post">
    <?php if(isset($succes)): ?>
      <div class="succes"><?php echo $succes; ?></div>
    <?php endif; ?>
    <div class="input">
        <label for="inputlogin">Username or email</label>
        <input type="text" id="username" name="inputlogin">
    </div>

    <div class="input">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <?php if (isset($error) && $error == true): ?>
      <div class="alert"><?php echo $errormessage; ?></div>
    <?php endif; ?>
    <input type="submit" class="button" value="Login">
  </form>

</div>

</body>
</html>