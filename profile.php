<?php
include('./header.php');
?>
<main>
    <section>
        <div class="imageBox">
            <img src="./Images/profile.jpg" />
        </div>

        <div class="contentBox">
            <div class="formBox">
                <h2 class='title'>My Profile</h2>
                <table>
                    <tr>
                        <td class="inputBox">Name:</td>
                        <td class="inputBox"><?php echo $_SESSION['user']['Name'] ?></td>
                    </tr>
                    <tr>
                        <td class="inputBox">Age:</td>
                        <td class="inputBox"><?php echo $_SESSION['user']['Age'] ?></td>
                    </tr>
                    <tr>
                        <td class="inputBox">Gender:</td>
                        <td class="inputBox"><?php echo $_SESSION['user']['Gender'] ?></td>
                    </tr class="inputBox">
                    <tr>
                        <td class="inputBox">Username:</td>
                        <td class="inputBox"><?php echo $_SESSION['user']['Username'] ?></td>
                    </tr>
                    <tr>
                        <td colspan='2' class="inputBox">
                            <button class="btn"><a href="index.php">Todo List</a></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</main>
</body>
</html>