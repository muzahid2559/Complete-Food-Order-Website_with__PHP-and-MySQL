<?php 
    //Include database.php because there is site url (constant) file
    include("../config/database.php");
    //echo "Delete";
    //Check whether the id and image_name value is set or not
    if(isset($_GET["id"])AND isset($_GET["image_name"])){
        //Get the value and delete
        //echo "Get value and delete";
        $id = $_GET["id"];
        $image_name = $_GET["image_name"];

        //remove the physical image file if available
        if($image_name != ""){
            //Image is available and rimove it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove == FALSE){
                //Set the session message
                $_SESSION["remove"] = "<div class='error'>Failed to remove image</div>";
                //Redirect to manage category page
                header("location:".SITEURL."admin/manage-category.php");
                //Stop the process
                die();
            }
        }
        //Delete data from database
        //Sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $result = mysqli_query($db_connection, $sql);

        //Check whether the data is delete from database or not
        if($result == TRUE){
            //Set success message and redirect
            $_SESSION["delete"] = "<div class='success'>Category deleted successfully</div>";
            //Redirect to manage category page
            header("location:".SITEURL."admin/manage-category.php");
        }
        else{
            //Set fail message and redirect
            $_SESSION["delete"] = "<div class='error'>Failed to delete category</div>";
            //Redirect to manage category page
            header("location:".SITEURL."admin/manage-category.php");
        }
    }
    else{
        //Redirect to manage category page
        header("location:".SITEURL."admin/manage-category.php");
    }
?>