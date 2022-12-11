<?php
    session_start();
    Define("host","localhost");
    Define("Username", "root");
    Define("Password", "");
    Define("db", "Jalees");
    $connection = mysqli_connect(host, Username, Password, db);
    if(!$connection)
    die();
    if(isset($_POST['title']))
    $title = $_POST['title'];
    if(isset($_POST['review'])) 
    $review = $_POST['review'];
    if(isset($_POST['rating'])){
        switch($_POST['rating']){
            case 1:
                $stars = 1;
                break;
            case 2:
                $stars = 2;
                break;
            case 3:
                $starts = 3;
                break;
            case 4:
                $stars = 4;
                break;
            case 5:
                $stars = 5;
                break;
        }
    }
    $babysitter = $_POST['babysitter'];
    $parent = $_SESSION['parentID'];
    $sql = "INSERT INTO Reviews (title, review, stars, babysitter, parent) VALUES ('$title', '$review', '$stars', '$babysitter', '$parent')";
    mysqli_query($connection, $sql);
    $connection -> close();
    header("Location: ../previousBookings.php");

?>