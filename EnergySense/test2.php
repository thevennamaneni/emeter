 <?php
$servername = "192.168.1.100";
$username = "energysense";
$password = "energysense";
$dbname = "energysense";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT username, password, email FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["username"]. " - Name: " . $row["password"]. " " . $row["email"]. "<br>";
        if ($row["username"] == "sai") {
            echo "sai has been found";
        }
    }
} 
else {
    echo "0 results";
}

mysqli_close($conn);
?> 