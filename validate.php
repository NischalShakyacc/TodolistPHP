<?php
$genders = array("Male", "Female", "Others");
function showErrors($errors)
{
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}

function validate()
{
    $errors = array();
    if (strlen($_POST['fullname']) < 2) {
        $errors[] = "Name should have more than 2 characters.";
    }

    if ($_POST['age'] != strval(intval($_POST['age']))) {
        $errors[] = "Enter integer value in age.";
    }

    if (!in_array($_POST['gender'],$GLOBALS['genders'])){
        $errors[] = "Invalid Gender";
    }

    if (strlen($_POST['username'] < 5)) {
        $errors[] = "Username must be atleast 5 characters.";
    }

    if (strlen($_POST['password'] < 8)) {
        $errors[] = "Password should be more than 8 characters.";
    }
    if ($_POST['confirm'] != $_POST['password']) {
        $errors[] = "Password doesn't match.";
    }
    return $errors;
}
?>