


<?php 

include('config/db_connect.php');


$id = 0;

// check GET request id param
if(isset($_GET['id'])){
    
    // escape sql chars
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // make sql
    // $sql = "SELECT cake_name, quantity, price, email, created_at FROM orders INNER JOIN cakes on orders.cake_name = cakes.name";
    $sql = "SELECT * FROM orders WHERE id = $id";

    // get the query result
    $result = mysqli_query($con, $sql);

    // var_dump($result);

    // fetch result in array format
    $order = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($con);
    // var_dump($order);
}

   //check update button has been clicked
   if(isset($_POST['update'])){
 
    $id_to_update = mysqli_real_escape_string($con, $_POST['id_to_update']);
    $email = $_POST['email'];
    $cakename = $_POST['cakename'];
    $quantity = $_POST['quantity'];
    $topping = $_POST['topping'];
    $message = $_POST['message'];

    $s = "UPDATE orders SET cake_name='$cakename', quantity='$quantity',
    email='$email', topping='$topping', message='$message' WHERE id='$id_to_update'";
   
    if(mysqli_query($con, $s)){
        header('Location:orders.php');
    }else{
        echo 'query error:'. mysqli_error($con);
        }    
    }

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<div class="container center  grey-text">
    <?php if($order): ?>
        
        <h4><?php echo $order['cake_name']; ?></h4>
        <!-- <h4>£<?php echo $order['price'];?></h4> -->
        <p>Order quantity <?php echo $order['quantity']; ?></p>
        <p>Ordered by <?php echo $order['email']; ?></p>
        <p>Ordered at <?php echo date($order['created_at']); ?></p>    
    
        <!-- EDIT FORM -->

        <section class="container grey-text">
        <h4>Edit your order</h4>
        <form class="white" action="edit.php" method="POST">
        <input type="hidden" name="id_to_update" value="<?php echo $id; ?>">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo$order['email']; ?>">
        <label>Cake Name:</label>
        <input type = "text" name="cakename" value="<?php echo $order['cake_name'];?>">
        <label>Quantity:</label>
        <input type = "text" name="quantity" value=" <?php echo $order['quantity'];?>">
        <label>Topping: </label>
        <input type = "text" name="topping" value="<?php echo $order['topping'] ?>">
        <label>Message:</label>
        <input type ="text" name="message" value=" <?php echo $order['message'];?> ">

        <div class="center">
            <input type="submit" name="update" value="update" class="btn brand z-depth-0">  
        </div>
    </form>
    </section>
      


    <?php else: ?>
        <h5>Order not found.</h5>
    <?php endif ?>
</div>

<?php include('templates/footer.php'); ?>

</html>