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

    $navn = $requestData['navn'];
    $etternavn = $requestData['etternavn'];
    $telefon = $requestData['telefon'];
    $mail = $requestData['mail'];
    $adresse = $requestData['adresse'];
    $postnr = $requestData['postnr'];

    $sql = "DELETE FROM brukerdata WHERE navn='$navn' AND etternavn='$etternavn' AND telefon='$telefon' AND mail='$mail' AND adresse='$adresse' AND postnr='$postnr'";

    if ($conn->query($sql) === TRUE) {
        echo "Dataen er nå fjernet fra databasen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
