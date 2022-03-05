
<?php 

include('config/db_connect.php');

$id = 0;
$update = false;
if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

    $sql = "DELETE FROM orders WHERE id = $id_to_delete";

    if(mysqli_query($con, $sql)){
        header('Location: orders.php');
    } else {
        echo 'query error: '. mysqli_error($con);
    }
 
}

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
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center  grey-text">
    <?php if($order): ?>
        
        <h4><?php echo $order['cake_name']; ?></h4>
        <!-- <h4>£<?php echo $order['price'];?></h4> -->
        <p>Order quantity <?php echo $order['quantity']; ?></p>
        <p>Added topping <?php echo $order['topping']; ?></p>
        <p>Ordered by <?php echo $order['email']; ?></p>
        <p>Ordered at <?php echo date($order['created_at']); ?></p>
        <p>Message <?php echo $order['message']; ?></p>
        
        <!-- DELETE FORM -->
        <form action="order_details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $order['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    <?php else: ?>
        <h5>Order not found.</h5>
    <?php endif ?>
</div>

<?php include('templates/footer.php'); ?>

</html>