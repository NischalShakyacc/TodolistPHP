<?php
function sanitizeData()
{
    $_POST['fullname'] = htmlentities($_POST['fullname']);
    $_POST['age'] = htmlentities($_POST['age']);
    $_POST['gender'] = htmlentities($_POST['gender']);
    $_POST['username'] = htmlentities($_POST['username']);
    $_POST['password'] = htmlentities($_POST['password']);
    $_POST['confrim'] = htmlentities($_POST['confirm']);
}
?>