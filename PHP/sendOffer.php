<?php
          session_start();
          Define("host","localhost");
          Define("Username", "root");
          Define("Password", "");
          Define("db", "Jalees");   
          $connection = mysqli_connect(host, Username, Password, db);
          if(!$connection)
          die();
                      if(isset($_GET['id']))
                       $id = $_GET['id']; //job request ID that i am sending offer to
                       if(isset($_POST['priceoffer']))
                       $price = $_POST['priceoffer'];
                       $babysitterid = $_SESSION['babysitterID'];
                       $sql = "INSERT INTO Offers (price, requestID, babysitterOfferID, createdAt, offerStatus) VALUES ('$price', '$id', '$babysitterid', now(), 'Pending')";
                      $d =  mysqli_query($connection, $sql);
                       if($d)
                       header("Location: ../babysitterRequest.php?success=1");
                        print(1);
                       $connection -> close();

           ?>
