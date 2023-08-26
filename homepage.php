<?php
  namespace MyApp;
  use DateTime;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");
  include(__DIR__ . "/PhpClasses/TaskComment.php");

  $task = new Task();

  $tasks = $task->getAllTodoTasks($_SESSION['user_id']);
  $donetasks = $task->getAllDoneTasks($_SESSION['user_id']);

  $filterbyname = (isset($_GET['filterbyName'])) ? $_GET['filterbyName'] : '';
  $filterbydate = (isset($_GET['filterbyDate'])) ? $_GET['filterbyDate'] : '';

  if ($filterbyname == "true"){
    $tasks = $task->getAllTodoTasksFilterByName($_SESSION['user_id']);
  }

  $getTask = null;
  if (isset($_GET['opentaskid'])) {
    $getTask = $task->getTaskByid($_SESSION['user_id'], $_GET['opentaskid']);
    $taskcomment = new TaskComment();
    $taskcomments = $taskcomment->getAllCommentsByTaskid($_GET['opentaskid']);
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
    <title>Academate</title>
</head>
<script>
function addComment(task_id) {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xmlhttp.open("GET", "addCommentToTask.php?taskid=" + task_id + "&comment=" + document.getElementById("inputfieldComment").value, true);
  xmlhttp.send();
}
function markTaskDoneOrTodo(task_id) {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xmlhttp.open("GET", "markTaskDoneOrTodo.php?taskid=" + task_id, true);
  xmlhttp.send();
}

function deleteTask(task_id) {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xmlhttp.open("GET", "deleteTask.php?taskid=" + task_id, true);
  xmlhttp.send();
}

function orderTasksBy(filter) {
  const baseUrl = window.location.origin + window.location.pathname;
  if (filter == "namefilter"){
    window.location.href = baseUrl + "?filterbyName=true" + "&filterbyDate=false";
  } else {
    window.location.href = baseUrl + "?filterbyName=false" + "&filterbyDate=true";
  }
}
  

</script>
<body class="body  . <?php $getTask !== null ? 'background' : '' ?>">

      <div class="taskAdd">
        <h1 class="title2">Let's get some tasks done!</h1>
        
        <a class="icon" href="create-task.php">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" fill="none"><path stroke="#FF9A8B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h7m7 0h-7m0 0V5m0 7v7"/></svg></a>
          <div id="filters">
            <div id="filterTitle"><h2>Filter on</h2></div>
          <div id="filter">
          <label class="b-contain" for="namefilter">Listname
          <input type="checkbox" <?php if ($filterbyname == "true") { echo 'checked'; } ?> id="namefilter" name="name" onclick="orderTasksBy('namefilter')">
          <div class="b-input"></div>
          </label>
          <label class="b-contain" for="datefilter">Date
          <input type="checkbox" <?php if ($filterbydate == "true") { echo 'checked'; } ?> id="datefilter" name="date" onclick="orderTasksBy('datefilter')">
          <div class="b-input"></div>
          </label>

          </div>
          </div>
      </div>

      <div class="tasks">
      <?php if (isset($tasks) && count($tasks) > 0): ?>
        <?php foreach ($tasks as $task) { ?>
          <div onclick="window.location.href='homepage.php?opentaskid=<?php echo $task['task_id']; ?>&filterbyName=<?php echo $filterbyname; ?>&filterbyDate=<?php echo $filterbydate; ?>'">
            <div class="task">
              <div class="taskNameDate">
                <div class="taskName"><p><?php echo $task['name']; ?></p></div>
                <div class="taskDate"><p><?php echo $task['duedate']; ?></p></div>
              </div>
              <div class="taskDescription"><p><?php echo $task['description']; ?></p></div>
              <?php if ($task['duedate'] == date("Y-m-d")): ?>
                <p class="dueTill">this is due today..</p>
              <?php elseif ($task['duedate'] <= date("Y-m-d") && $task['duedate'] != ""): ?>
                <p class="dueTill">this is overdue..</p>
              <?php elseif ($task['duedate'] != ""): ?>
                <p class="dueTill">You have <?php 
                  // take the current date
                  $startDate  = new DateTime();
                  // and the task due date which we make a new DateTime class.
                  $endDate = new DateTime($task['duedate']);
                  // Check the difference between the 2 and get the difference in days
                  $interval = $startDate->diff($endDate);
                  $daysDifference = $interval->days;

                  // plus 1 because it doesn't count the current day.
                  echo $daysDifference + 1;
                ?> day(s) left</p>
              <?php endif; ?>
            </div>
          </div>
        <?php } ?>
        </div>
      <?php else: ?>
        <p class="details">No tasks yet, let's create some tasks!</p>
      <?php endif; ?>
      </div>
      <h1 class="title2">Glad these are over!</h1>
      <div class="Dtasks">
      <?php if (isset($donetasks) && count($donetasks) > 0): ?>
        <?php foreach ($donetasks as $task) { ?>
          <div onclick="window.location.href='homepage.php?opentaskid=<?php echo $task['task_id']; ?>'">
            <div class="Dtask">
              <div class="DtaskNameDate">
                  <div class="DtaskName"><p><?php echo $task['name']; ?></p></div>
                  <div class="DtaskDate"><p><?php echo $task['duedate']; ?></p></div>
                </div>
                <div class="DtaskDescription"><p><?php echo $task['description']; ?></p></div>
              </div>
          </div>
        <?php } ?>
        </div>
      <?php else: ?>
        <p class="details">No done tasks yet, start working!</p>
      <?php endif; ?>

      <?php if ($getTask !== null): ?>
        <div id="taskDetails">
          <div class="headerTask">
            <div class="titleDue">
            <div class="dueTitle"><div class="headerItem"><h1 class="title3"><?php echo $getTask['name']; ?></h1></div></div>
            <div class="due"><h2 class="subtitle2"><?php echo $getTask['duedate']; ?></h2></div>
            </div>
            <div class="headerItem"><a href="homepage.php?filterbyName=<?php echo $filterbyname; ?>&filterbyDate=<?php echo $filterbydate; ?>"><img class="icon2" src="multiply-line.svg" alt="Close"></a></div>
            </div>
            <div id="labels">
              <div id="label"><?php echo $getTask['tasklist_name']; ?></div>
            </div>
            <p class="text"><?php echo $getTask['description']; ?></p>
            <div class="buttons">
            <div class="buttonAction"><button class="button" onclick="deleteTask('<?php echo $getTask['task_id']; ?>')">Delete task</button></div>
            <?php if ($getTask['isdone'] == 0): ?>
              <div class="buttonAction"><button class="button" onclick="markTaskDoneOrTodo('<?php echo $getTask['task_id']; ?>')">Task done</button></div>
            <?php else: ?>
              <div class="buttonAction"><button class="button" onclick="markTaskDoneOrTodo('<?php echo $getTask['task_id']; ?>')">Task todo</button></div>
            <?php endif; ?>
            </div>
            <div id="line"></div>
            <p class="title4">Comments:</p>
            <?php if (isset($taskcomments) && count($taskcomments) > 0): ?>
              <?php foreach ($taskcomments as $comment) { ?>
                <p class="text"><?php echo $comment['comment']; ?></p>
              <?php } ?>
            <?php else: ?>
              <p class="text">No comments yet!</p>
            <?php endif; ?>
            <div class="buttonAction"><input id="inputfieldComment"></input></div>
            <div class="buttonAction"><button class="button" id="butt" onclick="addComment('<?php echo $getTask['task_id']; ?>')">Add comment</button></div>
        </div>
      <?php endif; ?>
</body>
</html>