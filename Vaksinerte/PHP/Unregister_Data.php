<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vaksineteam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $vaksineId = $requestData['vaksineId'];

    $sql = "DELETE FROM vaksinerte WHERE vaksineId='$vaksineId'";

    if ($conn->query($sql) === TRUE) {
        echo "Dataen er nå fjernet fra databasen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
