<!DOCTYPE html> <!--no errors, navbar done-->
<?php 
session_start();
if(!isset($_SESSION['parentID'])){
  if(isset($_SESSION['babysitterID']))
  header("Location: babysitterHome.php?error=1");
  else
  header("Location: index.php?error=1");
}
?>

<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
    <script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>  
    <link rel ='stylesheet' href='css/viewProfiles.css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <title>Jalees</title>

</head>

<body>
    <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
    <div class='navbar navbar-expand-lg navbar-light text-light ' style='background-color: rgb(227, 217, 175);'>
        <div class='container-fluid'>
          <!-- making the brand name as a heading -->
          <a class='navbar-brand mb-0 h1' href='parentHome.php'><img src='css/images/logo.png' style='width: 35%;' alt='Logo'></a>
              <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
              <button class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#cNav' aria-controls='cNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            
        
            <!-- justify-content-end to make left allignment -->
          <div class='collapse navbar-collapse' id='cNav'>
              <!-- list of itms in the navbar -->
              <ul class='navbar-nav' style='margin-left: -200px;'>
                <li class='nav-item'><a href='parentHome.php' class='nav-link'>Home</a></li>
                  <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Bookings</a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item' href='currentBookings.php'>Current Bookings</a></li>
                      <li><a class='dropdown-item' href='previousBookings.php'>Previous Bookings</a></li>
                    </ul>
                  </li>
                  <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle active' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Profile</a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item active' href='viewProfileParent.php'>View Profile</a></li>
                      <li><a class='dropdown-item' href='EditParentProfile.php'>Manage Profile</a></li>
                      <li><a class='dropdown-item' href='php/signout.php'>Log Out</a></li>
                    </ul>
                  </li>
                <li class='nav-item ' ><a href='mailto:Jalees:gmail.com' class='nav-link '>Ask Us</a></li>
            </ul>
          </div>
        </div>
        </div>

        <br> 

    <h1 style='text-align: center;'>Your Profile</h1> <br>

    <div class='container'>
    <?php
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            Define("host","localhost");
            Define("Username", "root");
            Define("Password", "");
            Define("db", "Jalees");
            $connection = mysqli_connect(host, Username, Password, db);
            if(!$connection)
            die();
    
            $query = "SELECT * FROM Parents WHERE parentID=".$_SESSION['parentID'].";";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($result)){
               echo "<div class='row profile'>
               <div class='col-md-3'>
               <div class='profile-sidebar'>
               <div class='profile-userpic'>
               <img src=".$row['photo']." class='img-responsive' alt='Profile Picture'>
               </div>
               <div class='profile-usertitle'>
               <div class='profile-usertitle-job'>
                   <div id='babysitterTitle'>Parent</div>
               </div>
           </div>
           </div>
           </div>
            <div class='col-md-9'>
                <div class='profile-content'>
                    <div class='info'>

                        <p><strong>Name: </strong><br>".$row['firstName']." ".$row['lastName']."</p>
                    
                        <p><strong>Email:</strong> <br>".$row['email']."</p>
                    
                        <p><strong>City: </strong><br>".$row['city']."</p>
                    
                        <p><strong>Location:</strong><br> ".$row['district']." | ".$row['street']."</p>
                    
                    </div>";?>

                    <div id='buttons'><form onsubmit="return confirm('Are you sure you want to delete your account?');" method="post" action="PHP/deleteAccount.php">
                    <a class='btn btn-outline-secondary ' href='EditParentProfile.php' role='button'>Edit Profile</a>
                    
                    <?php
                    $checkQuery = "SELECT * FROM jobRequests WHERE endDate > CAST(CURRENT_TIMESTAMP AS DATE) AND babysitterID IS NOT NULL AND parentID=".$_SESSION['parentID'].";";
                    $checkResult = mysqli_query($connection, $checkQuery);
                    $checkTime = "SELECT * FROM jobRequests WHERE endDate = CAST(CURRENT_TIMESTAMP AS DATE) AND endTime > CAST(CURRENT_TIMESTAMP AS TIME) AND babysitterID IS NOT NULL AND parentID=".$_SESSION['parentID'].";"; 
                    $timeResult = mysqli_query($connection, $checkTime);

                    if(mysqli_num_rows($checkResult)>0) //if has current jobs (end date in future)
                        echo"<span class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='You are unable to delete your account because you have current active bookings.'>
                        <button disabled='' class='btn btn-outline-secondary' type='button' style='background-color: rgb(222, 219, 219);'>Delete Profile</button>
                        </span></form>";

                        else if(mysqli_num_rows($timeResult)>0) //if has current jobs (ends today but at a later hour)
                        echo"<span class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='You are unable to delete your account because you have current active bookings.'>
                        <button disabled='' class='btn btn-outline-secondary' type='button' style='background-color: rgb(222, 219, 219);'>Delete Profile</button>
                        </span></form>";
                         
                         else //no current jobs
                         echo"<input type='submit' value='Delete Profile' class='btn btn-outline-secondary' style='color: red; border-color: red;'></form>";   
                     echo"
                    </div> 
                    
                </div>
            </div>
            
        </div>"; 
            }
    $connection -> close(); ?>
    
    <br>

    <p class='footer'>Jalees &copy;
        <a href='mailto:Jalees@gmail.com'>Contact Us</a>
    </p>
    <script>
         document.querySelectorAll('[data-bs-toggle="popover"]')
    .forEach(popover => {
      new bootstrap.Popover(popover)
    })
    </script>

<?php
if(isset($_GET['success']))
$msg = true;
else
$msg = false;
?>
 <?php if($msg)
      echo "<script type='text/javascript'> $(window).load(function(){ $('#myModal').modal('show'); }); </script>";
  ?>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Changes saved successfully!</p>
      </div>
    </div>
  </div>
</div>


</body>
</html>