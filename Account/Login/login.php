<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vaksineteam_accounts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$brukernavn = $_POST['brukernavn'];
$passord = $_POST['passord'];

$hashed_password = password_hash($passord, PASSWORD_DEFAULT);

$sql = "SELECT * FROM brukerdata WHERE brukernavn='$brukernavn'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['passord'];

    if (password_verify($passord, $stored_password)) {
        setcookie('loggedIn', 'true', time() + 60 * 2, '/');
        echo "Velkommen inn.";
        exit();
    } else {
        die("Du har skrevet inn feil passord.");
    }
} else {
    die("Brukeren finnes ikke.");
}

$conn->close();
?>
