<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vaksineteam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT vaksineId, brukerId, ansattId, lokasjon, dato, tid FROM vaksinerte;";

$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(array());
} elseif ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}

$conn->close();
?>
