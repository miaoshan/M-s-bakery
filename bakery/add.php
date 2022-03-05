<?php 

include('config\db_connect.php');


//check if any data has been sent through GET method
// if(isset($_GET['submit'])){
//     echo $_GET['email'];
//     echo $_GET['cakename'];
//     echo $_GET['quantity'];
  
// }
$email = $mobile = $address = $cakename = $quantity = $topping = $message = '';

$errors = array('email'=>'');
if(isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['cakename']);
    // echo htmlspecialchars($_POST['quantity']);
  
    //check email
    if(empty($_POST['email'])){
     $errors['email'] = 'An email is required <br />';
    } else {
       $email = ($_POST['email']);
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'email must be a valid email address';
       }
    }
    // //check mobile
    // if(empty($_POST['mobile'])){
    //     $errors['mobile'] = 'A Mobile number is required <br />';
    //    } else {
    //       $email = ($_POST['mobile']);
    //       if(!filter_var($mobile, FILTER_VALIDATE_EMAIL)){
    //        $errors['mobile'] = 'mobile number must be a valid number';
    //       }
    //    }
    //    //check delivery address
    // if(empty($_POST['address'])){
    //     $errors['address'] = 'A delivery address is required <br />';
    //    } else {
    //       $email = ($_POST['address']);
    //       if(!filter_var($address, FILTER_VALIDATE_EMAIL)){
    //        $errors['address'] = 'A delivery address must be a valid address';
    //       }
    //    }
    //check cake name
    if(empty($_POST['cakename'])){
        echo 'A cake name is required <br />';
    } else {
        $cakename = ($_POST['cakename']);
        if(!preg_match('/^[a-zA-Z\s]+$/', $cakename)){
        $errors['cakename'] = 'cake name must be letters and spaces only';
        }
    }
    
    //check quantity
    if(empty($_POST['quantity'])){
        echo 'A quantity is required <br />';
    } else {
        $quantity = ($_POST['quantity']);
        if(!is_numeric($quantity)){
        $errors['quantity'] = 'quantity must be valid whole number only';
        }
    }

    if(array_filter($errors)){
        //echo 'errors in the form';
    }else{
        //echo 'form is valid' then redirect to index page;
        // header('Location: index.php');  
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $cakename = mysqli_real_escape_string($con,$_POST['cakename']);
        $quantity = mysqli_real_escape_string($con,$_POST['quantity']);
        $topping = mysqli_real_escape_string($con, $_POST['topping']);
        $message = mysqli_real_escape_string($con, $_POST['message']);

        //create sql
        $sql = "INSERT INTO orders(email,cake_name,quantity,topping,message,created_at) VALUES('$email','$cakename', '$quantity', '$topping', '$message', now())";

        //save to DB & check 
        if(mysqli_query($con,$sql)){
            //success
            header('Location: orders.php');
        }else{
            //error
            echo 'query errro:' .mysqli_error($con);
        }
    }
}   //end of POST check 


?>



<html>
<?php include('templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Place an order</h4>
    <form class="white" action="add.php" method="POST">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo $email ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <!-- <label>Your Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $mobile ?>">
        <div class="red-text"><?php echo $errors['mobile']; ?></div>
        <label>Delivery Address:</label>
        <input type="text" name="address" value="<?php echo $address ?>">
        <div class="red-text"><?php echo $errors['address']; ?></div> -->
        <label>Cake Name:</label>
        <input type = "text" name="cakename" value="<?php echo $cakename ?>">
        <label>Quantity:</label>
        <input type = "text" name="quantity" value="<?php echo $quantity ?>">
        <label>Topping: </label>
        <input type = "text" name="topping" value="<?php echo $topping ?>">
        <label>Message:</label>
        <input type ="text" name="message" value="<?php echo $message ?>">
        <!-- <select name="topping" id="topping">
            <option value="colored_sprinkles">Colored Sprinkles</option>
            <option value="mini_mashmallows">Mini Mashmallows</option>
            <option value="chocolate_chips">Chocolate Chips</option>
            <option value="nerds_candy">Nerds Candy</option>
        </select> -->

        <div class="center">
            <input type="submit" name="submit" value="save" class="btn brand z-depth-0">
        </div>
    </form>
    </session>
     

<?php include('templates/footer.php') ?>
</html>