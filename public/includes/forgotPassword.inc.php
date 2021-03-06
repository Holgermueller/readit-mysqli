<?php

if(isset($_POST['forgot-password-submit'])) {

    require "dbh.inc.php";

    $username = $_POST['forgot-password-username'];
    $email = $_POST['forgot-password-email'];

    $selectorToken = bin2hex(random_bytes(8));

    $authenticatorToken = random_bytes(32);

    $url = "www.readit-mysqli/forgotPassword/changePassword.php?selectorToken=" . $selectorToken . "&authenticatorToken=" . bin2hex($authenticatorToken);

    $expires = date("U") + 1800;

    if(empty($username) || empty($email)) {
        header("Location: ../forgotPassword.php?error=emptyfields");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../forgotPassword.php?error=invalidemailandusername");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../forgotPassword.php?error=invalidemail");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../forgotPassword.php?error=invalidusername");
        exit();
    }

} else {
    header("Location: ../forgotPassword.php");
    exit();
}

?>