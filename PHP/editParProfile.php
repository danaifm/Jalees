<?php
session_start();
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host,Username,Password,db);
if(!$connection)
    die("could not coonect to database");
$parent = $_SESSION['parentID']; 


if(isset($_POST['save'])){
    
    $Fname = test_input($_POST['firstName']);
    $Lname = test_input($_POST['lastName']);
    $Email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $city = $_POST['city'];
    $district = test_input($_POST['district']);
    $street = test_input($_POST['street']);
    $profilePhoto = $_POST['profile-img']; 

}
    $firstNameError = $lastNameError = $emailError = $emailTaken = $passwordError = $allErrors = "";

    if (!preg_match("/^[a-zA-Z]{1,30}$/",$Fname)){ 
        $firstNameError = "\u{25CF} First name should be between 1-30 letters, and should not contain special characters or digits.<br>";
        $allErrors = $allErrors . $firstNameError;
    }

    if (!preg_match("/^[a-zA-Z]{1,30}$/",$Lname)){ 
        $lastNameError = "\u{25CF} Last name should be between 1-30 letters, and should not contain special characters or digits.<br>";
        $allErrors = $allErrors . $lastNameError;
    }

    $emailExists1 = "SELECT * FROM parents WHERE parentID != '$parent' AND email='$Email'  ";
    $emailQuery1 = mysqli_query($connection, $emailExists1);

    $emailExists2 = "SELECT * FROM Babysitters WHERE email='$Email'  ";
    $emailQuery2 = mysqli_query($connection, $emailExists2);

    if(mysqli_num_rows($emailQuery1) > 0 || mysqli_num_rows($emailQuery2) > 0)
    {
        $emailTaken = "\u{25CF} Email already exists! <br>";
        $allErrors = $allErrors . $emailTaken;
    }


    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,5}$/ix" , $Email)) {
        $emailError = "\u{25CF} Invalid Email Address!<br>";
        $allErrors = $allErrors . $emailError;
    }


    if ((strlen($password)<8) || !preg_match("/[!”#\$\%\&\'\(\)\*\+,-\.\/:;<=>\?@\[\]\^_\{\|\}~`]{1,}/", $password) ){ 
        $passwordError = "\u{25CF} Password should be at least 8 characters and should contain at least one special character.<br>";
        $allErrors = $allErrors . $passwordError;
    }

    

    if (strlen($allErrors) > 0 || !empty($allErrors)){
        mysqli_close($connection);
        header("Location: ../EditParentProfile.php?error=$allErrors");  
    }


    else {

        if ($profilePhoto  == null){
            $query = "UPDATE parents SET firstName = '$Fname', lastName = '$Lname', email = '$Email',pass = '$password', city = '$city', district = '$district' , street ='$street' WHERE parentID = '$parent' ";   
            $result = mysqli_query($connection, $query);
            mysqli_close($connection);
            header("Location: ../viewProfileParent.php?success=1");
        }

        else {
            $profilePhoto = 'css/images/'.$profilePhoto;
        $query = "UPDATE parents SET firstName = '$Fname', lastName = '$Lname', email = '$Email', photo ='$profilePhoto',pass = '$password', city = '$city', district = '$district' , street ='$street' WHERE parentID = '$parent' ";       
        $result = mysqli_query($connection, $query);

        mysqli_close($connection);
        header("Location: ../viewProfileParent.php?success=1");
        }
            
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   


?>
