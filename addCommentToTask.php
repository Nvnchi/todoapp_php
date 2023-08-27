<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/Task.php");
  include(__DIR__ . "/PhpClasses/TaskComment.php");

  // get the q parameter from URL

  // anti xss, remove special chars and strig tags from request param
  $taskid = htmlspecialchars(strip_tags($_REQUEST["taskid"]),ENT_QUOTES,"UTF-8");
  $comment = htmlspecialchars(strip_tags($_REQUEST["comment"]),ENT_QUOTES,"UTF-8");

  $task = new Task();
  $taskcheck = $task->getTaskByid($_SESSION['user_id'], $taskid);
  // check if task exists and comment is not empty
  if ($taskcheck != null && $comment != "") {
    // create new taskcomment
    $taskcomment = new TaskComment();
    $taskcomment->setTaskid($taskid);
    $taskcomment->setCommentid(uniqid());
    $taskcomment->setComment($comment);
    $taskcomment->createTaskComment();
  }
?>