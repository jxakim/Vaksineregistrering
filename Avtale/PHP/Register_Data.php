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
    $brukerId = $_POST['brukerId'];
    $navn = $_POST['navn'];
    $etternavn = $_POST['etternavn'];
    $telefon = $_POST['telefon'];
    $dato = $_POST['dato'];
    $tid = $_POST['tid'];
    $lokasjon = $_POST['lokasjon'];

    $sql1 = "INSERT INTO brukerdata (brukerId, navn, etternavn, telefon) VALUES ('$brukerId', '$navn', '$etternavn', '$telefon')";
    $sql2 = "INSERT INTO avtale (brukerId, dato, tid, lokasjon) VALUES ('$brukerId', '$dato', '$tid', '$lokasjon')";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Dataen er nå lagt til i databasen.";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}

$conn->close();
?>
