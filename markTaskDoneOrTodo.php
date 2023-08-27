<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");
  include(__DIR__ . "/PhpClasses/TaskComment.php");

  // get the q parameter from URL
  $taskid = htmlspecialchars(strip_tags($_REQUEST["taskid"]),ENT_QUOTES,"UTF-8");

  $task = new Task();
  $taskcheck = $task->getTaskByid($_SESSION['user_id'], $taskid);
  if ($taskcheck != null) {
    $task->updateTaskTodo($taskid, !$taskcheck["isdone"]);
  }
?>