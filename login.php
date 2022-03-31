<html>
    <head>
        <title>Login</title>
        <link rel="icon" href="imgs/favicon.jpg" type="image/ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body{background: linear-gradient(90deg, rgba(159,207,231,1) 0%, rgba(199,228,234,1) 63%, rgba(187,171,234,1) 100%);}
            .col{padding: 50px;}
            img{
                min-width: 400px;
                border-radius: 10px;
            }
            input{margin: 10px;}
            .container{
                border: 1px solid darkblue;
                border-radius: 20px;
                padding: 30px;
            }
        </style>
    </head>
</html>
<body>
    
    <?php
    include('navbar.php'); 
        include('db_connect.php');
        
        if(isset($_POST['submit'])) {
            
            $email = $_POST['email'];
            $password = $_POST['password']; 
            
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
                   
            if($count == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $pw = $row['password'];

                if(strcmp($password, $pw)){
                    echo "<div class='alert alert-danger'>Your Email or Password is invalid!</div>";;
                }
                else{
                    session_start();
                    $_SESSION['login_user'] = $row['user_id'];
                    $_SESSION['is_admin'] = $row['is_admin'];
                    if($row['is_admin'])
                    {
                    header("location: checkquota.php");
                }
                else
                {
                    header("location: bookconf.php");
                }
            }
            }
            else {
                echo "<div class='alert alert-danger'>Your Email or Password is</div>";
            }
        }
        mysqli_close($conn);
    ?>
    
    <div class="container">
        <h2 class="alert alert-primary">Login</h2>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <input autofocus class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Login">
                </form>
            </div>
            <div class="col">
                <img src="https://img.freepik.com/free-photo/colleagues-giving-fist-bump_53876-64857.jpg?size=626&ext=jpg&ga=GA1.1.691103720.1648718733" width="100%">
            </div>
        </div>
    </div>
    

<body>