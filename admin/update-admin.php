<?php
//Connec header
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wraper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        //Step 1: Get the id of selected admin
        $id = $_GET["id"];
        //Step 2: create sql query to get the ditels
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";
        //Execute the query
        $result = mysqli_query($db_connection, $sql);
        //Check whether the query is executed successfully or not
        if($result == TRUE){
            //Check whether the data is available or not
            $count= mysqli_num_rows($result);

            //Check whether we have admin data or not
            if($count == 1){
                //Get the details
                //echo "Admin available";
                $row = mysqli_fetch_assoc($result);
                $full_name = $row["full_name"];
                $username = $row["username"];
            }
            else{
                //Redirect to manage admin page
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-20">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <!-- Password will be update in another page -->
                <!-- <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" value="">
                    </td>
                </tr> -->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" class="primary-btn" value="Update Admin">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//Check whether the submit button is clicked or not
if(isset($_POST["submit"])){
    //echo "Submit button click";
    //Get all the values from Form to update
    $id = $_POST["id"];
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];

    //Create a sql query to update admin
    $sql = "UPDATE tbl_admin SET id = '$id', full_name = '$full_name', username = '$username' WHERE id = '$id'";
    //Execute sql query
    $result = mysqli_query($db_connection, $sql);

    //Check whether the query executed successfullly or not
    if($result == TRUE){
        //Query executed and admin updated
        //Create session variable to display the message
        $_SESSION["update"] = "<div class='success'>Admin updated successfullly</div>";
        //Redirect to admin manage page
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
        //fail to executed query
        //Create a session variable to display the failure updated message
        $_SESSION["update"] = "<div class='error'>Failed to update admin. Try again later</div>";
        //Redirect to update admin page
        header("location:".SITEURL."admin/manage-admin.php");
    }
}

?>
<?php
//Connect footer
include("partials/footer.php");
?>