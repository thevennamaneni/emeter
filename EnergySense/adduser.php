 <?php
$servername = "http://35.188.40.231";
$username = "energysense";
$password = "energysense";
$dbname = "energysense";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['type']) && !empty($_POST['uid'])) {

$sql = "INSERT INTO users (username, password, email, address, type, uid) 
VALUES (\"{$_POST['username']}\",\"{$_POST['password']}\",\"{$_POST['email']}\",\"{$_POST['address']}\",\"{$_POST['type']}\",\"{$_POST['uid']}\")";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "CREATE TABLE {$_POST['uid']} (
timesec TIME(6) NOT NULL,
current INT(30) NOT NULL,
energy INT(30) NOT NULL,
status VARCHAR(3) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "New table created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

}


?> 