<!DOCTYPE html> <!--no errors, navbar done-->
<?php 
session_start();
if(!isset($_SESSION['babysitterID'])){
  if(isset($_SESSION['parentID']))
  header('Location: parentHome.php?error=1');
  else
  header('Location: index.php?error=1');
}
include 'PHP/offerStatusUpdate.php'
?>

<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel ='stylesheet' href='css/viewOffers.css'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>
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
                    <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Jobs</a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item' href='CurrentBabysitterJobs.php'>Current Jobs</a></li>
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

        <!--start-->

        <h1 style=' text-align: center; margin-top: 3%;'> My Offers</h1>
        
        <div class = 'req' >
        <?php
                    error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    Define("host","localhost");
                    Define("Username", "root");
                    Define("Password", "");
                    Define("db", "Jalees");
                    $connection = mysqli_connect(host, Username, Password, db);
                    if(!$connection)
                    die();
                    $query = "SELECT * FROM Offers LEFT JOIN jobRequests ON Offers.requestID = jobRequests.ID WHERE babysitterOfferID=".$_SESSION['babysitterID']." ORDER BY offerID DESC";
                    $result = mysqli_query($connection, $query);
                    if(mysqli_num_rows($result) > 0){
                      while($offer = mysqli_fetch_array($result)){
                        $parentQ = "SELECT * FROM Parents WHERE Parents.parentID = ".$offer['parentID']."";
                        $parent = mysqli_fetch_array(mysqli_query($connection, $parentQ));
                        echo "<article> 
                          <img class='requestPicture' src =".$parent['photo']." alt='Profile Picture'> <!--istockphoto.com-->
                          <div class = 'information'> 
                            <h4 class = 'parentName'><strong>Parent's name: </strong>".$parent['firstName']." ".$parent['lastName']."</h4> 
                            <p><strong>Kid's name: </strong>".$offer['kidsNames']."<br>
                            <strong>Kid's age: </strong> ".$offer['kidsAges']." years old <br>
                            <strong>Type of service: </strong>".$offer['serviceType']." <br>
                            <strong>Start date - End date:</strong> ".$offer['startDate']." - ".$offer['endDate']."<br>
                            <strong>Duration:</strong> ".$offer['startTime']." - ".$offer['endTime']." <br>
                            <strong>My Offer:</strong> ".$offer['price']." SR/hour <strong>Offer Status: </strong>";
                            switch($offer['offerStatus']){
                              case 'Pending':
                                echo "<span>Pending";
                                break;
                              case 'Expired':
                                echo "<span style='color: grey;'>Expired<img src='css/images/question.png' alt='question mark' style='width: 17px; float: right; margin-top: 3px; position: static; margin-right: 350px;' class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='This job request was sent over an hour ago with no reply from the parent.'>";
                                break;
                              case 'Accepted':
                              echo"<span style='color: green;'>Accepted";
                              break;
                             case 'Rejected':
                              echo"<span style='color: red;'>Rejected";
                              break;
                              case 'Canceled':
                                echo "<span style='color: grey;'>Canceled<img src='css/images/question.png' alt='question mark' style='width: 17px; float: right; margin-top: 3px; position: static; margin-right: 350px;' class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='This job request was recently updated. You may send another offer if the request is still available.'>";
                                break;

                            }
                           echo " </span></p>
                          </div>
                      </article>";
                      }
                    } 
                    else{
                      echo "<p style='color: grey; position: static; text-align: center; margin-top: -2%;'>No offers yet..</p>
                      <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
                      }?>

  <p class='footer'>Jalees &copy; <a href='mailto:Jalees@gmail.com'>Contact Us</a></p>
    


  <script>
         document.querySelectorAll('[data-bs-toggle="popover"]')
    .forEach(popover => {
      new bootstrap.Popover(popover)
    })
    </script>



</body>



</html>