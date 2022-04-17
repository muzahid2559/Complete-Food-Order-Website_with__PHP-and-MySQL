<?php 
    //Connect menu
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wraper">
            <h1>Add Category</h1>
            <br>
            <?php 
            //Failed add catrgory message
            if(isset($_SESSION["add"])){
                echo $_SESSION["add"]; //Display error message
                unset($_SESSION["add"]); //Remove error message
            }

            //upload image error message
            if(isset($_SESSION["upload_image"])){
                echo $_SESSION["upload_image"];
                unset($_SESSION["upload_image"]);
            }
            ?>
            <br>
            <!-- Add category form start -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-20">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" class="primary-btn" value="Add Category">
                        </td>
                    </tr>
                </table>
            </form>
             <!-- Add category form end -->
             <?php 
                //Check whether the button is clicked or not
                if(isset($_POST["submit"])){
                    //echo "clicked";

                    //Step 1: Get the value from category form
                    $title = $_POST["title"];

                    //For featured radio button, we need to check whether the button is selected or not
                    if(isset($_POST["featured"])){
                        //Get the value from form
                        $featured = $_POST["featured"];
                    }
                    else{
                        //Set the default value
                        $featured = "No";
                    }

                     //For active radio button, we need to check whether the button is selected or not
                     if(isset($_POST["active"])){
                        //Get the value from form
                        $active = $_POST["active"];
                    }
                    else{
                        //Set the default value
                        $active = "No";
                    }

                    //Check whether the image is selected or not and set the value for image nmae accoridingly 
                    //print_r($_FILES["image"]);
                    //die();//Break the code here
                    if(isset($_FILES["image"]["name"])){
                        //Upload the image
                        //To Upload image we need image name, source path and destination path
                        $image_name = $_FILES["image"]["name"];

                        //Upload the image only if image is selected
                        if($image_name != ""){

                            //Auto rename our image
                            //Get the extention of our image (jpg png gif etc.) e.g "spicialfood1.jpg"
                            $extention = end(explode(".", $image_name));

                            //Rename the image
                            $image_name = "Food_Category".rand(000,999).".".$extention; // e.g Food_Category345.jpg

                            $source_path = $_FILES["image"]["tmp_name"];
                            $destination_path = "../images/category/".$image_name;

                            //finally upload the image
                            $upload_image = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //And if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload_image == FALSE){
                                //Set error message
                                $_SESSION["upload_image"] = "<div class='error'>Failed to upload image</div>";
                                //Redirect to add category page
                                header("location:".SITEURL."admin/add-category.php");
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else{
                        //Don't upload image and set the image_name value is blank
                        $image_name = "";
                    }

                    //Step 2: Create sql query to insert category into batabase
                    $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

                    //Step 3: Execute sql query
                    $result = mysqli_query($db_connection, $sql);

                    //Step 4: Check whether the query is executed or not ant data added or not
                    if($result == TRUE){
                        //Query executed and category added
                        // Successful Session message and redirect to manage category page
                        $_SESSION["add"] = "<div class='success'>Category added successful</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }
                    else{
                        //Fail to execute query and not added category 
                        //Failed session message and redirect to add category page
                        $_SESSION["add"] = "<div class='error'>Failed to add category. Please try again</div>";
                        header("location:".SITEURL."admin/add-category.php");
                    }
                }
             ?>
        </div>
    </div>
<?php 
    //Connect footer
    include("partials/footer.php");
?>