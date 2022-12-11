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
$firstNameError = $lastNameError = $emailError = $emailTaken  = $passwordError = $idError = $ageError = $bioError = $allErrors = "";

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
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script src="jquery-3.6.1.min.js"></script>
   <title>Jalees</title></head>


<body style=" background-color: #eee">
       <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
       <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);" >
        <div class="container-fluid">
          <!-- making the brand name as a heading --> <!--logo from tailorbrands.com-->
          <a class="navbar-brand mb-0 h1" href="index.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
              <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
              <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
  
            <!-- justify-content-end to make left allignment -->
          <div class="collapse navbar-collapse" id="cNav">
              <!-- list of itms in the navbar -->
              <ul class="navbar-nav" style="margin-left: -200px;">
                  <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                  <li class="nav-item"><a href="joinnow.php" class="nav-link">Join now!</a></li>
                  <li class="nav-item"><a href="login.php" class="nav-link">Log in</a></li>
                  <li class="nav-item"><a href="mailto:Jalees@gmail.com" class="nav-link">Ask us</a></li>
              </ul>
          </div>
        </div>
        </div>


     <section class="vh-100" id="vh"> 
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up to Jalees</p>
                      <p class="text-center h5 fw mb-5 mx-1 mx-md-4 mt-4">I'm a Babysitter</p>


                      <?php

                            if(isset($_POST['submitB']))
                            {
                              $Fname = test_input($_POST['fnameB']);
                              $Lname = test_input($_POST['lnameB']);
                               $Email = test_input($_POST['emailB']);
                               $password = test_input($_POST['passB']);
                               $userID = $_POST['userID'];
                                $age = $_POST['age'];
                                $PhoneNo = $_POST['phone'];
                                $gender = $_POST['Gender'];
                                $city = $_POST['city'];
                                $bio = test_input($_POST['bio']);
                                $profilePhoto = $_FILES['imageB']['name']; 
                                
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
                            
                            $select = mysqli_query($connection, "SELECT * FROM `Babysitters` WHERE email = '$Email' ");
                            $select1 = mysqli_query($connection, "SELECT * FROM `Parents` WHERE email = '$Email' ");
                            
                            if(mysqli_num_rows($select) > 0 || mysqli_num_rows($select1) > 0 ){
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
                            
                            
                            if (!preg_match("/^[0-9]{10}$/",$userID) ){
                                $idError = "\u{25CF} National ID / Iqama should consist of 10 digits only.<br>";
                                $allErrors = $allErrors . $idError;
                            }
                            
                            
                            if ($age < 18){ 
                                $ageError = "\u{25CF} Age should be greater than or equal to 18.<br>";
                                $allErrors = $allErrors . $ageError;
                            }
                            
                            if ($age > 100){ 
                                $ageError = "\u{25CF} Age should be less than or equal to 100.<br>";
                                $allErrors = $allErrors . $ageError;
                            }
                            
                            if (!preg_match("/^05+[0-9]{8}$/",$PhoneNo)){ 
                                $phoneError = "\u{25CF} Invalid Phone! Phone number must be in the format 05XXXXXXXX.<br>";
                                $allErrors = $allErrors . $phoneError;
                            }
                            
                            if (!preg_match("/^[0-9a-zA-Z!”#\$\%\&\'\(\)\*\+,-\.\/:;<=>\?@\[\]\^_\{\|\}~`\n\r ]{25,}$/",$bio)){ 
                                $bioError = "\u{25CF} Bio should contain at least 25 characters.<br>";
                                $allErrors = $allErrors . $bioError;
                            }
                            
                            
                            
                            if (strlen($allErrors) > 0 || !empty($allErrors)){
                                $bool = true; 
                            }
                            
                            
                            
                            else {
                                $insert = mysqli_query($connection, "INSERT INTO `Babysitters`(firstName, lastName,userID,gender,email, photo, pass,phone,city,bio,age) VALUES('$Fname','$Lname', '$userID','$gender', '$Email' ,'$profilePhoto' , '$password' , '$PhoneNo','$city','$bio','$age')");
                            
                                    if($insert){
                            
                                    $_SESSION['success'] ="Sign up successfully!";
                                    header('location: Login.php?success=1');
                                    $connection -> close();
                            
                            
                                    }else{
                                    header('location: signUpBabysitter.php?error=1');
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
                      <form action="" method="post" id="signUpForm" enctype="multipart/form-data">


                        <!-- Profile Picture -->
                        <div class="profile">
                        <img src="css/images/ava2.webp" class = "profile_image" alt="profile picture" id="img1"> <!-- image from https://www.iconfinder.com/icons/403017/avatar_default_head_person_unknown_user_anonym_icon -->
                    </div>
                    <br>

                      <div class="d-flex justify-content-center">
                        <div class="btn btn-outline-secondary btn-sm rounded-pill">
                         <label class="form-label  m-1" for="image" >Choose Picture (Optional)</label>
                         <input type="file" class="form-control d-none" id="image" onclick='changePic()' name="imageB" accept ="image/*">
                        </div>
                     </div>

                     <br>


                     <div id="errorMessage"> 
                        <?php
                          if($bool)
                            echo "<div class='alert alert-danger' role='alert'> <p>".$allErrors."</p></div>";
                        ?>
                        </div> 

                       
                              <div class="form-outline">
                                <label class="form-label" for="First_Name"><strong>First Name</strong></label>
                                <input type="text" id="First_Name" class="form-control" name = "fnameB" value="<?php if(isset($Fname)) echo $Fname; ?>">
                              </div>
                              <br>
                              <div class="form-outline">
                                <label class="form-label" for="Last_Name"><strong>Last Name</strong></label>
                                <input type="text" id="Last_Name" class="form-control" name = "lnameB" value="<?php if(isset($Lname)) echo $Lname; ?>">
                              </div>
                              <br>
                            <div class="form-outline">
                              <label class="form-label" for="Email"><strong>Email</strong></label>
                              <input type="email" id="Email" class="form-control" name ="emailB" value="<?php if(isset($Email)) echo $Email; ?>">
                            </div>
                            <br>
                            <div class="form-outline">
                              <label class="form-label" for="Password"><strong>Password</strong></label>
                              <input type="password" id="Password" class="form-control"  name = "passB" value="<?php if(isset($password)) echo $password; ?>">
                            </div>
                            <br>
                            <div class="form-outline">
                              <label class="form-label" for="userID"><strong>National ID / Iqama</strong></label>
                              <input type="text" id="userID" class="form-control" name ="userID" value="<?php if(isset($userID)) echo $userID; ?>" >
                            </div>
                            <br>
                            <div class="form-outline">
                              <label class="form-label" for="age"><strong>Age</strong></label>
                              <input type="number" id="age" class="form-control" name ="age" value="<?php if(isset($age)) echo $age; ?>">
                            </div>
                            <br>
                          
                            


                              
                              <div class="form-outline">
                                <label class="form-label" for="phone"><strong>Phone Number</strong></label>
                                <input type="tel" id="phone" class="form-control"  name = "phone" value="<?php if(isset($PhoneNo)) echo $PhoneNo; ?>">
                              </div>
        
                              <br>
        
                              <div>
                                <label class="form-label"><strong>Gender:</strong></label>
                              <div class="form-check form-check-inline" style="margin-left:15px;">
                                <input class="form-check-input" type="radio" name="Gender" id="male" value="Male" checked >
                                <label class="form-check-label" for="male">Male</label>
                              </div>
                              <div class="form-check form-check-inline" >
                                <input class="form-check-input" type="radio" name="Gender" id="female" value="Female" >
                                <label class="form-check-label" for="female">Female</label>
                              </div>
        
                            </div>
        
                            <br>
                              <div>
                              <label class="form-label" for =city><strong>Select City</strong></label>
                              <select class="form-select" name ="city" id = city>
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
        
                              <div class="form-outline">
                                <label class="form-label" for="bio"><strong>Bio</strong></label>
                                <textarea class="form-control" id="bio" maxlength="250" rows="4" placeholder="Share a little information about yourself" name="bio"></textarea>
                                <div id="the-count">
                                <span id="current">0</span>
                                <span id="maximum">/ 250</span>
                              </div>
                              </div>
                              <br>

                              <input type = submit value= "Sign Up" class="btn btn-outline-secondary btn-lg" name ="submitB"  >
                    
                    

                    </form>

                    <br>
                 

                    <p style="font-size:19px;">Already have an account?  <a href="Login.php">Log in</a></p>
                 
      
                    </div>

                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <!-- image from https://undraw.co/illustrations -->
                      <img src="css/images/signUpPic2.png" class="img-fluid" alt="sign up Babysitter picture">  
      
                    </div>
                 

                  
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      
   </section>


      <!-- Footer -->
      <p class="footer" style="padding-top: 20%;">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>


      <script>


//Upload picture
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
  
}});

}


</script>
<script>
$('#bio').keyup(function() {
    
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
      
    current.text(characterCount);
   
    
    /*This isn't entirely necessary, just playin around*/
    if (characterCount < 70) {
      current.css('color', '#666');
    }
    if (characterCount > 70 && characterCount < 90) {
      current.css('color', '#6d5555');
    }
    if (characterCount > 90 && characterCount < 100) {
      current.css('color', '#793535');
    }
    if (characterCount > 100 && characterCount < 120) {
      current.css('color', '#841c1c');
    }
    if (characterCount > 120 && characterCount < 139) {
      current.css('color', '#8f0001');
    }
    
    if (characterCount >= 140) {
      maximum.css('color', '#8f0001');
      current.css('color', '#8f0001');
      theCount.css('font-weight','bold');
    } else {
      maximum.css('color','#666');
      theCount.css('font-weight','normal');
    }
    
        
  });
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

 
                            
                      