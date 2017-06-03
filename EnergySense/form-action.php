<html>
<body>

<?php

$servername = "http://35.188.40.231";
$username = "energysense";
$password = "energysense";
$dbname = "energysense";
$LoginError = 1;
$usertype = 0;


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT username, password, email FROM users";
$result = mysqli_query($conn, $sql);

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    //echo "Everything's fine";  
    if (mysqli_num_rows($result) > 0) {
        //echo "<p>entered if</p>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        //echo "id: " . $row["username"]. " - Name: " . $row["password"]. " " . $row["email"]. "<br>";
        if ($row["username"] == $_POST["username"]) {
            $LoginError = 0;
        }
        else {
            $LoginError = 1;
        }
    }
} 

$sql = "SELECT password FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "<p>entered loop2</p>";
        //echo "id: " . $row["username"]. " - Name: " . $row["password"]. " " . $row["email"]. "<br>";
        if ($row["password"] == $_POST["password"]) {
            $LoginError = 0;
        }
        else {
            $LoginError = 1;
        }
    }
} 

}

else {
    header("Location: http://http://35.188.40.231/EnergySense/index.php");
    die();
}

if ($LoginError > 0) {
    //echo "login error";
    header("Location: http://http://35.188.40.231/EnergySense/index.php");
    die();

}

$sql = "SELECT type FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "<p>entered loop2</p>";
        //echo "id: " . $row["username"]. " - Name: " . $row["password"]. " " . $row["email"]. "<br>";
        if ($row["type"] == "customer") {
            //echo "<p>Hello Customer!";
            $usertype = 0;
        }
        elseif ($row["type"] == "admin") {
            //echo "<p>Hello Admin!";
            $usertype = 1;
        }
    }
}

if ($usertype == 0) {

    echo "<p>Hello Customer</p>";
}

elseif ($usertype == 1) {

    echo "<p>Hello Admin</p>";
}
//echo "<p>Welcome!</p>";
//echo $LoginError;

?>



</body>
</html> 