<?php
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wraper">
            <h1>Manage Category</h1>
            <br>
            <?php 
            //Successful add category message
            if(isset($_SESSION["add"])){
                echo $_SESSION["add"];
                unset($_SESSION["add"]); 
            }

            //Remove image session message
            if(isset($_SESSION["remove"])){
                echo $_SESSION["remove"];
                unset($_SESSION["remove"]);
            }

            //Delete category sesssion message
            if(isset($_SESSION["delete"])){
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }

            //Unauthorize access session message
            if(isset($_SESSION["unathrize-message"])){
                echo $_SESSION["unathrize-message"];
                unset($_SESSION["unathrize-message"]);
            }

            //Success update catagory session message
            if(isset($_SESSION["update"])){
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }

            //No category found session message
            if(isset($_SESSION["no-category-found"])){
                echo $_SESSION["no-category-found"];
                unset($_SESSION["no-category-found"]);
            }

            //New image upload session message
            if(isset($_SESSION["upload_image"])){
                echo $_SESSION["upload_image"];
                unset($_SESSION["upload_image"]);
            }

            //Failed to remove image session message
            if(isset($_SESSION["failed-remove"])){
                echo $_SESSION["failed-remove"];
                unset($_SESSION["failed-remove"]);
            }
            ?>
            <br><br>
            <!-- Button for add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>SL No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //Query to get all caregory from database
                    $sql = "SELECT * FROM tbl_category";

                    //Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    //Count rows
                    $count = mysqli_num_rows($result);

                    //Create sirial number variable sn and assign a value as 1
                    $sn = 1;

                    //check whether we have data in database or not
                    if($count > 0){
                        //We have data in database
                        //Get the data and display
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row["id"];
                            $title = $row["title"];
                            $image_name = $row["image_name"];
                            $featured = $row["featured"];
                            $active = $row["active"];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            //Check whether image name is available or not
                                            if($image_name != ""){
                                                //Display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                            else{
                                                //Display the message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else{
                        //We don't have data in database
                        //we will display the message inside table
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No category added</div></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
<?php
    include("partials/footer.php");
?>
