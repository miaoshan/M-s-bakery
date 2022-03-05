<?php 


?>


<html>
<?php include('templates/header.php') ?>
<?php require_once'process.php'; ?>

<section class="container grey-text">
    <h4 class="center">Place an order</h4>
    <form class="white" action="crud.php" method="POST">
        <div class="form-group">
        <label>Your Email:</label>
        <input type="text" name="email" value="">
        </div>
        <div class="form-group">
        <label>Cake Name:</label>
        <input type = "text" name="cakename" value="">
        </div>
        <div class="form-group">
        <label>Quantity:</label>
        <input type = "text" name="quantity" value=" ">
        </div>
        <div class="form-group">
        <label>Topping: </label>
        <input type = "text" name="topping" value=" ">
        </div>
        <div class="form-group">
        <label>Message:</label>
        <input type ="text" name="message" value=" ">
        </div>
        <div class="center">
            <input type="submit" name="save" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</session>

<?php include('templates/footer.php') ?>
</html>


