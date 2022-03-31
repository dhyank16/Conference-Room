<html>
    <head>
        <title>Check Users Quota</title>
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
            table {
                border-collapse: collapse;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 30px;
                margin-top: 30px;
            }
            tr, td, th {
                border: 2px dashed rebeccapurple;
                font-size: large;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-variant: small-caps;
                padding: 20px;
            }

        </style>
        </head>

        <body>
            
        <?php
        include('navbar.php');
        ?>

        <table>
        <tr>
            <th>User ID</th>
            <th>Company Name</th>
            <th>Time Used in this Month</th>
            <th>Time Remaining to be Used in this Month</th>
        </tr>
        
        <?php
           $month = (int) date('m');
           

            $sql = "SELECT count(booking_id) AS count, user_id from bookings where MONTH(date)=$month group by (user_id)";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                $uid = $row['user_id'];
                $sql1 = "SELECT company_name from users where user_id = $uid";
                $result1 = mysqli_query($conn, $sql1);
                
                $row1 = mysqli_fetch_assoc($result1);
                echo "<tr><td>".$row['user_id']."</td><td>".$row1['company_name']."</td><td>".$row['count']."</td><td>".(10 - $row['count'])."</td></tr>";
            }

        ?>
        </table>

        
        </body>