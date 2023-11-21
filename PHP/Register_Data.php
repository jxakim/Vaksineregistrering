<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vaksineteam";

$conn = new mysqli($servername, $username, $password, $dbname);

# Sjekk etter connection errrors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Sjekker etter post requests og tar inn daten fra requestn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $navn = $_POST['navn'];
    $etternavn = $_POST['etternavn'];
    $telefon = $_POST['telefon'];
    $mail = $_POST['mail'];
    $adresse = $_POST['adresse'];
    $postnr = $_POST['postnr'];
    
    # Kjør sql kode for å legge innd enne dataen
    $sql = "INSERT INTO brukerdata (navn, etternavn, telefon, mail, adresse, postnr) VALUES ('$navn', '$etternavn', '$telefon', '$mail', '$adresse', '$postnr')";

    if ($conn->query($sql) === TRUE) {
        echo "Dataen er nå lagt til i databasen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
