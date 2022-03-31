<html>
    <head>
        <title>Register</title>
        <link rel="icon" href="imgs/favicon.jpg" type="image/ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body{
                color: navy;
            }
            .form{
                padding-left: 15%;
                padding-right: 15%;
            }
            .btn{
                margin-top: 20px;
                margin-bottom: 20px;
            }
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
        <script type="text/javascript">
            function form_validation()
            {
                var x=document.getElementById("password").value;
                var passtype = /(?=.*[a-z])(?=.*[0-9])(?=.*[$@#/&]).{5,15}$/;
                if(!x.match(passtype)){
                    alert("Please enter the password in the correct format (Atleast 1 letter, 1 number and 1 special character)!");
                    return false;
                }
                return true;
            }
        </script>
    </head>
<body>
    <?php
        include('navbar.php'); 
        include('db_connect.php');
        
        if(isset($_POST['submit'])) {
            
            $email = $_POST['email'];
            $company_name = $_POST['company_name'];
            $password = $_POST['password']; 
            $c_password = $_POST['c_password']; 

            $sql = "SELECT user_id from users where email = '$email'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            if($count == 1) {
                echo "<div class='alert alert-danger'>Account with this Email already Exists!</div>";
            }
            else  if ($password != $c_password){
                echo "<div class='alert alert-danger'>Password and Confirm Password must be same!</div>";
            }
            else
            {
                $sql = "INSERT INTO users (company_name,email,password) VALUES ('$company_name','$email','$password')";
                $result = mysqli_query($conn,$sql);

                if($result)
                {
                    session_start();
                    session_start();
                    $sql = "SELECT user_id FROM users WHERE email = '$email'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    $_SESSION['login_user'] = $row['user_id'];
                    header("location: login.php");   
                } 
                else {
                    echo "<div class='alert alert-danger'>ERROR: Could not insert values ".mysqli_error($conn)."</div>";
                }
            }
        }
        mysqli_close($conn);
    ?>

    <div class="container">
        <h2 class="alert alert-info">Register</h2>
        <form action="" method="POST" class="form" onsubmit="return (form_validation());">
            <div class="mb-3 row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="company_name" class="col-sm-3 col-form-label">Company Name: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="company_name" name="company_name" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-3 col-form-label">Password: </label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cpw" class="col-sm-3 col-form-label">Confirm Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="cpw" name="c_password" required>
                </div>
            </div>
            <div class="mb-3 row">
                <input type="submit" name="submit" class="btn btn-primary col-sm-12">
            </div>

            
        </form>
               
        <div class="alert alert-info">
            Already have an account? <a class="alert-link" href="login.php">Login here.</a>
        </div>
    </div>
        
    </body>
</html>
