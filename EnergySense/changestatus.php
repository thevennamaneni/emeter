<?php



//echo 'Hello ' . htmlspecialchars($_GET["uid"]) . '!';

$con=mysqli_connect("104.154.121.180","energysense","energysense","energysense");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
$queryString = "SELECT status FROM " . $_GET["uid"] . " ORDER BY id DESC limit 1";
//echo $queryString;
$result = mysqli_query($con,$queryString);
while($new_row = mysqli_fetch_array($result)) {

                  //echo $new_row['status'];
                  if ($new_row['status'] == "ON") {
                      //echo "True";
                      $queryString1 = "UPDATE " . $_GET["uid"] . " SET status = 'OFF' WHERE id = (SELECT MAX(id))";
                      //echo $queryString1;
                      $result1 = mysqli_query($con,$queryString1);
                      //echo $result1;
                  }
                  if ($new_row['status'] == "OFF") {
                      //echo "True";
                      $queryString1 = "UPDATE " . $_GET["uid"] . " SET status = 'ON' WHERE id = (SELECT MAX(id))";
                      //echo $queryString1;
                      $result1 = mysqli_query($con,$queryString1);
                      //echo $result1;
                  }

                }


?>

<html lang="en">

<head>
<meta charset="UTF-8">

<!-- Redirecting To the Login Page -->
<meta http-equiv="refresh" content= "0; url='../test5.php'"/>

</head>
</html>
