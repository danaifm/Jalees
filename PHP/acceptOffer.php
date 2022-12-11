<?php
                    error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    Define("host","localhost");
                    Define("Username", "root");
                    Define("Password", "");
                    Define("db", "Jalees");
                    $connection = mysqli_connect(host, Username, Password, db);
                    if(!$connection)
                    die();
                    session_start();

                    if(isset($_GET['offerID']) && isset($_GET['reqID'])){
                        $updateAccepted = "UPDATE Offers SET offerStatus='Accepted' WHERE offerID =".$_GET['offerID']."";
                        $sql = mysqli_query($connection, $updateAccepted);

                        $getOffer = "SELECT * FROM Offers WHERE offerID =".$_GET['offerID']."";
                        $offerColumns = mysqli_fetch_array(mysqli_query($connection, $getOffer));

                        $updateBabysitter = "UPDATE jobRequests SET babysitterID=".$offerColumns['babysitterOfferID']." WHERE jobRequests.ID = ".$offerColumns['requestID'].";";
                        $updateJobRequest = mysqli_query($connection, $updateBabysitter);

                        $rejectElse = "UPDATE Offers SET offerStatus='Rejected' WHERE NOT (offerID =".$_GET['offerID'].") AND offerStatus='Pending' AND  requestID=".$offerColumns['requestID'].";";
                        $updateElse = mysqli_query($connection, $rejectElse);
                        header("Location: ../parentRequests.php?reqID=".$_GET['reqID']."&accepted=1");
                    }
?>