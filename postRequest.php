
<!DOCTYPE html> <!--no errors, navbar done-->
<?php 
session_start();
if(!isset($_SESSION['parentID'])){
  if(isset($_SESSION['babysitterID']))
  header("Location: babysitterHome.php?error=1");
  else
  header("Location: index.php?error=1");
}
include 'PHP/connection.php'
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel ="stylesheet" href="css/request.css">
  <link rel ="stylesheet" href="css/signUp.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <!-- including time picker  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="jquery-3.6.1.min.js"></script>
   <script src="javaScript/Validations.js"></script>  
  <link rel="stylesheet" href="dist/timepicker.min.css">
  <title>Jalees</title>  </head>

<body>
      <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
      <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);">
        <div class="container-fluid">
          <!-- making the brand name as a heading -->
          <a class="navbar-brand mb-0 h1" href="parentHome.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
              <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
              <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        
            <!-- justify-content-end to make left allignment -->
          <div class="collapse navbar-collapse" id="cNav">
              <!-- list of itms in the navbar -->
              <ul class="navbar-nav" style="margin-left: -200px;">
                <li class="nav-item"><a href="parentHome.php" class="nav-link">Home</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Bookings</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="currentBookings.php">Current Bookings</a></li>
                      <li><a class="dropdown-item" href="previousBookings.php">Previous Bookings</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Profile</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="viewProfileParent.php">View Profile</a></li>
                      <li><a class="dropdown-item" href="EditParentProfile.php">Manage Profile</a></li>
                      <li><a class="dropdown-item" href="php/signout.php">Log Out</a></li>
                    </ul>
                  </li>
                <li class="nav-item " ><a href="mailto:Jalees:gmail.com" class="nav-link ">Ask Us</a></li>
            </ul>
          </div>
        </div>
        </div>
        <?php
        if(isset($_POST['save'])){
    
          $kidsNames = $_POST['kidsNames'];
          $kidsAges = $_POST['kidsAges'];
          $type = $_POST['serviceType'];
          $startDate = $_POST['startDay'];
          $endDate = $_POST['endDay'];
          $startTime = $_POST['startTime'];
          $endTime = $_POST['endTime'];

          $namesError = $namesLen = $commasError = $namesCommasError = $agesError = $minorError = $dateError = $timeError = $allErrors = "";

            if (!preg_match("/^[a-zA-Z, ]+$/",$kidsNames)){ 
              $namesError = "\u{25CF} Kid's names should only contain letters, spaces, and commas (as needed). <br>";
              $allErrors = $allErrors.$namesError;
            }

            if (!preg_match("/^[0-9, ]+$/",$kidsAges)){ 
              $agesError = "\u{25CF} Kid's ages should only contain numbers, spaces, and commas (as needed). <br>";
              $allErrors = $allErrors.$agesError;
            }

            if(strpos($kidsAges, ',') !== false){ 
            $agesArray = explode(',', $kidsAges);

            foreach($agesArray as $age){
              if($age > '17' || $age < '0'){
                $minorError = "\u{25CF} Kids ages should be under 17, and above 0. <br>";
                $allErrors = $allErrors.$minorError;
                break;
              }
            }
          }
          else{
            if($kidsAges > '17' || $kidsAges < '0'){
              $minorError = "\u{25CF} Kids ages should be under 17, and above 0. <br>";
              $allErrors = $allErrors.$minorError;
            }
          }

          if(strpos($kidsNames, ',') !== false){ 
            $namesArray = explode(',', $kidsNames);
            foreach($namesArray as $name){
              if(strlen($name) < 2){
                $namesCommasError = "\u{25CF} Kid's names should be at least 2 letters. <br>";
                $allErrors = $allErrors.$namesCommasError;
              }
            }
          }
          if(((strpos($kidsNames, ',') == false) && (strpos($kidsAges, ',') == true)) ||((strpos($kidsNames, ',') == true) && (strpos($kidsAges, ',') == false))){
            $commasError = "\u{25CF} Please make sure that the number of kid's names and kid's ages are matching. <br>";
            $allErrors = $allErrors.$commasError;
          }

          if((strpos($kidsNames, ',') !== false) && (strpos($kidsAges, ',') !== false)){
          if(substr_count($kidsNames, ',') !== substr_count($kidsAges, ',')){
            $commasError = "\u{25CF} Please make sure that the number of kid's names and kid's ages are matching. <br>";
            $allErrors = $allErrors.$commasError;
          }
        }
            
            if($endDate < $startDate){
              $dateError = "\u{25CF} End date cannot be before start date. <br>";
              $allErrors = $allErrors.$dateError;
            }

            if($endTime <= $startTime){
              $timeError = "\u{25CF} End time cannot be before or equal to start time. <br>";
              $allErrors = $allErrors.$timeError;
            }

            if (strlen($allErrors) > 0 || !empty($allErrors)){ 
              $bool = true;
            }
            else{
              $parID = $_SESSION['parentID'];
              $query = "INSERT INTO jobRequests (kidsNames, kidsAges, serviceType, startDate, endDate, startTime, endTime, parentID, createdAt, reqStatus) VALUES ('$kidsNames', '$kidsAges', '$type', '$startDate', '$endDate', '$startTime', '$endTime', '$parID', now(), 'Pending')";
              $result = mysqli_query($connection, $query);
              if($result)
              header("Location: parentRequests.php?postSuccess=1");
            }
        
        }      
        ?>


        <div class="vh-100" id="form" style="margin-top: 3%;"> 
          <div class="container h-100">
           
                <div class="card text-black">
                  <div class="card-body p-md-5">
                   
    
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Post a Job Request</p>

                        <!-- the user wrong inputs -->
                        <?php
                        if(isset($bool))
                          if($bool)
                            echo "<div class='alert alert-danger' role='alert'> <p>".$allErrors."</p></div>";
                        ?>


                        <!-- the start of the form -->
                        <form class="mx-1 mx-md-4" action= "" onsubmit="return confirm('Are you sure you want to post this job request? Please note that if no offers have been accepted within an hour of posting, your job request will expire.');" method = "post" id="postRequestForm">

                        <!-- the start of the 1st row -->
                        <div class="container text-center">
                        <div class="row align-items-start">

                          <div class="col">

                          <div class="d-flex  align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="names"><strong>Kid/s name*</strong></label>
                              <input type="text" name="kidsNames" class="form-control" id="names" minlength="2" value="<?php if(isset($kidsNames)) echo $kidsNames; ?>" required>
                              <span style="text-align: left; color: orange ;">* Please separate multiple names using a comma</span>
                            </div>
                          </div>
                          </div>

                          <div class="col">
                          <div class="d-flex  align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="2"> <strong> Kid/s ages*</strong></label>
                              <input type="text" name="kidsAges" id="ages" class="form-control" id="2" value="<?php if(isset($kidsAges)) echo $kidsAges; ?>" required>
                              <span style="text-align: left; color: orange ;">* Please separate multiple ages respectively to the names using a comma </span>
                            </div>
                          </div>
                          </div>
                       <!-- the end of the 1st row -->
                        </div>

                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">

                            <label class="form-label" for = "service" ><strong>Type of service</strong></label>
                              <select class="form-select" id = "service" name="serviceType" required>
                              <option value="Infant Babysitting">Infant Babysitting</option>
                                <option value="Special Needs Babysitting">Special Needs Babysitting</option>
                                <option value="Overnight Babysitting">Overnight Babysitting</option>
                                <option value="After school Babysitting">After school Babysitting</option>
                                <option value="Help with homeworks">help with homeworks</option>
                                <option value="Tutoring">Tutoring</option>
                                <option value="Cooking meals">Cooking meals</option>
                                <option value="Others">Others</option>
                                </select>
                            </div>

                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                          <!-- date picker -->

                          <script>
                          datepickr = new Date().toISOString().split("T")[0];
                          datepickr1 = new Date().toISOString().split("T")[0];
                          </script>

                        <div class="container text-center">
                      <div class="row align-items-start">
                        <div class="col">
                        <label class="form-label" for="flatpickr"> <strong>Start Day</strong></label><br>
                          <input id="datepickr" type="date"  class="form-control" name="startDay" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" value="<?php if(isset($startDate)) echo $startDate; ?>" required><br>
                        </div>
                        <div class="col">
                        <label class="form-label" for="flatpickr1"> <strong>End Day</strong></label><br>
                        <input id="datepickr1" type="date" class="form-control" name="endDay" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" value="<?php if(isset($endDate)) echo $endDate; ?>"required><br>

                        </div>
                      </div>

                      <div class="container text-center">
                      <div class="row align-items-start">
                        <div class="col">
                            <!-- time picker -->
                            <label for="appt"> <strong> Start time</strong></label><br>
                           <input type="time" id="appt" name="startTime" class="form-control" value="<?php if(isset($startTime)) echo $startTime; ?>" required><br>
                        </div>
                        <div class="col">
                        <label for="appt1"> <strong> End time</strong></label><br>
                           <input type="time" id="appt1" name="endTime" class="form-control" value="<?php if(isset($endTime)) echo $endTime; ?>" required>
                        </div>
                      </div>
    
                 
                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button class="btn btn-outline-secondary btn-lg" name="save" type="submit"  id="show" >Post Request</button>

                          </div>
                        </form>
                     </div>
                  </div>
              </div> 


    
    </body>    

</html>