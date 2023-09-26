<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<!-- Variables -->
<?php
$defaults = array(
    "fullname" => "John Doe",
    "age" => "20",
    "gender" => "Male",
    "username" => "Username",
    "password" => "123",
    "confirm" => "123"
);
$genders = array("Male", "Female", "Others");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>

    <!-- icons css -->
    <link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.min.css">

    <!-- style sheet -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>

            <label class="logo">My Todo List</label>

            <ol>
                <li><a href="index.php">My List</a></li>
                <li><a href="./sign.php">Sign In</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<li><a class=\"active\" href='profile.php'>Profile</a></li>";
                }
                ?>
                <li>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "<a href='login.php?action=logout'>Logout</a>";
                    } else {
                        echo "<a href='login.php'>Login</a>";
                    }
                    ?>
                </li>
            </ol>
        </nav>
    </header>