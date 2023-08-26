<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");
  include(__DIR__ . "/PhpClasses/TaskList.php");
  use Exception;

  $errormessage = '⚠️ Something went wrong!';
  $haserror = false;

  $tasklist = new TaskList();

  $tasklists = $tasklist->getTaskLists($_SESSION['user_id']);
  
  // Check if the form is empty
  if(!empty($_POST)){
    // try catch block to put up error messages
    try{
      //Create instance of User Class and set values.
      $task = new Task();
      $tasklistname = "";
      if ($_POST["labeldropdown"] != "none" && empty($_POST["label"])) {
        $tasklistname = $_POST['labeldropdown'];
        $task->setTaskListName($tasklistname);
      } else if (!empty($_POST["label"])) {
        $tasklistname = $_POST['label'];
        $tasklist->setTaskListid(uniqid());
        $tasklist->setName($_POST['label']);
        $tasklist->setUserid($_SESSION['user_id']);

        $tasklist->createTaskList();
        
        $task->setTaskListName($_POST['label']);
      } else {
        $task->setTaskListName("");
      }
      $result = $task->getTaskByNameCheckifExistsInList($tasklistname, $_POST['taskName']);
      if (!empty($result)) {
        throw new Exception("Taskname already taken in this list!");
      }
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
      <?php if(isset($succes)): ?>
        <div class="succes"><?php echo $succes; ?></div>
      <?php endif; ?>
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

      <?php if (isset($tasklists) && count($tasklists) > 0): ?>
        <div class="input2">
        <label for="label">List:</label>
        <select id="label" name="labeldropdown">
            <option value="none">none</option>
          <?php foreach ($tasklists as $tasklist) { ?>
            <option value="<?php echo $tasklist['name']; ?>"><?php echo $tasklist['name']; ?></option>
          <?php } ?>
        </select>
        </div>
        <?php else: ?>
        <div class="input2">
          <label for="label">No tasklists</label>
        </div>
      <?php endif; ?>
      <div class="input2">
        <label for="label">Use another list: (will override selected list)</label>
        <input type="label" id="test" name="label">
      </div>
      <?php if (isset($haserror) && $haserror == true): ?>
        <div class="alert"><?php echo $errormessage; ?></div>
      <?php endif; ?>
    
      <input type="submit" class="button" value="Create">
    </form>
</div>

    
</body>
</html>