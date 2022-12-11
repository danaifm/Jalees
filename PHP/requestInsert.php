<?php
          session_start();
          Define("host","localhost");
          Define("Username", "root");
          Define("Password", "");
          Define("db", "Jalees");   
          $connection = mysqli_connect(host, Username, Password, db);
          if(!$connection)
          die();

          if(isset($_POST['postRequest'])){
            $kidsNames = $_POST['names'];
            $kidsAges = $_POST['ages'];
            $type = $_POST['type'];
            $startDate = $_POST['startDay'];
            $endDate = $_POST['endDay'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $parentID = $_SESSION['parentID'] ;
            $query = "INSERT INTO jobrequests (kidsNames, kidsAges , serviceType , startDate  ,endDate , startTime , endTime, parentID ) VALUES
             ('$kidsNames' , '$kidsAges' , '$type' , '$startDate' , '$endDate' , '$startTime', '$endTime' , '$parentID') ;" ; 
            
            $result = mysqli_query($connection, $query);
            }
            $connection -> close();
            header("Location: ../parentRequests.php?postSuccess=1");
            


          ?>