<?php
    include("partials/menu.php");
?>
<div class="main-content">
    <div class="wraper">
        <h1>Manage Order</h1>
            <br><br>

            <?php 
            
                // Update order session message
                if(isset($_SESSION["update-order"])){
                    echo $_SESSION["update-order"];
                    unset($_SESSION["update-order"]);
                }

            ?>

            <br>
            <table class="tbl-full">
                <tr>
                    <th>SL</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                
                    // Get all the orders from database
                    // Create sql query
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";//Display the latest order at first

                    // Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    // Count rows
                    $count = mysqli_num_rows($result);

                    $sn = 1; // Creat a sl no variable and initial value is 1

                    // Check whether the order is available or not
                    if($count > 0){
                        // Order is available
                        while($row = mysqli_fetch_assoc($result)){
                        // Get all the orders details
                        $id = $row["id"];
                        $food = $row["food"];
                        $price = $row["price"];
                        $qty = $row["qty"];
                        $total = $row["total"];
                        $order_date = $row["order_date"];
                        $status = $row["status"];
                        $customer_name = $row["customer_name"];
                        $customer_contact = $row["customer_contact"];
                        $customer_email = $row["customer_email"];
                        $customer_address = $row["customer_address"];

                        ?>

                            <tr>
                                <td class="font-size"><?php echo $sn++; ?></td>
                                <td class="font-size"><?php echo $food; ?></td>
                                <td class="font-size"><?php echo $price; ?></td>
                                <td class="font-size"><?php echo $qty; ?></td>
                                <td class="font-size"><?php echo $total; ?></td>
                                <td class="font-size"><?php echo $order_date; ?></td>
                                <td class="font-size">

                                <?php 
                                
                                    // Orderd, On Delivery, Delevered, Cancelled
                                    if($status == "Order"){
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status == "On Delivery"){
                                        echo "<label style='color: orange'>$status</label>"; 
                                    }
                                    elseif($status == "Deliverd"){
                                        echo "<label style='color: green'>$status</label>"; 
                                    }
                                    elseif($status == "Cancelled"){
                                        echo "<label style='color: red'>$status</label>"; 
                                    }
                                
                                ?>

                                </td>
                                <td class="font-size"><?php echo $customer_name; ?></td>
                                <td class="font-size"><?php echo $customer_contact; ?></td>
                                <td class="font-size"><?php echo $customer_email; ?></td>
                                <td class="font-size"><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary ">Update</a>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    else{
                        // Order not available
                        echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                    }

                ?>
            </table>
    </div>
</div>
<?php
    include("partials/footer.php");
?>