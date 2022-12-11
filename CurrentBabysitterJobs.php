<!DOCTYPE html> <!--no errors, navbar done-->
<?php 
session_start();
if(!isset($_SESSION['babysitterID'])){
  if(isset($_SESSION['parentID']))
  header('Location: parentHome.php?error=1');
  else
  header('Location: index.php?error=1');
}
?>

<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel ='stylesheet' href='css/BabysitterJobs.css'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <title>Jalees</title>
     
    </head>

    <body>
  <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
  <div class='navbar navbar-expand-lg navbar-light text-light ' style='background-color: rgb(227, 217, 175);'>
    <div class='container-fluid'>
      <!-- making the brand name as a heading -->
      <a class='navbar-brand mb-0 h1' href='babysitterHome.php'><img src='css/images/logo.png' style='width: 35%;' alt='Logo'></a>
          <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
          <button class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#cNav' aria-controls='cNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        

          <!-- justify-content-end to make left allignment -->
          <div class='collapse navbar-collapse' id='cNav'>
            <!-- list of itms in the navbar -->
            <ul class='navbar-nav' style='margin-left: -200px;'>
              <li class='nav-item'><a href='babysitterHome.php' class='nav-link'>Home</a></li>
                <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle active' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Jobs</a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item active' href='CurrentBabysitterJobs.php'>Current Jobs</a></li>
                      <li><a class='dropdown-item' href='PreviousBabysitterJobs.php'>Previous Jobs</a></li>
                    </ul>
                  </li> 
                  <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Profile</a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item' href='viewProfileBabysitter.php'>View Profile</a></li>
                      <li><a class='dropdown-item' href='EditBabysitterProfile.php'>Manage Profile</a></li>
                      <li><a class='dropdown-item' href='php/signout.php'>Log Out</a></li>
                    </ul>
                  </li>
                <li class='nav-item ' ><a href='mailto:Jalees@gmail.com' class='nav-link '>Ask Us</a></li>
            </ul>
        </div>
      </div>
    </div>


        <h1 style=' text-align: center; margin-top: 3%;'> My Current Jobs</h1>
        <div class = 'jobs' >
        <?php
          include 'PHP/connection.php';
          $query = "SELECT * FROM jobRequests WHERE babysitterID = ".$_SESSION['babysitterID']." AND ((CAST(CURRENT_TIMESTAMP AS DATE) < endDate) OR (CAST(CURRENT_TIMESTAMP AS DATE) = endDate AND endTime > CAST(CURRENT_TIMESTAMP AS TIME)))";
          $result = mysqli_query($connection, $query);
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
              $queryParent = "SELECT * FROM Parents WHERE parentID = ".$row['parentID']."";
              $resultParent = mysqli_query($connection, $queryParent);
             while($parent = mysqli_fetch_array($resultParent)){
              echo " <article>
              <img class='parentPicture' src =".$parent['photo']." alt='Profile Picture'>
              <h4 class = 'parentName'><strong>Parent's name: </strong>".$parent['firstName']." ".$parent['lastName']."</h4> 

              <P>
                  <strong>Kid's name: </strong>".$row['kidsNames']."<br>
                  <strong>Kid's age: </strong>".$row['kidsAges']." years old <br>
                  <strong>Type of service: </strong>".$row['serviceType']."<br>
                  <strong>Start date - End date:</strong> ".$row['startDate']." - ".$row['endDate']." <br>
                  <strong>Duration:</strong> ".$row['startTime']." - ".$row['endTime']."
              </p>

          </article>";
          }
        }
        }
          else{
            echo "<p style='color: grey; text-align: center;'>No Current Jobs..</p>
            <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
          }
          ?>

        </div> 

        <p class='footer'>Jalees &copy;
            <a href='mailto:Jalees@gmail.com'>Contact Us</a>
        </p>


    

    </body>
</html>