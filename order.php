<?php 
    // Connect fromt end menu
    include("partials-front/menu.php");
?>

<?php 

    // Check whether food id is set or not
    if(isset($_GET["food_id"])){
        // Food id is set and get food id and details of the selected food
        $food_id = $_GET["food_id"];

        // Get the details of selected food
        // Create query
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        // Execute the query
        $result = mysqli_query($db_connection, $sql);

        // Count rows
        $count = mysqli_num_rows($result);

        // Check whether the data is available or not
        if($count == 1){
            // Data available
            // Get the data from database
            $row = mysqli_fetch_assoc($result);

            $title = $row["title"];
            $price = $row["price"];
            $image_name = $row["image_name"];
        }
        else{
            // Data not available
            // Redirect to home page
            header("location:".SITEURL);
        }
    }
    else{
        // Food id not set
        // Redirect to home page
        header("location:".SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    <?php 
                    
                        // Check whether the image is available or not
                        if($image_name == ""){
                            // Image not available
                            echo "<div class='error'>Image not available</div>";
                        }
                        else{
                            // Image is available

                            ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                            <?php
                        }
                    
                    ?>

                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                    
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
            // Check whether the submit button is clicked or not
            if(isset($_POST["submit"])){
                // Get all the details from form
                $food = $_POST["food"];
                $price = $_POST["price"];
                $qty = $_POST["qty"];

                $total = $price * $qty; // Total = price * quantity

                $order_date = date("Y-m-d h:i:sa"); // Order date

                $status = "Ordered";//4 types of status like Ordered, On Delivery, Deliverd and Cancelled

                $customer_name = $_POST["full-name"];
                $customer_contact = $_POST["contact"];
                $customer_email = $_POST["email"];
                $customer_address = $_POST["address"];

                // Save the order in database
                // Sql query to save the data
                $sql2 = "INSERT INTO tbl_order SET food = '$food', price = $price, qty = $qty, total = $total, order_date = '$order_date', status = '$status', customer_name = '$customer_name', customer_contact = '$customer_contact', customer_email = '$customer_email', customer_address = '$customer_address'";

                //Execute the query
                $result2 = mysqli_query($db_connection, $sql2);

                // check whether query executed successfully or not
                if($result2 == true){
                    // Query executed successfully and order saved
                    // Success session message and redirect to home page
                    $_SESSION["order"] = "<div class='success text-center'>Food orderd successfully</div>";
                    header("location:".SITEURL);

                }
                else{
                    // Failed to save order
                    // Failed session message and redirect to home page
                    $_SESSION["order"] = "<div class='error text-center'>Failed to order food</div>";
                    header("location:".SITEURL);
                }

            }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
    // Connect fromt end footer
    include("partials-front/footer.php");
?>