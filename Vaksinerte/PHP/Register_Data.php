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
    $vaksineId = $_POST['vaksineId'];
    $brukerId = $_POST['brukerId'];
    $ansattId = $_POST['ansattId'];
    $lokasjon = $_POST['lokasjon'];
    $tid = $_POST['tid'];
    $dato = $_POST['dato'];

    $sql = "INSERT INTO vaksinerte (vaksineId, brukerId, ansattId, lokasjon, tid, dato) VALUES ('$vaksineId', '$brukerId', '$ansattId', '$lokasjon', '$tid', '$dato')";

    if ($conn->query($sql) === TRUE) {
        echo "Dataen er nå lagt til i databasen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
