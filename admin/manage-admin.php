<?php
include("partials/menu.php");
?>
<!-- Main content section start -->
<div class="main-content">
    <div class="wraper">
        <h1>Manage Admin</h1>
        <br>
        <?php
        // successfull message from session
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"]; // Displaying session message
            unset($_SESSION["add"]); // Removing session message 
        }

        //Successful or not admin deleted message from session
        if(isset($_SESSION["delete"])){
            echo $_SESSION["delete"]; //Displying admin deleted message from session
            unset($_SESSION["delete"]); //Removing admin deleted message from session
        }

        //successful or not admin updated message from session
        if(isset($_SESSION["update"])){
            echo $_SESSION["update"]; //Displaying admin updated message from session
            unset($_SESSION["update"]); //Removing admin updated message from session
        }
        if(isset($_SESSION["user-not-found"])){
            echo $_SESSION["user-not-found"];
            unset($_SESSION["user-not-found"]);
        }
        //New password and cinfirm password match message from session
        if(isset($_SESSION["password-not-match"])){
            echo $_SESSION["password-not-match"];
            unset($_SESSION["password-not-match"]);
        }
        
        //Change password message
        if(isset($_SESSION["change-password"])){
            echo $_SESSION["change-password"];
            unset($_SESSION["change-password"]);
        }
        ?>
        <br><br>
        <!-- Button for add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>SL No</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            <?php

            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the query
            $result = mysqli_query($db_connection, $sql);
            //Check whether the query is executed or not
            if ($result == TRUE) {
                // Count rows to check whether we have data in database or not
                $count = mysqli_num_rows($result); //Function to get all the rows in database

                $sn = 1; //Cerat a variable and assign the value

                //Check the number of rows
                if ($count > 0) {
                    //We have data in database
                    while ($rows = mysqli_fetch_assoc($result)) {
                        //Using while loop to get all the data from database
                        //And while loop will run as long as we have data in database

                        //Get individual data
                        $id = $rows["id"];
                        $full_name = $rows["full_name"];
                        $username = $rows["username"];
                        //Display the value in our table
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-success">Change Password</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //We don't have data in database
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main content section end -->

<?php
include("partials/footer.php");
?>