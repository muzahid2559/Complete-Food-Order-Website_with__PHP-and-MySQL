<?php

    // Connect menu
    include("partials/menu.php");

?>

    <div class="main-content">
        <div class="wraper">
            <h1>Update Order</h1>
            <br><br>

            <?php 
            
                // Check whether id is set or not
                if(isset($_GET["id"])){
                    // Id is set and get the details of order
                    $id = $_GET["id"];

                    // Get all other details based on this id
                    // create sql query to get the order details
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    // Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    // Count rows
                    $count = mysqli_num_rows($result);

                    // Check order details available or not
                    if($count == 1){
                        // Order detail available
                        $row = mysqli_fetch_assoc($result);

                        $food = $row["food"];
                        $price = $row["price"];
                        $qty = $row["qty"];
                        $status = $row["status"];
                        $customer_name = $row["customer_name"];
                        $customer_contact = $row["customer_contact"];
                        $customer_email = $row["customer_email"];
                        $customer_address = $row["customer_address"];
                    }
                    else{
                        // Order detail not available
                        // Redirect to manage order page
                        header("location:".SITEURL."admin/manage-order.php");
                    }
                    
                }
                else{
                    // Id not set and redirect to manage order page
                    header("location:".SITEURL."admin/manage-order.php");
                }

            ?>

            <form action="" method="POST">
                <table class="tbl-20">
                    <tr>
                        <td>Food Name: </td>
                        <td><b><?php echo $food; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><b>$<?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td>Qty: </td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Ststus: </td>
                        <td>
                            <select name="status">
                                <option <?php if($status == "Order"){echo "selected";} ?> value="Order">Order</option>
                                <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                                <option <?php if($status == "Deliverd"){echo "selected";} ?> value="Deliverd">Deliverd</option>
                                <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name: </td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact: </td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email: </td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address: </td>
                        <td>
                            <textarea name="customer_address" cols="26" rows="4"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">

                            <input type="submit" name="submit" value="Update Order" class="primary-btn">
                        </td>
                    </tr>
                </table>
            </form>

            <?php 
            
                // Check whether update button is clicked or not
                if(isset($_POST["submit"])){
                    // Button is clicked
                    //echo "clicked";

                    // Get all the values from form
                    $id = $_POST["id"];
                    $price = $_POST["price"];
                    $qty = $_POST["qty"];

                    $total = $price * $qty;

                    $status = $_POST["status"];
                    $customer_name = $_POST["customer_name"];
                    $customer_contact = $_POST["customer_contact"];
                    $customer_email = $_POST["customer_email"];
                    $customer_address = $_POST["customer_address"];

                    // Update the values
                    // Update query
                    $sql2 = "UPDATE tbl_order SET qty = $qty, total = $total, status = '$status', customer_name = '$customer_name', customer_contact = '$customer_contact', customer_email = '$customer_email', customer_address = '$customer_address' WHERE id = $id";

                    // Execute the query
                    $result2 = mysqli_query($db_connection, $sql2);

                    // Check whether order updated or not
                    // Redirect the manage order with message
                    if($result2 == true){
                        // Order updated
                        // Create session message and redirect to manage order page
                        $_SESSION["update-order"] = "<div class='success'>Order update successfully</div>";
                        header("location:".SITEURL."admin/manage-order.php");
                    }
                    else{
                        // Order not updated
                        // Create session message and redirect to manage order page
                        $_SESSION["update-order"] = "<div class='error'>Failed to order update</div>";
                        header("location:".SITEURL."admin/manage-order.php");
                    }
                }
            
            ?>

        </div>
    </div>

<?php 

    // Connect footer
    include("partials/footer.php");

?>