<?php 
    // Connect fromt end menu
    include("partials-front/menu.php");
?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
                // Display all the category that are active
                // Create sql query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                // Execute the query
                $result = mysqli_query($db_connection, $sql);

                // Count rows
                $count = mysqli_num_rows($result);

                // Check the category is available or not
                if($count > 0){
                    // Category available
                    while($row = mysqli_fetch_assoc($result)){
                        // Get the values like id, title, image name
                        $id = $row["id"];
                        $title = $row["title"];
                        $image_name = $row["image_name"];

                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">

                                    <?php 
                                    
                                        // Check whether image is available or not
                                        if($image_name == ""){
                                            // Image not available
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
                    // Category not available
                    echo "<div class='error'>Category not added</div>";
                }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php 
        // Connect front end footer
        include("partials-front/footer.php");
    ?>