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
    
    <div class="taskAdd">
    <h1 class="title2">Let's get some tasks done!</h1>
    <a class="icon" href="create-task.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" fill="none"><path stroke="#FF9A8B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h7m7 0h-7m0 0V5m0 7v7"/></svg></a>
    </div>

    <div class="tasks">
        <div class="task">
            <div class="taskNameDate">
                <div class="taskName"><p>Name task</p></div>
                <div class="taskDate"><p>Due date</p></div>
            </div>
            <div class="taskDescription"><p>Description task</p></div>
        </div>
    </div>

    <h1 class="title2">Glad these are over!</h1>

    <div class="Dtasks">
        <div class="Dtask">
        <div class="DtaskNameDate">
                <div class="DtaskName"><p>Name task</p></div>
                <div class="DtaskDate"><p>Due date</p></div>
            </div>
            <div class="DtaskDescription"><p>Description task</p></div>
        </div>
    </div>

    
</body>
</html>