<section class="navbar">
    <?php 
        if ($_SESSION["user-role"] == "viewer") {
            echo "
            
                <a href='../index.php' class='nav-logo'>ZouTube</a>
                <input type='text' class='search-input' placeholder='Search'>
                <a href='./pages/login.php' class='login-btn'>Login</a>
            
            ";
        } else {
            echo "
            
                <p class='nav-logo'>ZouTube</p>
                <a href='../index.php' class='logout-btn'>Logout</a>
            
            ";
        }
    ?>
</section>