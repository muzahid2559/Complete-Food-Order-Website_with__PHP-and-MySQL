<?php
// Connection database
include("../config/database.php");

//Step 1: Get the id of admin to be deleted
$id = $_GET["id"];

//Step 2: Create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";

//Execute the query
$result = mysqli_query($db_connection, $sql);

//Check whether the query is executed successfully or not
if ($result == TRUE) {
    //Query executed successfully and admin deleted
    //echo "Admin deleted successfully";
    //Create session variable to display the message
    $_SESSION["delete"] = "<div class='success'>Admin deleted successfully</div>";
    //Redirect to manage admin page
    header("location:" . SITEURL . "admin/manage-admin.php");
} else {
    //Failed to delete admin
    //echo "Failed to deleted admin";
    //Create session variable to display message
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
    //Redirect to manage admin page
    header("location:" . SITEURL . "admin/manage-admin.php");
}

//Step 3: Redirect to manage admin page with message (success or not)
?>