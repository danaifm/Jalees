<!DOCTYPE html> <!--no errors, navbar done-->
<?php 
session_start();
if(!isset($_SESSION['babysitterID'])){
  if(isset($_SESSION['parentID']))
  header("Location: parentHome.php?error=1");
  else
  header("Location: index.php?error=1");
}
include 'PHP/offerStatusUpdate.php';




?>

  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel ="stylesheet" href="css/viewOffers.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <!-- using jquery for the 1st time -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <title>Jalees</title>
    </head>
<body>
  <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
  <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);">
    <div class="container-fluid">
      <!-- making the brand name as a heading -->
      <a class="navbar-brand mb-0 h1" href="babysitterHome.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
          <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
          <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        

          <!-- justify-content-end to make left allignment -->
          <div class="collapse navbar-collapse" id="cNav">
            <!-- list of itms in the navbar -->
            <ul class="navbar-nav" style="margin-left: -200px;">
              <li class="nav-item"><a href="babysitterHome.php" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Jobs</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="CurrentBabysitterJobs.php">Current Jobs</a></li>
                      <li><a class="dropdown-item" href="PreviousBabysitterJobs.php">Previous Jobs</a></li>
                    </ul>
                  </li> 
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Profile</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="viewProfileBabysitter.php">View Profile</a></li>
                      <li><a class="dropdown-item" href="EditBabysitterProfile.php">Manage Profile</a></li>
                      <li><a class="dropdown-item" href="php/signout.php">Log Out</a></li>
                    </ul>
                  </li>
                <li class="nav-item " ><a href="mailto:Jalees@gmail.com" class="nav-link ">Ask Us</a></li>
            </ul>
        </div>
      </div>
    </div>


        <!--loop to read from database, only reads job requests with no babysitter-->

        <h1 style="text-align: center; margin-top: 3%;">Job Request List</h1>
        
        <div class = "req" id="here">
          <?php
                    error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    Define("host","localhost");
                    Define("Username", "root");
                    Define("Password", "");
                    Define("db", "Jalees");
                    $connection = mysqli_connect(host, Username, Password, db);
                    if(!$connection)
                    die();
                    $b = true;
                    $query = "SELECT * FROM jobRequests WHERE ((CAST(CURRENT_TIMESTAMP AS DATE) < endDate) OR (CAST(CURRENT_TIMESTAMP AS DATE) = endDate AND endTime > CAST(CURRENT_TIMESTAMP AS TIME))) AND babysitterID IS NULL AND NOT (reqStatus = 'Expired')"; 
                    $result = mysqli_query($connection, $query);
                    if(mysqli_num_rows($result) > 0){    //if requests exist
              while($row = mysqli_fetch_array($result)){  //row -> the active requests with no babysitters
                //first check if the request is not expired
                $prevOffer = "SELECT * FROM Offers WHERE Offers.babysitterOfferID =".$_SESSION['babysitterID']." AND Offers.requestID = ".$row['ID']." AND (offerStatus = 'Pending' OR offerStatus = 'Accepted')";
                $prevOfferQuery = mysqli_query($connection, $prevOffer);
                //now check if the babysitter has previously send an offer
                if(mysqli_num_rows($prevOfferQuery) == 0 ){ //no previously sent pending/accepted/rejected offers for this request (expired is okay)
                  //NOW CHECK DATE/TIME CONFLICT 
                  $startDate = "'".$row['startDate']."'";
                  $endDate = "'".$row['endDate']."'";
                  $startTime = "'".$row['startTime']."'";
                  $endTime = "'".$row['endTime']."'";
                $timeConflict = "SELECT * FROM jobRequests WHERE jobRequests.babysitterID = ".$_SESSION['babysitterID']." AND  ( ((startDate between $startDate and $endDate) or (endDate between $startDate and $endDate) or ($startDate between startDate and endDate) or ($endDate between startDate and endDate) ) AND ((startTime between $startTime and $endTime) or (endTime between $startTime and $endTime) or ($startTime between startTime and endTime) or ($endTime between startTime and endTime)))";
                $timeConflictQuery = mysqli_query($connection, $timeConflict);
                if(mysqli_num_rows($timeConflictQuery) == 0){ //if no time conflicts with the request finally print it
                  $offertimeconflict = "SELECT * FROM jobRequests INNER JOIN Offers ON Offers.requestID = jobRequests.ID WHERE offerStatus='Pending' AND babysitterOfferID=".$_SESSION['babysitterID']." AND  ( ((startDate between $startDate and $endDate) or (endDate between $startDate and $endDate) or ($startDate between startDate and endDate) or ($endDate between startDate and endDate) ) AND ((startTime between $startTime and $endTime) or (endTime between $startTime and $endTime) or ($startTime between startTime and endTime) or ($endTime between startTime and endTime)))";                  ;
                $offertimeconflictresult = mysqli_query($connection, $offertimeconflict);
                  if(mysqli_num_rows($offertimeconflictresult) == 0){
                  $b = false;

                $query = "SELECT  parentID, firstName, lastName, photo FROM Parents WHERE parentID=".$row['parentID'].";"; 
                $a = mysqli_fetch_array(mysqli_query($connection, $query));
                echo "<article id='".$row['ID']."'> <img class='requestPicture' src=".$a['photo']." alt='Profile Picture'>
                <div class='information'>
                <h4 class='requestName'><strong>Parent's name: </strong>".$a['firstName']." ".$a['lastName']."</h4>
                <p><strong>Kid's names: </strong>".$row['kidsNames']."<br>
                <strong>Kid's ages: </strong>".$row['kidsAges']."<br>
                <strong>Type of service: </strong>".$row['serviceType']."<br>
                <strong> Start date - End date: </strong>".$row['startDate']." - ".$row['endDate']."<br>
                <strong>Duration: </strong>".$row['startTime']." - ".$row['endTime']." <br>
                <a class='btn btn-outline-secondary' href='#' role='button' id='show".$row['ID']."' style='width: 190px;'>Send an Offer</a>
                <div id='hide".$row['ID']."' style='display: none;'>";?>

                <form method='post' action='PHP/sendOffer.php?id=<?php echo $row['ID']; ?>' onsubmit="return confirm('Are you sure you want to send this offer?');">
                  <? echo"
                    <input type='number' min='100' max='999' placeholder='Price in SR/hour' name='priceoffer' style='border: 1px; color: #555; border-style:solid; width: 200px;'>
                    <input type='hidden' value='".$row['ID']."' name='rowval'>
                    <input type ='submit' value='Send Offer' class='btn btn-outline-secondary'>
                  </form>
                </div>
                </div>
            </article>
            <script>
            $(document).ready(function() {
                  $('#show".$row['ID']."').click(function() {
                    $('#hide".$row['ID']."').fadeIn('slow');
                    $('#show".$row['ID']."').fadeOut();
                  });
                });
          </script>";}//end if job conflict
              }//end if offer conflict
        }//end if previous offer
    }//end while
    if($b){
      echo "<p style='color: grey; text-align: center;'>No Current Requests...</p>
      <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
    }
 }//end if offers exist
  else{
    echo "<p style='color: grey; text-align: center;'>No Current Requests...</p>
    <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
  }

           ?>
           </div>


  

  <p class="footer">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>
    

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
        <p>Your offer has been sent successfully.</p>
      </div>
    </div>
  </div>
</div>



</body>



</html>