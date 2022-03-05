<?php

   //connect to database
   $con = mysqli_connect("localhost", "root", "fredfred", "mytestdb");

    //check connection
   if (!$con){
   echo 'Connection error: '. mysqli_connect_error();
      die();
      }
    //   echo "Database conneciton successfully! Hello Cakes!";


?>