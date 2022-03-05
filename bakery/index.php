<?php
   
   //one way of connect to the database using include.
   include('config\db_connect.php');
    //or use below method to connect to database
   // $con = mysqli_connect("localhost", "root", "fredfred", "mytestdb");

   //  //check connection

   // if (!$con){
   // echo 'Connection error: '. mysqli_connect_error();
   //    die();
   //    }
   //    echo "Database conneciton successfully! Hello Cakes!";

    //write query for all cakes 
    $sql = 'SELECT * FROM cakes ORDER BY name DESC';

    //make query & get result
    $result = mysqli_query($con, $sql);

    //fetch the result rows as an array 
    $cakes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($con); 

   //  print_r($cakes);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

   
	<h4 class="center grey-text">Cakes</h4>
   <!-- <i class="fa fa-birthday-cake" style="center grey-text">Cakes</i> -->

	<div class="container">
		<div class="row">

			<?php foreach($cakes as $cake): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<img src="img/cake.jpg" class="cake">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($cake['name']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $cake['ingredients']) as $ing): ?>
									<li><?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="order_details.php?id=<?php echo $cake['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>


