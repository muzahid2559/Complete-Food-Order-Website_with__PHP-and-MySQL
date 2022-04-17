<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wraper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
            // successfull message from session
            if(isset($_SESSION["add"])) // Checking whether the session is set or not
            {
                echo $_SESSION["add"]; // Displaying session message
                unset($_SESSION["add"]); // Removing session message 
            }
        ?>
        <form action="" method="Post">
            <table class="tbl-20">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Enter your user name">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="primary-btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
include("partials/footer.php");
?>
<?php
// process the value from Form and save it in database
// check whether the submit button is checked or not
if (isset($_POST['submit'])) {
    // echo "Buttpn click";

    //step 1: get the data from Form
    $full_name = $_POST["full_name"];
    $username = $_POST["user_name"];
    $password = md5($_POST["password"]); // password encryption with md5();

    // step 2: SQL query to save the data into database
    $sql = "INSERT INTO tbl_admin SET full_name = '$full_name', username = '$username', password = '$password'";

    // step 3: execute the query and save it in database
    $result = mysqli_query($db_connection, $sql);

    // step 4: check whether (query is executed) the data is inserted or not and display a proper message
    if($result == TRUE){
        // echo "Data inserted successfully";
        // create a session variable to display message
        $_SESSION["add"] = "<div class='success'>Admin Added Successfully</div>";
        // Redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

    }
    else{
        // echo "Data not inserted";
         // create a session variable to display message
         $_SESSION["add"] = "<div class='error'>Failed to Add Admin</div>";
         // Redirect page to add admin
         header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>