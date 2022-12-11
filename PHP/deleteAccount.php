<?php
    session_start();
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    Define("host","localhost");
    Define("Username", "root");
    Define("Password", "");
    Define("db", "Jalees");
    $connection = mysqli_connect(host, Username, Password, db);
    if(!$connection)
    die();

    if(isset($_SESSION['babysitterID']))
        $query = "DELETE FROM Babysitters WHERE Babysitters.ID=".$_SESSION['babysitterID'].";";

    else if(isset($_SESSION['parentID']))
        $query = "DELETE FROM Parents WHERE parentID=".$_SESSION['parentID'].";";

    mysqli_query($connection, $query);
    session_unset();
    session_destroy();
    header('Location: ../index.php?message=1');

?>