<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vaksineteam";

$conn = new mysqli($servername, $username, $password, $dbname);

# Sjekk etter connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM brukerdata";
$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);

$conn->close();
?>