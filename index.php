<?php
session_start();
?>

<!-- insert task to database -->
<?php
$connect = mysqli_connect("localhost", "root", "", "todolist") or die("Connection Error");

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $task = htmlentities($task);

    $username = $_SESSION["user"]["Username"]; 
    if (empty($task)) {
        $errors = "Please fill in the task";
    } else {
        mysqli_query($connect, "INSERT INTO list VALUES ('','$username','$task');") or die("Query Error");

        header("Location: index.php");
    }
}
if (isset($_SESSION['user'])) {
    $username = $_SESSION["user"]["Username"];
    $tasks = mysqli_query($connect, "SELECT * FROM list where Username='$username' ;");
}

//delete
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $id = $_GET['task'];
        mysqli_query($connect, "DELETE FROM list WHERE id=$id ;");
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

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
    <main>
        <section>
            <div class="imageBox">
                <img src="./Images/signup.webp" />
            </div>

            <div class="contentBox"> 
                <div class="formBox fixit">
                    <h2 class='title'>My Todo List</h2>

                    <?php
                    if (!isset($_SESSION['user'])) {
                        die("<div>Please <button class='btn'><a href='login.php'>Login</a></button> to continue</div>");
                    }
                    ?>
                    <!-- add task -->

                    <form action="<?php echo "$_SERVER[PHP_SELF]" ?>" method="POST">
                        <table>
                            <?php
                            if (isset($errors)) {
                                echo "<p class = 'error'>$errors</p>";
                            }
                            ?>
                            <tr>
                                <td class="inputBox"><input type="text" name="task"></td>
                            </tr>
                            <tr>
                                <td><button class="btn" type="submit" name="submit">Add Task</button></td>
                            </tr>
                        </table>
                    </form>
                    <div class="wrapper">
                    <table class="list ">
                        <thead>
                            <tr>
                                <th class="inputBox">Sn.</th>
                                <th class="inputBox">Task</th>
                                <th class="inputBox actionComplete">Complete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            if (empty($row = mysqli_fetch_array($tasks))) {
                                echo <<<__HTML__
                                <tr>
                                    <td class="inputBox"> </td>
                                    <td class="inputBox" class="task">Add tasks to do.</td>
                                    <td></td>
                                </tr>
__HTML__;
                            }
                            while ($row = mysqli_fetch_array($tasks)) {
                                
                                $i++;
                                $id = $row['id'];
                                echo <<<__HTML1__
            <tr>
                <td class="inputBox">$i</td>
                <td class="inputBox" class="task">$row[task]</td>
                <td class="inputBox"><button class="done-btn">
                <a href="index.php?action=delete&task=$row[id]">Done</a></button></td>
            </tr>
__HTML1__;
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
    </main>

</body>

</html>