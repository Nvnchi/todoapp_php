<?php
include_once 'header.php';
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
        <div id="name"><h1 class="title3">Name</h1></div>
        <a href="#"><img id="edit" src="edit.svg" alt="Edit icon"></a>
        <div id="email"><h2 class="subtitle2">Email</h2></div>
        <a href="#"><img id="edit" src="edit.svg" alt="Edit icon"></a>
        </div>
        <div id="nameEmail">
        <h2 class="subtitle2">@Username</h2>
        <a href="#"><img id="edit" src="edit.svg" alt="Edit icon"></a>
        </div>
        <div id="nameEmail">
        <h3 class="text">University</h3>
        <a href="#"><img id="edit" src="edit.svg" alt="Edit icon"></a>
        </div>
        <a id="logout" class="button" href="logout.php">Log out</a>
        
    </div>
</body>
</html>