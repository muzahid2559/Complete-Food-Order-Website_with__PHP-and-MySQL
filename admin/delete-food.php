<?php 

    // Database connection
    include("../config/database.php");

    //echo "Delete food page is connected";
    if(isset($_GET["id"]) && isset($_GET["image_name"])){ // Either use && or AND
        // Process to delete
        //echo "Process to delete";

        // Step 1: Get id and image name
        $id = $_GET["id"];
        $image_name = $_GET["image_name"];

        // Step 2: Remove the image if available
        // check whether the  image is available or not and delete only if available
        if($image_name != ""){
            // It has image and remove from folder

            // Get the image path
            $path = "../images/food/".$image_name;

            // Remove image file from folder
            $remove = unlink($path);

            // Check whether the image is remove or not
            if($remove == false){
                // Failed to remove image
                
                // Session message and redirect to manage food page
                $_SESSION["remove-failed"] = "<div class='error'>Failed to remove image file</div>";
                header("location:".SITEURL."admin/manage-food.php");

                // Stop the process of deleting food
                die();
            }
        } 

        // Step 3: Delete food from database

        // Delete query
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // Execute the query
        $result = mysqli_query($db_connection, $sql);

        // Step 4: Redirect to manage food with session message
        // Check whether the qurey successfully executed or not and set the session message respectively
        if($result == true){
            // Food deleted successfully
            // Successful session message and redirect to manage food page
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else{
            // Failed to delete food
            // Failed session message and redirect to manage food page
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
    }
    else{
        // Redirect to manage food page
        //echo "Redierct";
        $_SESSION["unauthorize"] = "<div class='error'>Unauthorize Access</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>