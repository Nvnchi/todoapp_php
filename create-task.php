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


    // do complete check of all post parameters anti xss
    $labeldropdowncheck = ""; // default value
    if (isset($_POST['labeldropdown'])) {
      $labeldropdowncheck = htmlspecialchars(strip_tags($_POST['labeldropdown']),ENT_QUOTES,"UTF-8");
    }
    $labelcheck = htmlspecialchars(strip_tags($_POST['label']),ENT_QUOTES,"UTF-8");
    $tasknamecheck = htmlspecialchars(strip_tags($_POST['taskName']),ENT_QUOTES,"UTF-8");
    $taskdescriptioncheck = htmlspecialchars(strip_tags($_POST['taskDescription']),ENT_QUOTES,"UTF-8");
    $duecheck = htmlspecialchars(strip_tags($_POST['due']),ENT_QUOTES,"UTF-8");

    // try catch block to put up error messages
    try{
      //Create instance of User Class and set values.
      $task = new Task();
      $tasklistname = ""; // default value
      // if selected from dropdown and nothing in the input use dropdown
      if ($labeldropdowncheck != "none" && empty($labelcheck)) {
        $tasklistname = $labeldropdowncheck;
        $task->setTaskListName($tasklistname);

      // if (not) selected from dropdown and new input, use input
      } else if (!empty($labelcheck)) {
        $tasklistname = $labelcheck;
        $tasklist->setTaskListid(uniqid());
        $tasklist->setName($labelcheck);
        $tasklist->setUserid($_SESSION['user_id']);

        $tasklist->createTaskList();
        
        $task->setTaskListName($labelcheck);
      // else, no tasklistname
      } else {
        $task->setTaskListName("");
      }
      // check if taskname is used.
      $result = $task->getTaskByNameCheckifExistsInList($tasklistname, $tasknamecheck);
      if (!empty($result)) {
        throw new Exception("⚠️ This task has already been made. Use another name.");
      }
      //Create unique user id, using integrated function uniqid() = make a random id
      $task->setTaskid(uniqid());
      $task->setUserid($_SESSION['user_id']);
      $task->setName($tasknamecheck);
      $task->setDescription($taskdescriptioncheck);
      $task->setDuedate($duecheck);
      
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
        <label for="taskName">Task name*</label>
        <input type="text" id="taskName" name="taskName">
      </div>

      <div class="input2">
        <label for="taskDescription">Task description*</label>
        <input type="text" id="taskDescription" name="taskDescription">
      </div>

      <div class="input2">
        <label for="due">Due</label>
        <input type="date" id="due" name="due">
      </div>

      <?php if (isset($tasklists) && count($tasklists) > 0): ?>
        <div class="input2">
        <label for="label">Label:</label>
        <select id="label" name="labeldropdown">
            <option value="none">none</option>
          <?php foreach ($tasklists as $tasklist) { ?>
            <option value="<?php echo $tasklist['name']; ?>"><?php echo $tasklist['name']; ?></option>
          <?php } ?>
        </select>
        </div>
        <?php else: ?>
        <div class="input2">
          <label for="label">No labels</label>
        </div>
      <?php endif; ?>
      <div class="input2">
        <label for="label">Make another label</label>
        <input type="label" id="test" name="label">
        <a class="link" id="link" href="labels.php">Maintain labels</a>
      </div>
      <?php if (isset($haserror) && $haserror == true): ?>
        <div class="alert"><?php echo $errormessage; ?></div>
      <?php endif; ?>
    
      <input type="submit" class="button" value="Create">
    </form>
</div>

    
</body>
</html>