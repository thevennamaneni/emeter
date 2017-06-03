 <?php
$servername = "192.168.1.100";
$username = "energysense";
$password = "energysense";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?> 