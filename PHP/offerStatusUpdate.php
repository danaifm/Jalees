<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    Define("host","localhost");
    Define("Username", "root");
    Define("Password", "");
    Define("db", "Jalees");
    $connection = mysqli_connect(host, Username, Password, db);
    if(!$connection)
    die();

    $select = "SELECT * FROM jobRequests WHERE createdAt < (NOW() - INTERVAL 1 HOUR) AND babysitterID IS NULL";
    $q = mysqli_query($connection, $select);
    if(mysqli_num_rows($q) > 0){
        while($req = mysqli_fetch_array($q)){
            $offer = "UPDATE Offers SET offerStatus='Expired' WHERE requestID = ".$req['ID']." AND offerStatus = 'Pending'";
            mysqli_query($connection, $offer);
        }
    }

    $query = "UPDATE jobRequests SET reqStatus =  'Expired' WHERE createdAt < (NOW() - INTERVAL 1 HOUR) AND babysitterID IS NULL";
    $result = mysqli_query($connection, $query);
?>