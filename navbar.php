<link href="navbar.css" rel="stylesheet">
<div class="nav flexbox navbg">    
    <?php
        require("db_connect.php");
        session_start();
        if(isset($_SESSION['login_user'])){
            echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a></li>';
        }

        else
        {
            echo'<li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
    </li>';
        }
    ?>

</div>
