<nav>
    <div class="NavContainer">
        <div class="navimg">
            <img src="https://pngimg.com/uploads/football/football_PNG52760.png" alt="">
            <h2>Calcetto</h2>
        </div>
        <div class="navlinks">
            <a href="index.php" class="nav_link">Home</a>
            <?php
            if (isset($_SESSION['username'])) {
                ?>
                <a href="profilo.php" class="nav_link">Profilo</a>
            <?php } else { ?>
                <a href="login.php" class="nav_link">Login</a>
            <?php } ?>
        </div>

    </div>
</nav>