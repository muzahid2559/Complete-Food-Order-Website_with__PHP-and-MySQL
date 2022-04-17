<?php 
    // Connect menu
    include("partials/menu.php");
?>

<?php 
    // Check whether id is set or not
    if(isset($_GET["id"])){
        // Get all the details
        $id = $_GET["id"];

        // Sql query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        // Execute the query
        $result2 = mysqli_query($db_connection, $sql2);

        // Get the value based on query executed
        $row2 = mysqli_fetch_assoc($result2);

        // Get the individuals values of selected food
        $title = $row2["title"];
        $description = $row2["description"];
        $price = $row2["price"];
        $current_image = $row2["image_name"];
        $current_category = $row2["category_id"];
        $featured = $row2["featured"];
        $active = $row2["active"];
    }
    else{
        // Redirect to manage food page
        header("location:".SITEURL."admin/manage-food.php");
    }
?>

    <div class="main-content">
        <div class="wraper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-20">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="4"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php 
                                // Check whether image is available or not
                                if($current_image == ""){
                                    // Image not available
                                    // Display erroe message
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else{
                                    // Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                    // Sql query to get active category
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    // Execute the query
                                    $result = mysqli_query($db_connection, $sql);

                                    // Count rows
                                    $count = mysqli_num_rows($result);

                                    // Check whether category available or not
                                    if($count > 0){
                                        // Category available
                                        while($row = mysqli_fetch_assoc($result)){
                                            $category_title = $row["title"];
                                            $category_id = $row["id"];

                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>

                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>

                                            <?php
                                           
                                        }
                                    }
                                    else{
                                        // Category not available
                                        echo "<option value='0'>Category not available</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active == "No"){echo "Checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="primary-btn">
                        </td>
                    </tr>

                </table>
            </form>

                <?php 
                
                    // Checked whether the button is clicked or not
                    if(isset($_POST["submit"])){
                        // Start working process
                        //echo "Update food button clicked";

                        // Step 1: Get all the details from the form
                        $id = $_POST["id"];
                        $title = $_POST["title"];
                        $description = $_POST["description"];
                        $price = $_POST["price"];
                        $current_image = $_POST["current_image"];
                        $category = $_POST["category"];
                        $featured = $_POST["featured"];
                        $active = $_POST["active"];

                        // Step 2: Upload the image if selected
                        // Check whether select new image upload button is clicked or not
                        if(isset($_FILES["image"]["name"])){
                            // Button clicked
                            $image_name = $_FILES["image"]["name"]; // New image name

                            // Check whether the file is available or not
                            if($image_name != ""){
                                // Image is available
                                //A. Uploding new image

                                // Rename the image
                                // Get extention the image
                                $extention = end(explode(".", $image_name));
                                // Rename the image
                                $image_name = "Food_Name".rand(000,999).".". $extention;

                                // Upload the image
                                // Create source and destination path
                                $source_path = $_FILES["image"]["tmp_name"]; // Source path
                                $destination_path = "../images/food/".$image_name; // Destination path

                                // Finally upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                // Check whether image file uploaded or not
                                if($upload == false){
                                    // Failed to upload new image file
                                    // Faile session message and redirect to maage food page
                                    $_session["upload-failed"] = "<div class='error'>Failed to upload new image</div>";
                                    header("location:".SITEURL."admin/manage-food.php");

                                    // Stop the process
                                    die();
                                }

                                // Step 3: Remove the image if new image is uploaded and current image exist
                                // B: Remove the current image if available
                                if($current_image != ""){
                                    // Current image is available

                                    // Remove the image
                                    $remove_path = "../images/food/".$current_image;
                                    $remove = unlink($remove_path);

                                    // Check whether the current image remove or not
                                    if($remove == false){
                                        // Failed to remove current image

                                        // Session message and redirect to manage food page
                                        $_SESSION["remove-failed"] = "<div class='error'>Failed to remove current image</div>";
                                        header("location:".SITEURL."admin/manage-food.php");

                                        // Stpo the proess
                                        die();
                                    }
                                }
                            }
                            else{
                                $image_name = $current_image; // Default image when image is not selected 
                            }
                        } 
                        else{
                            // Button not clicked
                            $image_name = $current_image;
                        }

                        // Step 4: Upload the food in database
                        // Creat the query
                        $sql3 = "UPDATE tbl_food SET title='$title', description='$description', price=$price, image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id=$id";

                        // Execute the query
                        $result3 = mysqli_query($db_connection, $sql3);

                        // Step 5: Redirect to manage food page with session message
                        // Check whether query is executed or not
                        if($result3 == true){
                            // Query executed and food updated
                            // Success session message and redirect to manage food page
                            $_SESSION["updated"] = "<div class='success'>Food updated successfully</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                        }
                        else{
                            // Failed to update food
                            // Failed session message and redirect to manage food page
                            $_SESSION["updated"] = "<div class='error'>Failed to update food</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                        }
                    }
                ?>
        </div>
    </div>
<?php 
    // Connect footer
    include("partials/footer.php");
?>