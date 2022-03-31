<html>
    <head>
        <title>Book Conference Room</title>
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
        </head>

        <body>
            
        <?php
        include('navbar.php');
        if(isset($_POST['book_conf']))
        {
            $uid = $_SESSION['login_user'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $conf = $_POST['conf'];

            $sql = "SELECT * from bookings where date = '$date' AND time_slot = '$time' and conf_room = '$conf'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            if($count == 1) 
            {
            
                echo "<div class='alert alert-danger'>Already Booked for this Slot!</div>";;

            }
            else
            {
            $sql1 = "INSERT INTO bookings (user_id,conf_room,time_slot,date) VALUES ('$uid','$conf','$time','$date')";
                $result1 = mysqli_query($conn,$sql1);

                if($result1)
                {
                    echo
                    "<div class='alert alert-success'>Success! Conference Room Booked for '$time'</div>"; 
                } 
                else {
                    echo "<div class='alert alert-danger'>ERROR: Could not insert values ".mysqli_error($conn)."</div>";
                }
        }}
        ?>
        <?php
           $month = (int) date('m');

            $uid = $_SESSION['login_user'];
            $sql = "SELECT count(*) AS count from bookings where MONTH(date)=$month AND user_id = $uid";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo
            '<h1> Remaining Hours:'.(10 - $row['count']).'</h1>';

        ?>
                <div class="container">
                <h2 class="alert alert-primary">Book Your Conference Room</h2>
                    <div class="row">
                        <div class="col">
                            <form action="" name = "form1" method="post">
                                <div class="form-group">
                                <div class="form-group">
                                    <input type="date" class = "form-control" name = "date">
                                </div>
                                <br>
                                <select class="form-select" name="time" aria-label="Default select example">
                                    <option selected>Select Your Time Here</option>
                                    <option value="10">10:00 am to 11:00 am</option>
                                    <option value="11">11:00 am to 12:00 pm</option>
                                    <option value="12">12:00 pm to 1:00 pm</option>
                                    <option value="1">1:00 pm to 2:00 pm</option>
                                    <option value="2">2:00 pm to 3:00 pm</option>
                                    <option value="3">3:00 pm to 4:00 pm</option>
                                    <option value="4">4:00 pm to 5:00 pm</option>
                                    <option value="5">5:00 pm to 6:00 pm</option>
                                    <option value="6">6:00 pm to 7:00 pm</option>
                                    <option value="7">7:00 pm to 8:00 pm</option>
                                    <option value="8">8:00 pm to 9:00 pm</option>
                                    <option value="9">9:00 pm to 10:00 pm</option>
                                </select>
                                </div>
                                
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="conf" value="A" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">Conference Room A</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="conf" value="B" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">Conference Room B</label>
                                </div>
                                <br>
                                <input class="btn btn-primary" type="submit" name="book_conf" value="Book Conference Room">
                        </div>
                    </div>
                    </form>
        </body>