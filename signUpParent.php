<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['babysitterID']))
header("Location: babysitterHome.php?error=1");
else if(isset($_SESSION['parentID']))
header("Location: parentHome.php?error=1");
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host, Username, Password, db);

 if(!$connection)
die("could not coonect to database");


$bool = false;
$firstNameError = $lastNameError = $emailError = $emailTaken = $passwordError = $districtError =$streetError = $allErrors = "";

?>

<!DOCTYPE html>


<html lang ="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signUp.css" >
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>  
   <script src="javaScript/Validations.js"></script> 
   <script src="jquery-3.6.1.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <title>Jalees</title>
</head>
<body style=" background-color: #eee">
       <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
       <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);" >
        <div class="container-fluid">
          <!-- making the brand name as a heading -->
          <a class="navbar-brand mb-0 h1" href="index.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
              <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
              <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
  
            <!-- justify-content-end to make left allignment -->
          <div class="collapse navbar-collapse" id="cNav">
              <!-- list of itms in the navbar -->
              <ul class="navbar-nav" style="margin-left: -200px;">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                  <li class="nav-item"><a href="joinnow.php" class="nav-link active">Join now!</a></li>
                  <li class="nav-item"><a href="login.php" class="nav-link">Log in</a></li>
                  <li class="nav-item"><a href="mailto:Jalees@gmail.com" class="nav-link">Ask us</a></li>
              </ul>
          </div>
        </div>
        </div>


        <div class="vh-100" id="vh1">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up to Jalees</p>
                      <p class="text-center h5 fw mb-5 mx-1 mx-md-2 mt-4">I'm a parent</p>


                      <?php
                      if(isset($_POST["submitP"]))
                      {
                          $Fname = test_input($_POST['fnameP']);
                          $Lname = test_input($_POST['lnameP']);
                          $Email = test_input($_POST['emailP']);
                          $password = test_input($_POST['passP']);
                          $city = $_POST['cityP'];
                          $district = test_input($_POST['district']);
                          $street = test_input($_POST['street']);
                      
                          $profilePhoto = $_FILES['imageP']['name'];
                      
                        
                          if(empty($profilePhoto))
                          $profilePhoto = 'css\/images\/ava2.webp';
                          else{
                            $profilePhoto = 'css/images/'.$profilePhoto;
                          }
                      
        
                      
                          if (!preg_match("/^[a-zA-Z]{1,30}$/",$Fname)){ 
                              $firstNameError = "\u{25CF} First name should be between 1-30 letters, and should not contain special characters or digits.<br>";
                              $allErrors = $allErrors . $firstNameError;
                          }
                      
                          if (!preg_match("/^[a-zA-Z]{1,30}$/",$Lname)){ 
                              $lastNameError = "\u{25CF} Last name should be between 1-30 letters, and should not contain special characters or digits.<br>";
                              $allErrors = $allErrors . $lastNameError;
                          }
                      
                          $select = mysqli_query($connection, "SELECT * FROM `Parents` WHERE email = '$Email' ");
                          $select1 = mysqli_query($connection, "SELECT * FROM `Babysitters` WHERE email = '$Email' ");
                          
                          if(mysqli_num_rows($select) > 0 || mysqli_num_rows($select1) > 0 )
                          {
                              $emailTaken = "\u{25CF} An account with this email already exists! <br>";
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
                      
                          if (!preg_match("/^[a-zA-Z ]{1,30}$/",$district)){ 
                              $districtError = "\u{25CF} District should be between 1-30 letters, and should not contain special characters or digits.<br>";
                              $allErrors = $allErrors . $districtError;
                          }
                      
                          if (!preg_match("/^[a-zA-Z ]{1,30}$/",$street)){ 
                              $streetError = "\u{25CF} Street should be between 1-30 letters, and should not contain special characters or digits.<br>";
                              $allErrors = $allErrors . $streetError;
                          }
                      
                      
                      
                          if (strlen($allErrors) > 0 || !empty($allErrors)){
                             $bool = true; 
                         }
                      
                      
                          else {
                      
                              $insert = mysqli_query($connection, "INSERT INTO `Parents`(firstName, lastName, pass, photo,city,district,street, email) VALUES('$Fname','$Lname', '$password' ,'$profilePhoto' , '$city' , '$district','$street','$Email')");
                      
                            if($insert){
                              $_SESSION['success'] ="Sign up successfully!";
                              header('location: Login.php?success=1');
                              $connection -> close();
                      
                      
                              }else{
                              header('location: signUpParent.php?error=1');
                              $connection -> close();
                              }
                    
                          }
                          
                          
                      
                      }
                      
                      
                      function test_input($data) {
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                      }   
                      
                    ?>                      

           

                       <!-- Form-->
                      <form action="" method="post" enctype="multipart/form-data" id ="signUpForm">

                      <!-- Profile Picture -->
                      <div class="profile">
                        <img src="css/images/ava2.webp" class = "profile_image" alt="profile picture" id="img1"> <!-- image from https://www.iconfinder.com/icons/403017/avatar_default_head_person_unknown_user_anonym_icon -->
                    </div>

                    <br>

                      <div class="d-flex justify-content-center" >
                        <div class="btn btn-outline-secondary btn-sm rounded-pill" >
                         <label class="form-label  m-1" for="image" >Choose Picture (Optional)</label>
                         <input type="file" class="form-control d-none" id="image" onclick='changePic()' name="imageP" accept ="image/*" >
                        </div>
                     </div>
                     
                        <br>

                        <div id="errorMessage"> 
                        <?php
                          if($bool)
                            echo "<div class='alert alert-danger' role='alert'> <p>".$allErrors."</p></div>";
                        ?>
                        </div> 

                        <div class="form-outline" >
                          <label class="form-label" for="FirstName"><strong>First Name</strong></label>
                          <input type="text" id="FirstName" class="form-control" name= "fnameP" value="<?php if(isset($Fname)) echo $Fname; ?>" >
                        </div>
                        <br>
                        <div class="form-outline">
                          <label class="form-label" for="LastName"><strong>Last Name</strong></label>
                          <input type="text" id="LastName" class="form-control" name= "lnameP" value="<?php if(isset($Lname)) echo $Lname; ?>"> 
                        </div>
                        <br>

                      <div class="form-outline">
                        <label class="form-label" for="typeEmail"><strong>Email</strong></label>
                        <input type="text" id="typeEmail" class="form-control"  name= "emailP" value="<?php if(isset($Email)) echo $Email; ?>" >
                      </div>

                      <br>
                      <div class="form-outline">
                        <label class="form-label" for="typePassword"><strong>Password</strong></label>
                        <input type="password" id="typePassword" class="form-control"  name="passP" value="<?php if(isset($password)) echo $password; ?>">
                      </div>

                      <br>
                      <div>
                      <label class="form-label" for =city1><strong>Select City</strong></label>
                      <select class="form-select" name ="cityP" id = city1 >
                        <option value="Abha">Abha</option>
                        <option value="Abu Arish">Abu Arish</option>
                        <option value="Al Baha">Al Baha</option>
                        <option value="Al Bukayriyah">Al Bukayriyah</option>
                        <option value="Al Duwadimi">Al Duwadimi</option>
                        <option value="Al Kharj">Al Kharj</option>
                        <option value="Al Rass">Al Rass</option>
                        <option value="Al Ula">Al Ula</option>
                        <option value="Al Khobar">Al Khobar</option>
                        <option value="Arar">Arar</option>
                        <option value="Bisha">Bisha</option>
                        <option value="Buridah">Buraidah</option>
                        <option value="Dammam">Dammam</option>
                        <option value="Dhahran">Dhahran</option>
                        <option value="Hafar Al Batin">Hafar Al Batin</option>
                        <option value="Hail">Hail</option>
                        <option value="Jazan">Jazan</option>
                        <option value="Jeddah">Jeddah</option>
                        <option value="Jubail">Jubail</option>
                        <option value="Khamis Mushait">Khamis Mushait</option>
                        <option value="Mecca">Mecca</option>
                        <option value="Medina">Medina</option>
                        <option value="Najran">Najran</option>
                        <option value="Riyadh">Riyadh</option>
                        <option value="Rabigh">Rabigh</option>
                        <option value="Riyadh AlKhabra">Riyadh AlKhabra</option>
                        <option value="Sakaka">Sakaka</option>
                        <option value="Shaqra">Shaqra</option>
                        <option value="Tabuk">Tabuk</option>
                        <option value="Taif">Taif</option>
                        <option value="Unayzah">Unayzah</option>
                        <option value="Yanbu">Yanbu</option>
                        <option value="Zulfi">Zulfi</option>
                      </select>
                    </div>

                      <br>

                     <!--Address-->
                     <div class="form-outline">
                          <label class="form-label" for="district"><strong>District</strong></label>
                          <input type="text" id="district" class="form-control" name ="district" value="<?php if(isset($district)) echo $district; ?>">
                        </div>
                        <br>
                        <div class="form-outline">
                          <label class="form-label" for="street"><strong>Street</strong></label>
                          <input type="text" id="street" class="form-control" name ="street" value="<?php if(isset($street)) echo $street; ?>">
                        </div>
                    
                    <br>

                    <input type = submit value= "Sign Up" class="btn btn-outline-secondary btn-lg" name ="submitP" >
                    

                    </form>

                    <br>
                    
                    <p style="font-size:19px;">Already have an account?  <a href="Login.php">Log in</a></p>
                 
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <!-- image from https://undraw.co/illustrations -->
                      <img src="css/images/picSign.png" class="img-fluid" alt="sign up parent picture">  
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      
        
      </div>

      <!-- Footer -->
      <p class="footer" style="padding-top: 5%;">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>


      
<script>

//Upload image
      function changePic(){
const img = document.querySelector('#img1');
const file = document.querySelector('#image');


file.addEventListener('change', function(){
 
    const choosedFile = this.files[0];

    if (choosedFile) {

        const reader = new FileReader(); 

        reader.addEventListener('load', function(){
            img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(choosedFile);

       
    }
});

}

</script>

<?php
    if(isset($_GET['error']))
    $err = true;
    else
    $err = false;
    ?>  
    <?php
    if($err)
    echo "<script type='text/javascript'> $(window).load(function(){ $('#errorModal').modal('show'); }); </script>";
    ?>

<div class="modal fade" id="errorModal" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Something went wrong...</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Please try again.</p>
      </div>
    </div>
  </div>
</div>

</body>


</html>

