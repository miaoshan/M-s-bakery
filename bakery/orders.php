<?php 

include('config\db_connect.php');

$sql = "SELECT * FRoM orders"; 

$result = mysqli_query($con, $sql);

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($con);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Orders</h4>

	<div class="container">
		<div class="row">

			<?php foreach($orders as $order): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
					<img src="img/cake.jpg" class="cake">
						<div class="card-content center">
							<h6>Order item <?php echo htmlspecialchars($order['cake_name']); ?></h6>
							<h6>Order quantity <?php echo htmlspecialchars($order['quantity']); ?></h6>
							<h6>Order by <?php echo htmlspecialchars($order['email']); ?></h6>
							<h6>Toppings are <?php echo htmlspecialchars($order['topping']); ?></h6>
							<h6>Message <?php echo htmlspecialchars($order['message']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $order['topping']) as $ing): ?>
								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="order_details.php?id=<?php echo $order['id'] ?>">more info</a>
						</div>
						<div class="center">
        					<td><a class="btn brand z-depth-0" href="edit.php?id=<?php echo $order['id']; ?>">Edit</a></td>
							
        				</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>