<?php
  namespace MyApp;
  include(__DIR__ . "/PhpClasses/User.php");

  $errormessage = '⚠️ Something went wrong!';
  $haserror = false;
  // Check if the form is empty
  if(!empty($_POST)){
    // try catch block to put up error messages
    try{
      //Create instance of User Class and set values.
      $user = new User();
      //Create unique user id, using integrated function uniqid()
      $user->setUserid(uniqid());
      $user->setUsername($_POST['username']);
      $user->setEmail($_POST['email']);
      $user->setLastname($_POST['lastname']);
      $user->setFirstname($_POST['firstname']);

      // this cost is the repetition of the algorithm which means the algorithm will run 14 times to make a strong hash
      $options = [
        'cost' => 14,
      ];
      // Using password_hash to create a bcrypt hash of the password
      $user->setPassword(password_hash($_POST['password'],  PASSWORD_BCRYPT, $options));

      $user->createUser();
      $succes ="⭐ User created succesfully!";
      header("refresh:1; url=login.php");
    } catch(\Throwable $th){
        $error = $th->getMessage();
        $errormessage = $error;
        $haserror = true;
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
    <title>Academate - Register</title>
</head>
<body>

<div class="custom-shape-divider-bottom-1692189963">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<div id="register">
    <h1 class="title">Welcome!</h1>
    <h2 class="subtitle">Ready to get some tasks done? Fill in the form or log in <a class="link" href="login.php">here</a> if you have an account already!</h2>
</div>


<div class="registerForm">
  <?php if(isset($succes)): ?>
    <div class="succes"><?php echo $succes; ?></div>
  <?php endif; ?>
  <form action="register.php" method="post">
    <div class="input">
        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname">
    </div>

    <div class="input">
        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname">
    </div>

    <div class="input">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    </div>

    <div class="input">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
    </div>

    <div class="input">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <?php if (isset($haserror) && $haserror == true): ?>
      <div class="alert"><?php echo $errormessage; ?></div>
    <?php endif; ?>
    <input type="submit" class="button" value="Register">
  </form>

</div>

</body>
</html>