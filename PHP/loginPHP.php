
      <?php
      session_start();
                    Define("host","localhost");
                    Define("Username", "root");
                    Define("Password", "");
                    Define("db", "Jalees");
                    $connection = mysqli_connect(host, Username, Password, db);
                    if(!$connection)
                    die();
                

                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $queryParent = "SELECT * FROM Parents WHERE email='$email' AND pass='$password'";
                    $resultParent = mysqli_query($connection, $queryParent);
                    $queryBabysitter = "SELECT * FROM Babysitters WHERE email='$email' AND pass='$password'";
                    $resultBabysitter = mysqli_query($connection, $queryBabysitter);
                    if(mysqli_num_rows($resultParent)>0){
                      $parentArray = mysqli_fetch_array($resultParent); 
                      $_SESSION['parentID'] = $parentArray['parentID']; //
                      $connection -> close();
                      header("Location: ../parentHome.php");
                    } 
                    else if(mysqli_num_rows($resultBabysitter)>0){
                      $babysitterArray = mysqli_fetch_array($resultBabysitter);
                      $_SESSION['babysitterID'] = $babysitterArray['ID']; //
                      $connection -> close();
                      header("Location: ../babysitterHome.php");
                    }
                    else {
                      $connection -> close();
                      header("Location: ../Login.php?error=Wrong Email/Password!");
                    }
                    ?>

