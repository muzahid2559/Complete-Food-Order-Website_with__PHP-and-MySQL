<?php
    include("partials/menu.php");
?>

    <!-- Main content section start -->
    <div class="main-content">
        <div class="wraper">
            <h1>Dashboard</h1>
            <br>

            <?php 
            //Login message from session
            if(isset($_SESSION["login"])){
                echo $_SESSION["login"];
                unset($_SESSION["login"]);
            }
            ?>
            
            <br>
            <div class="col-4">

                <?php 
            
                    // sql query for category
                    $sql = "SELECT * FROM tbl_category";

                    // Execute the query
                    $result = mysqli_query($db_connection, $sql);

                    // Count rows
                    $count = mysqli_num_rows($result);
            
                ?>
            
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>
            <div class="col-4">

                <?php 
                
                // sql query food
                $sql2 = "SELECT * FROM tbl_food";

                // Execute the query
                $result2 = mysqli_query($db_connection, $sql2);

                // Count rows
                $count2 = mysqli_num_rows($result2);
        
                ?>

                <h1><?php echo $count2; ?></h1>
                <br>
                Foods
            </div>
            <div class="col-4">


                <?php 
                
                // sql query orders
                $sql3 = "SELECT * FROM tbl_order";

                // Execute the query
                $result3 = mysqli_query($db_connection, $sql3);

                // Count rows
                $count3 = mysqli_num_rows($result3);
        
                ?>

                <h1><?php echo $count3; ?></h1>
                <br>
                Total Orders
            </div>
            <div class="col-4">

                <?php 
                
                    // Create sql for revenue generated
                    // Aggregate function in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Deliverd'";

                    // Execute the query
                    $result4 = mysqli_query($db_connection, $sql4);

                    // Get the executed value
                    $row4 = mysqli_fetch_assoc($result4);

                    // Get the total revenue
                    $total_revenue = $row4["Total"];

                ?>

                <h1>$<?php echo $total_revenue; ?></h1>
                <br>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main content section end -->

    <?php
        include("partials/footer.php");
    ?>