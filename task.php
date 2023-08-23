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
    <title>Academate - Task</title>
</head>
<body class="body">
    <div id="background">
    
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
    </div>

    <div id="background"></div>

    <div id="taskDetails">
    <div class="headerTask">
    <div class="headerItem"><h1 class="title3">Task name</h1></div>
    <div class="headerItem"><a href="homepage.php"><img class="icon2" src="multiply-line.svg" alt="Close"></a></div>
    </div>
    <h2 class="subtitle2">Due date</h2>
    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <div class="buttons">
    <div class="buttonAction"><button class="button">Edit task</button></div>
    <div class="buttonAction"><button class="button">Delete task</button></div>
    </div>
    </div>

    
</body>
</html>