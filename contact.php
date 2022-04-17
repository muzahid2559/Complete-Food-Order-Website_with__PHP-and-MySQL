<?php

    // Connect menu
    include ("partials-front/menu.php")

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center">Express your thoughts</h2>

            <form action="#" class="order">
                
                <fieldset>
                    <legend>Contact us</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="2" placeholder="" class="input-responsive" required></textarea>

                    <div class="order-label">Message</div>
                    <textarea name="text" rows="6" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Send  it" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
    
        // Connect footer
        include ("partials-front/footer.php");
    
    ?>