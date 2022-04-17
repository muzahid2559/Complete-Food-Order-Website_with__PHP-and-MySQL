<?php 

    // Connect menu
    include("partials/menu.php")

?>

<div class="main-content">
    <div class="wraper">
        <h1>All Clients Thoughts Here</h1>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-20">
                <tr>
                    <td>Name: </td>
                    <td>Md Sadiqur Rahman</td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>01718313443</td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>sadiq@gmail.com</td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>Dhaka, Bangladesh</td>
                </tr>

                <tr>
                    <td>Message: </td>
                    <td>
                        <textarea name="message" cols="40" rows="5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat perspiciatis, accusamus reiciendis doloremque ipsa quaerat recusandae quos eligendi impedit, dolorum nam voluptate. Atque repellat odit dignissimos, eveniet iusto sunt at ullam! Quis asperiores placeat, voluptatum excepturi aut cupiditate. Nobis reiciendis enim magnam amet natus tempore sit explicabo velit fugit eius?</textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    // Connect footer
    include("partials/footer.php")

?>