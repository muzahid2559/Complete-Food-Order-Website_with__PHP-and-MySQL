<?php
    // Header connection
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wraper">
            <h1>Add Food</h1>

            <br><br>

            <?php
                // Failed to upload image session message
                if(isset($_SESSION["upload"])){
                    echo $_SESSION["upload"];
                    unset($_SESSION["upload"]);
                }
            ?>

            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-20">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Food title">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="4" placeholder="Food description"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>

                        <td>
                            <select name="category">


                                <?php
                                    // Cerate php code to display category from database
                                    // Step 1: Create sql query to gel all active categories from database
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    // Executing query
                                    $result = mysqli_query($db_connection, $sql);

                                    // Count rows to check whether we have category or not
                                    $count = mysqli_num_rows($result);

                                    // If count is greter than zero, We have categories else we don't have categories
                                    if($count > 0){
                                        // We have categories
                                        // Step 2: display on dropdown
                                        while($row = mysqli_fetch_assoc($result)){

                                            // Get the detalis of the category
                                            $id = $row["id"];
                                            $title = $row["title"];
                                            ?>

                                                <option value="<?php echo $id; ?>"><?php echo $title;?></option>

                                            <?php
                                        }
                                    }
                                    else{
                                        // WE dono't have categories
                                    ?>
                                        <option value="0">No category found</option>
                                    <?php
                                    }
                                    
                                ?>
                            </select>
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
                            <input type="submit" name="submit" value="Add Food" class="primary-btn">
                        </td>
                    </tr>

                </table>
            </form>
            
            <?php 
            
            // Checked the submit button is clicked or not
            if(isset($_POST["submit"])){
                //Add the food in databae
                //echo "Button is working";

                //Step 1: Get the data form from
                $title = $_POST["title"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $category = $_POST["category"];

                //Check whether radio button for feature and active is checked or not
                if(isset($_POST["featured"])){
                    $featured = $_POST["featured"];
                }
                else{
                    $fratured = "No"; //Setting the default value
                }

                if(isset($_POST["active"])){
                    $active = $_POST["active"];
                    
                }
                else{
                    $active = "No"; // Setting the default value
                }

                // Step 2: Upload the image if selected
                // Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES["image"]["name"])){
                    // Get the details of the selected image
                    $image_name = $_FILES["image"]["name"];

                    // Check whether image is selected or not and upload image only if selected
                    if($image_name!=""){
                        // Image is selected
                        // A. rename the image
                        // Get the extention of image (jpge, png, gif etc)"sadiqur-rahman.jpg"
                        $ext = end(explode('.', $image_name));
                        // Create new name for image
                        $image_name = "Food_Name".rand(000,999).".".$ext; //New image name may be (Food-Name-345.jpg)

                        // B. upload the image
                        // Get the source path and destination path

                        // Source path is the current location of the image
                        $src = $_FILES["image"]["tmp_name"];
                        // Destination path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        // Finally upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether the image is uploaded or not
                        if($upload==false){
                            // Failed to upload the image
                            // Redirect to add food page with error message
                            $_SESSION["upload"] = "<div class='error'>Failed to upload image</div>";
                            header("location:".SITEURL."admin/add-food.php");
                            // Stop the process
                            die();
                        }
                    }
                }
                else{
                    $image_name = ""; // Setting default value as blank
                }

                // Step 3: Insert into database
                // Create a sql query to save or add food
                // For numerical value we do not need to pass value inside quotes '' butfor string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price=$price, image_name='$image_name', category_id=$category, featured='$featured', active='$active'";

                //Execute the query
                $result2 = mysqli_query($db_connection, $sql2);

                // Check whether data inserted or not and apply step 4
                //Step 4: Redirect with message to manage food page
                if($result2==true){
                    // Data inserted successfully and success message with session
                    $_SESSION["add"] = "<div class='success'>Food added successfully</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                else{
                    // Failed to inserted data and error message with session
                    $_SESSION["add"] = "<div class='error'>Failed to add food</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
               

               
            }

            ?>                        


        </div>
    </div>
<?php 
    // Footer connection        
    include("partials/footer.php");
?>