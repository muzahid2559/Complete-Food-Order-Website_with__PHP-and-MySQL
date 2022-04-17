<?php 
    // Connect fromt end menu
    include("partials-front/menu.php");
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            // Display all the food that are active
            // Create sql query
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

            // Execute the query
            $result = mysqli_query($db_connection, $sql);

            // Count rows
            $count = mysqli_num_rows($result);

            // Check whether food is available or not
            if($count > 0){
                // Foods are available
                while($row = mysqli_fetch_assoc($result)){
                    // Get all the values like id, title, price, description, image_name
                    $id = $row["id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $image_name = $row["image_name"];

                    ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php 
                                
                                    // Check image is available or not
                                    if($image_name == ""){
                                        // image not available
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else{
                                        // Image is available

                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo$image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>

                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                    <?php
                }
            }
            else{
                // foods are not available
                echo "<div class='error'>Food not added</div>";
            }
            
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php 
    // Connect fromt end footer
    include("partials-front/footer.php");
?>