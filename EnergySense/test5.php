<?php

echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <title>EnergySense: Admin</title>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"./css/bootstrap.min.css\">
  <script src=\"./jquery-3.2.0.min.js\"></script>
  <script src=\"./js/bootstrap.min.js\"></script>
</head>
<body>

<nav class=\"navbar navbar-inverse navbar-static-top\">
    <div class=\"container\">
     <a class=\"navbar-brand text-center center-block\" href=\"./index.php\">EnergySense</a>
</nav>

<style>
.navbar-brand {
  float: none;
}
</style>

<div class=\"container\">
  <h2>Control Center</h2>
  <p>List of customers and their information</p>
  <table class=\"table\">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Address</th>
        <th>Type</th>
        <th>Device ID</th>
        <th>Energy Consumed</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody> ";
    

        $con=mysqli_connect("104.154.121.180","energysense","energysense","energysense");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($con,"SELECT * FROM users");


        while($row = mysqli_fetch_array($result))
        {
                $uniqueID = $row['uid'];
                $inStr = "SELECT * FROM $uniqueID ORDER BY id DESC limit 1";
                //echo $inStr;
                $getreading = mysqli_query($con, $inStr);

                 while($new_row1 = mysqli_fetch_array($getreading)) {

                   if ($new_row1['status'] == "ON") {
                     echo "<tr class=\"success\">";
                   }
                   if ($new_row1['status'] == "OFF") {
                     echo "<tr class=\"danger\">";
                   }
                 }

                

                
                echo "<td>" . $row['username'] . "</td>";
                //echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['uid'] . "</td>";
                $uniqueID = $row['uid'];
                $inStr = "SELECT * FROM $uniqueID ORDER BY id DESC limit 1";
                //echo $inStr;
                $getreading = mysqli_query($con, $inStr);
                while($new_row = mysqli_fetch_array($getreading)) {

                  echo "<td>" . $new_row['energy'] . "</td>";
                  echo "<td> <a href=\"./changestatus.php/?uid=" . $row['uid'] . "\">" . $new_row['status'] . "</a></td>";
                }
                echo "</tr>";
            }
   
      
  echo   "</tbody>
  </table>
</div>

</body>
</html>";

 ?>