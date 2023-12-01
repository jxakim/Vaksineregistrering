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

    $brukerId = $requestData['brukerId'];

    $sql1 = "DELETE FROM brukerdata WHERE brukerId='$brukerId'";
    $sql2 = "DELETE FROM avtale WHERE brukerId='$brukerId'";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Dataen er nå fjernet fra databasen.";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}

$conn->close();
?>
