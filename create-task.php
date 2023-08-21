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
    <title>Academate</title>
</head>
<body class="body">

<div>
    <form id="createTask" action="post">
        <h1 class="title">Create a task</h1>

    <div class="input2">
        <label for="taskName">Task name</label>
        <input type="text" id="taskName" name="taskName">
    </div>

    <div class="input2">
        <label for="taskDescription">Task description</label>
        <input type="text" id="taskDescription" name="taskDescription">
    </div>

    <div class="input2">
        <label for="due">Due</label>
        <input type="date" id="due" name="due">
    </div>
    <input type="submit" class="button" value="Create">
    </form>
</div>

    
</body>
</html>