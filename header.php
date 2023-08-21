<header>

    <nav>
        <div class="divHeader">
            <a id="logo" href="homepage.php">Academate</a>
        </div>

        <div class="divHeader">
            <p>Hi, <?php echo isset($_SESSION['username']) ? "(<a href=#>" . $_SESSION['username'] : '<a class="link" href="login.php">Login</a>' ?>!</p>
        </div>
    </nav>

</header>