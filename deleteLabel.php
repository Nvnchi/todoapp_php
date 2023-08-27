<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/TaskList.php");

  $tasklistid = htmlspecialchars(strip_tags($_REQUEST["tasklist_id"]),ENT_QUOTES,"UTF-8");

  $tasklist = new TaskList();
  $tasklistcheck = $tasklist->getTasklistByid($_SESSION['user_id'], $tasklistid);
  if ($tasklistcheck != null) {
    $tasklist->deleteTasklist($tasklistid);
  }
?>