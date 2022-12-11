<?php
include 'connection.php';
session_start();
if(isset($_GET['offerID'])){
$updateRejected = "UPDATE Offers SET offerStatus='Rejected' WHERE offerID=".$_GET['offerID']."";
$sql = mysqli_query($connection, $updateRejected);
header("Location: ../viewOffers.php?reqID=".$_GET['reqID']."&rejected=1");
}
?>