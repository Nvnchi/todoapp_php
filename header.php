<?php
  session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
    header("Location: login.php");
  }
?>
<header>

    <nav>
        <div class="divHeader">
            <a id="logo" href="homepage.php">Academate</a>
        </div>
        <div class="divHeader">
            <p>Hi, <?php echo isset($_SESSION['username']) ? "<a class='link' href='profile.php'>" . $_SESSION['username'] . "</a>" : '<a class="link" href="login.php">' . $_SESSION['username'] . '</a>' ?>!</p>
        </div>
    </nav>

</header>