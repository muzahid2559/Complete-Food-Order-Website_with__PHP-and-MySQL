<?php
    //Connect menu
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wraper">
            <h1>Update Category</h1>
            <br>

            <?php 
                //Check whether id is set or not
                if(isset($_GET["id"])){
                    //Get the id and all other details
                    //echo "Getting the data";
                    $id = $_GET["id"];
                    
                    //Sql query to get all other details
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    //Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    //Count the rows to check whether the id is valid or not
                    $count = mysqli_num_rows($result);

                    if($count == 1){
                        //Get all the data
                        $row = mysqli_fetch_assoc($result);
                        $title = $row["title"];
                        $current_image = $row["image_name"];
                        $featured = $row["featured"];
                        $active = $row["active"];
                    }
                    else{
                        //Redirect to manage category with session message
                        $_SESSION["no-category-found"] = "<div class='error'>Category not found</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }
                }
                else{
                    //Give unathoriza message to manage category page using session mession
                    $_SESSION["unathrize-message"] = "<div class='error'>Unauthorize access</div>";
                    //Redirect to manage category page
                    header("location:".SITEURL."admin/manage-category.php");
                }
            ?>

            <!-- Update category form start -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-20">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image != ""){
                                    //Display the image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                }
                                else{
                                    //Display error message
                                    echo "<div class='error'>Image not added</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes"){ echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes 

                            <input <?php if($featured == "No"){ echo "checked"; } ?> type="radio" name="featured" value="No"> No 
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == "Yes"){ echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes 
                            
                            <input <?php if($active == "No"){ echo "checked"; } ?> type="radio" name="active" value="No"> No 
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="primary-btn">
                        </td>
                    </tr>
                </table>

            </form>
            <br>
            <?php
                //Check whether the submit button is clicked or not
                if(isset($_POST["submit"])){
                    //Update category button clicked
                    //echo "update category button is clicked";
                    //Step 1: Get all the values from our form
                    $id = $_POST["id"];
                    $title = $_POST["title"];
                    $current_image = $_POST["current_image"];
                    $featured = $_POST["featured"];
                    $active = $_POST["active"];

                    //Step 2: Updating new image if selected
                    //Check whether the image is selected or not
                    if(isset($_FILES["image"]["name"])){
                        //Get the image details
                        $image_name = $_FILES["image"]["name"];
                        //Check whether the image is available or not
                        if($image_name != ""){
                            //Image available

                            //A. Upload the new image
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
                                header("location:".SITEURL."admin/manage-category.php");
                                //Stop the process
                                die();
                            }

                            //B. Remove the current image if available
                            if($current_image!=""){

                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);

                                //Check whether the image is remove or not
                                //If failed to remove then display message and stop the process
                                if($remove == FALSE){
                                    //Failed to remove image
                                    $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current image</div>";
                                    header("location:".SITEURL."admin/manage-category.php");
                                    die();
                                }
                            } 
                        }
                        else{
                            $image_name = $current_image;  
                        }
                    }
                    else{
                        $image_name = $current_image;
                    }

                    //Step 3: Update the database
                    $sql2 = "UPDATE tbl_category SET title='$title',image_name='$image_name', featured='$featured', active='$active' WHERE id=$id";

                    //Execute the query
                    $result2 = mysqli_query($db_connection, $sql2);

                    //Step 4: Redirect to manage category page with message
                    //Check whether query executed or not
                    if($result2 == TRUE){
                        //Category updated
                        //Successfull session message and redirect to manage admin page
                        $_SESSION["update"] = "<div class='success'>Category updated successfully</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }
                    else{
                        //Failed to upload category
                        //Failed session message and redirect to manage admin page
                        $_SESSION["update"] = "<div class='error'>Failed to updated Category</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }

                }
            ?>
        </div>
    </div>
<?php
    //Connect footer
    include("partials/footer.php");
?>