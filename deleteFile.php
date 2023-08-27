<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");

  // remove special characters from request param
  $taskid = htmlspecialchars(strip_tags($_REQUEST["taskid"]),ENT_QUOTES,"UTF-8");
  $filename = htmlspecialchars(strip_tags($_REQUEST["filename"]),ENT_QUOTES,"UTF-8");

  $task = new Task();
  $taskcheck = $task->getTaskByid($_SESSION['user_id'], $taskid);
  // check if task from requested id exists
  if ($taskcheck != null) {
    // update said taskfile and set to ""
    $task->updateTaskFile("", $taskid);
  }
?>