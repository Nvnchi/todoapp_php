<?php
  namespace MyApp;
  include_once 'header.php';
  include(__DIR__ . "/PhpClasses/TaskList.php");

  $tasklist = new TaskList();

  $tasklists = $tasklist->getTaskLists($_SESSION['user_id']);
  
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
    <title>Academate - Profile</title>
</head>
<script>
function deleteTasklist(tasklist_id) {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xmlhttp.open("GET", "deleteLabel.php?tasklist_id=" + tasklist_id, true);
  xmlhttp.send();
}

</script>
<body class="body">
    <div class="labels">
        <div id="maintain">
            <div><a href="javascript:window.history.back();"><img class="icon2" id="icon2" src="goback.svg" alt=""></a></div>
            <div><h1 class="title">Maintain labels</h1></div>
        </div>
        <?php if (isset($tasklists) && count($tasklists) > 0): ?>
              <?php foreach ($tasklists as $tasklist) { ?>
                <div class="labels2">
                  <div id="nameLabel"><?php echo $tasklist['name']; ?></div>
                  <div id="deleteLabel" onclick="deleteTasklist('<?php echo $tasklist['tasklist_id']; ?>')"><img src="multiply-line.svg" class="icon2" alt=""></div>
                </div>
              <?php } ?>
        <?php else: ?>
          <div class="input2">
            <label for="label">No labels</label>
          </div>
        <?php endif; ?>
        
    </div>
    
</body>