<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");

  $errormessage = '⚠️ Something went wrong!';
  $haserror = false;
  // Check if the form is empty
  if(!empty($_POST)){
    // try catch block to put up error messages
    try{
      //Create instance of User Class and set values.
      $task = new Task();
      //Create unique user id, using integrated function uniqid()
      $task->setTaskid(uniqid());
      $task->setUserid($_SESSION['user_id']);
      $task->setName($_POST['taskName']);
      $task->setDescription($_POST['taskDescription']);
      $task->setDuedate($_POST['due']);

      $task->createTask();
      $succes ="⭐ Task created succesfully!";
      header("refresh:1; url=homepage.php");
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
    <title>Academate - Create task</title>
</head>
<body class="body">

<div>
    <form id="createTask" action="create-task.php" method="post">
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
        <label for="due">Due (optional)</label>
        <input type="date" id="due" name="due">
      </div>

      <div class="input2">
        <label for="label">Label</label>
        <select id="label" name="label">
          <option value="Label 1">Label 1</option>
          <option value="Label 2">Label 2</option>
          <option value="Label 3">Label 3</option>
          <option value="Label 4">Label 4</option>
        </select>
        </div>

      <input type="submit" class="button" value="Create">
    </form>
</div>

    
</body>
</html>