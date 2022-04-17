<?php
//Connect header
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wraper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-20">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" class="primary-btn" value="Change Password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
//Check whether submit button is clicked or not
if (isset($_POST["submit"])) {
    //echo "Clicked";

    //Step 1: Get the data from Form
    $id = $_POST["id"];
    $current_password = md5($_POST["current_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

    //Step 2: Check whether the user with current id and current password  exists or not
    //Sql query
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";
    //Execute the query
    $result = mysqli_query($db_connection, $sql);
    //Check whether the query is executed successfully or not
    if ($result == TRUE) {
        //Check whether data is avaliable or not
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            //User exist and password can be changed
            //echo "user found";
            //Check whether the new possword and confirm password match or not
            if ($new_password == $confirm_password) {
                //Sql query to Update the password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                //Execute the query
                $result2 = mysqli_query($db_connection, $sql2);
                //Check whether the query is executed or not
                if ($result2 == TRUE) {
                    //Display success message
                    //echo "password will be change";
                    //Redirect to manage admin page with success message
                    $_SESSION["change-password"] = "<div class='success'>Password change successfully</div>";
                    //Redirect to user
                    header("location:" . SITEURL . "admin/manage-admin.php");
                } 
                else {
                    //Display error message
                    //Redirect to manage admin page with error message
                    $_SESSION["change-password"] = "<div class='error'>Failed to change password</div>";
                    //Redirect to user
                    header("location:" . SITEURL . "admin/manage-admin.php");
                }
            } else {
                //Redirect to manage admin page with error message
                $_SESSION["password-not-match"] = "<div class='error'>Password did not match</div>";
                //Redirect to user
                header("location:" . SITEURL . "admin/manage-admin.php");
            }
        }
        else {
            //User does not exist Set message and redirect
            $_SESSION["user-not-found"] = "<div class='error'>User not found</div>";
            //Redirect the user to manage admin page
            header("location:" . SITEURL . "admin/manage-admin.php");
        }
    }

    //Step 3: Check whether the new password and confirm password match or not
    //Step 4: Change password if all above is true
}
?>
<?php
//Connect footer
include("partials/footer.php");
?>