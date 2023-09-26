<?php
include("./header.php");

include('./validate.php');
include('./sanitize.php');
?>
<main>
    <section>
        <div class="imageBox">
            <img src="./Images/signup.jpg" />
        </div>
        <div class="contentBox">
            <div class="formBox">
                <h2 class='title'>Sign Up</h2>

                <?php
                if (isset($_POST['__CHECK__'])) {
                    $defaults = $_POST;
                    sanitizeData();
                    //"sanitized"
                    if ($errors = validate()) {
                        //"contains errors"
                        showErrors($errors);
                        showForm();
                    } else {
                        //echo "good";
                        saveData();
                    }
                } else {
                    showForm();
                }
                ?>
            </div>
        </div>
    </section>
</main>
</body>
</html>

<?php
function showform()
{
    global $genders;
    global $defaults;
    echo <<<__HTML1__
        <form action="$_SERVER[PHP_SELF]" method="POST">
        <table>
            <tr>
                <td class="inputBox"><label for="name">Full Name</label></td>
                <td class="inputBox"><input type="text" name="fullname"  value="$defaults[fullname]"></td>
            </tr>
            <tr>
                <td class="inputBox"><label for="age">Age</label></td>
                <td class="inputBox"><input type="text" name="age" id="age" value="$defaults[age]"></td>
            </tr>
            <tr>
                <td class="inputBox"><label for="gender">Gender</label></td>
                <td>
__HTML1__;
    foreach ($genders as $gender) {
        echo "<input class=\"inputBox\" type='radio' name='gender' value='$gender' ";
        if ($gender == $defaults['gender']) {
            echo "checked";
        }
        echo " > $gender";
    }

    echo <<<__HTML2__
        </td>
        </tr>
        
__HTML2__;

    echo <<<__HTML3__
            <tr>
                <td class="inputBox">Username</td>
                <td class="inputBox"><input type='text' name='username' value="$defaults[username]"/>
            </tr>
            <tr>
                <td class="inputBox">Password</td>
                <td class="inputBox"><input type='password' value="$defaults[password]" name='password'/>
            </tr>
            <tr>
                <td class="inputBox">Confirm</td>
                <td class="inputBox"><input type='password' value="$defaults[confirm]" name='confirm'/>
            </tr>
            <input type="hidden" name="__CHECK__"/>
            
            <tr>
                <td colspan='2'>
                <button class="btn" type="submit" name="submit">Submit</button>
                <?td>
            </tr>
        </table>
    </form>
__HTML3__;
}

function saveData()
{
    $connection = mysqli_connect("localhost", "root", "", "todolist");
    if (!$connection) {
        die("Could not connect to database server" . mysqli_connect_error());
    }

    $query = "INSERT INTO users (id, Name,  Age, Gender, Username, Password) values (' ','$_POST[fullname]', $_POST[age],'$_POST[gender]','$_POST[username]','$_POST[password]')";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query unsucsessful" . mysqli_error($connection));
    }
    mysqli_close($connection);
    echo "Insert Successful";
    showForm();
}
?>