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

    <?php
    
        // Order session message
        if(isset($_SESSION["order"])){
            echo $_SESSION["order"];
            unset($_SESSION["order"]);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Create sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";

                // Execute the query
                $result = mysqli_query($db_connection, $sql);

                // Count rows to check whether the category is available or not
                $count = mysqli_num_rows($result);

                if($count > 0){
                    // Categories available
                    while($row = mysqli_fetch_assoc($result)){
                        // Get the values like id, title, image name
                        $id = $row["id"];
                        $title = $row["title"];
                        $image_name = $row["image_name"];

                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">

                                <?php 

                                    // Check whether image is available or  not
                                    if($image_name == ""){
                                        // Image not available and display message
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else{
                                        // Image available
                                        ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else{
                    // Categories no available
                    echo "<div class='error'>Category not added</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

                <?php 
                
                    // Getting food from database that are featured and active
                    // Sql query
                    $sql2 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";

                    // Execute query
                    $result2 = mysqli_query($db_connection, $sql2);

                    // Count row
                    $count2 = mysqli_num_rows($result2);

                    // Check whether food available or not
                    if($count2 > 0){
                        // Food available
                        while($row = mysqli_fetch_assoc($result2)){
                            // Get the values like id, title, price, description, image name
                            $id = $row["id"];
                            $title = $row["title"];
                            $price = $row["price"];
                            $description = $row["description"];
                            $image_name = $row["image_name"];

                            ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                        
                                        // check image is available or not
                                        if($image_name == ""){
                                            // Image not available
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else{
                                            // Image available

                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                            <?php
                                        }

                                        ?>
                                        
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price">$<?php echo $price; ?></p>
                                        <p class="food-detail"><?php echo $description; ?></p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>

                            <?php

                        }
                    }
                    else{
                        // Food not available
                        echo "<div class='error'>Food not added</div>";
                    }
                
                ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php 
        // Connect front end footer
        include("partials-front/footer.php");
    ?>

    