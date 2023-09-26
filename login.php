<?php
include("./header.php");
?>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        unset($_SESSION['user']);
        setcookie('user', $username, time() - 1);
        setcookie('pass', $password, time() - 1);
        header("Location: index.php");
    }
}
?>
<main>
    <section>
        <div class="imageBox">
            <img src="./Images/logind.webp" />
        </div>

        <div class="contentBox">
            <div class="formBox">
                <h2 class='title'>Login</h2>
                <?php
                if (isset($_POST['__CHECK__'])) {
                    //user logged in;
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $connect = mysqli_connect("localhost", "root", "", "todolist");
                    if (!$connect) {
                        echo "Connection Error" . mysqli_connect_error();
                    }

                    $query = "select * from users where username='$username' and password='$password'";
                    
                    $result = mysqli_query($connect, $query);
                    if (!$result) {
                        die(mysqli_error($connect));
                    }
                    if (!mysqli_num_rows($result)) {
                        echo "Invalid Login Information";
                        showLoginForm();
                    } else {
                        if (isset($_POST['remember'])) {
                            setcookie('user', $username, time() + (60 * 60 * 1));
                            setcookie('pass', $password, time() + (60 * 60 * 1));
                        }

                        $_SESSION['user'] = mysqli_fetch_assoc($result);
                        header("Location: profile.php");
                    }
                } else {
                    showLoginForm();
                }
                ?>
            </div>
        </div>
    </section>
</main>
</body>
</html>

<?php
function showLoginForm()
{
    echo <<<__HTML__
    <form action="$_SERVER[PHP_SELF]" id="login" method="post">
    <table>
        <tr>
            <td class="inputBox"><label for="username">Username</label></td>
            <td class="inputBox"><input type="text" name="username" id="username" 
__HTML__;
    if (isset($_COOKIE['user'])) {
        echo "value =" . $_COOKIE['user'];
    }
    echo <<<__HTML1__
    ></td>
        </tr>
        <tr>
            <td class="inputBox"><label for="password">Password</label></td>
            <td class="inputBox"><input type="password" name="password" id="password" 
__HTML1__;
    if (isset($_COOKIE['pass'])) {
        echo "value =" . $_COOKIE['pass'];
    }
    echo <<<__HTML2__
            ></td>
        </tr>
        <tr class="remember">
            <td colspan="2">
            <input type='checkbox' name='remember'/>Remember me
            </td>
        </tr>
        <tr>
            <td  class="inputBox" colspan='2'><button type="submit" class="btn">Log In</button></td>
        </tr>
        <tr>
            <td  class="inputBox" colspan='2'><p>Dont have an account? </p><button class="btn"><a href="sign.php">Sign Up</a></button></td>
        </tr>
        <tr>
            <td><input type="hidden" name="__CHECK__"></td>
        </tr>
    </table>
    </form>
__HTML2__;
}
?>