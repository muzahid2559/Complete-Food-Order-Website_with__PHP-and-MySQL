<?php
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wraper">
            <h1>Manage Food</h1>
            <br>

            <?php
                // Add food session message
                if(isset($_SESSION["add"])){
                    echo  $_SESSION["add"];
                    unset($_SESSION["add"]);
                }

                // Unauthorize access session message
                if(isset($_SESSION["unauthorize"])){
                    echo $_SESSION["unauthorize"];
                    unset($_SESSION["unauthorize"]);
                }

                // Faile to remove image session message
                if(isset($_SESSION["remove-failed"])){
                    echo $_SESSION["remove-failed"];
                    unset($_SESSION["remove-failed"]);
                }

                // successfully and failed session message
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                // Failed to upload new image file session message
                if(isset($_session["upload-failed"])){
                    echo $_session["upload-failed"];
                    unset($_session["upload-failed"]);
                }

                // Failed to remove current image session message
                if(isset($_SESSION["remove-failed"])){
                    echo $_SESSION["remove-failed"];
                    unset($_SESSION["remove-failed"]);
                }

                // Updated session messagge
                if(isset($_SESSION["updated"])){
                    echo $_SESSION["updated"];
                    unset($_SESSION["updated"]);
                }
            ?>

            <br>
            <!-- Button for add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>SL No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    // Create a sql query to get all the food
                    $sql = "SELECT * FROM tbl_food";


                    // Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    // Count rows to check whether we have food or not
                    $count = mysqli_num_rows($result);

                    // Create serial number vaiable and set default value as 1
                    $sn = 1;
                    
                    if($count > 0){
                        // We have food in database
                        // Get the foods from database and display
                        while($row = mysqli_fetch_assoc($result)){
                            // Get the values from individual columns
                            $id = $row["id"];
                            $title = $row["title"];
                            $price = $row["price"];
                            $image_name = $row["image_name"];
                            $featured = $row["featured"];
                            $active = $row["active"];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>$<?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            // Check whether we have image or not
                                            if($image_name == ""){
                                                // We do not have image and display error message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            else{
                                                // We have image and display image
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else{
                        // food not added in database
                        echo "<tr><td colspan='7' class='error'>Food not added yet</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
<?php
    include("partials/footer.php");
?>