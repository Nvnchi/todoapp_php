<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/User.php");

  $user = new User();
  // Uses this function in the User class to get the user if exists, if not it returns null
  $userData = $user->getUserById($_SESSION['user_id']);

  if ($userData == null) {
    header("Location: login.php");
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
    <title>Academate - Profile</title>
</head>
<body class="body">
    <div class="profile">
        <div id="nameEmail">
        <div id="name"><h1 class="title3"><?php echo $userData['firstname'] . " " . $userData['lastname']; ?></h1></div>
        <div class="email"><h2 class="subtitle2"><?php echo $userData['email']; ?></h2></div>
        </div>
        <h2 class="subtitle2">@<?php echo $userData['username']; ?></h2>
        <div class="logout">
            <button id="logout" onclick="window.location.href='logout.php'">Log out</button>
        </div>
    </div>
</body>
</html>