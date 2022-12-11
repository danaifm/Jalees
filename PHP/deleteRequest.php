<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host, Username, Password, db);
if(!$connection)
die();

if(isset($_GET['id']))
{
$id = $_GET['id'];
$query = "DELETE FROM jobRequests WHERE  ID = ".$id.""; 
$query_run = mysqli_query($connection, $query);

if($query_run){
    echo '<script> alert("Deleted");</script>';
    header("Location: ../parentRequests.php?deleteSuccess=1");
} }
else
    header("Location: ../parentRequests.php?deleteError=1");


$connection -> close();
?>  