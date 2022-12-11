<!DOCTYPE html> <!--no errors, navbar done-->
<html lang="en">
<?php
session_start();
include 'PHP/connection.php';
if(!isset($_SESSION['parentID'])){
  if(isset($_SESSION['babysitterID']))
  header("Location: babysitterHome.php?error=1");
  else
  header("Location: index.php?error=1");
}
include 'PHP/offerStatusUpdate.php';
?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel ="stylesheet" href="css/request.css">
        <link rel ="stylesheet" href="css/viewOffers.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <title>Jalees</title>
    </head>
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


              <h1 style="text-align: center; margin-top: 3%;">My Current Job Requests</h1>

            <div class ="req jobs">
            <?php
                    $query = "SELECT * FROM jobRequests WHERE babysitterID IS NULL AND parentID=".$_SESSION['parentID']." ORDER BY ID DESC";
                    $result = mysqli_query($connection, $query);
                    if(mysqli_num_rows($result)> 0){
                      $count = 1;
              while($row = mysqli_fetch_array($result)){
                echo "<article id='".$row['ID']."'> <h4>Request #".$count++."<br></h4>
                <p><strong>Kid's names: </strong>".$row['kidsNames']."<br>
                <p><strong>Kid's ages: </strong>".$row['kidsAges']."<br>
                <strong>Type of service: </strong>".$row['serviceType']."<br>
                <strong> Start date - End date: </strong>".$row['startDate']." - ".$row['endDate']."<br>
                <strong>Duration: </strong>".$row['startTime']." - ".$row['endTime']." <br>";
                if($row['reqStatus']!=='Expired'){
                echo"
                <a class='btn btn-outline-secondary' href='editPostRequest.php?id=".$row['ID']."' role='button'>Edit Request</a>  
                <a class='btn btn-outline-secondary' style='color: red; border-color: red;' href='PHP/deleteRequest.php?id=".$row['ID']."' ";?> onclick="return confirm('Are you sure you want to delete this request?');" <?php echo "role='button'>Delete Request</a>
                <a class = 'btn btn-outline-secondary' href='viewOffers.php?reqID=".$row['ID']."' role='button'>View Offers</a>  ";
                }
                else{
                  echo "
                  <span class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='You are unable to edit this request as it has expired.'>
                  <button disabled='' class='btn btn-outline-secondary' type='button' style='background-color: rgb(222, 219, 219); width: 260px;'>Edit Request</button>
                  </span>
                  <a class='btn btn-outline-secondary' style='color: red; border-color: red;' href='PHP/deleteRequest.php?id=".$row['ID']."' ";?> onclick="return confirm('Are you sure you want to delete this request?');" <?php echo "role='button'>Delete Request</a>
                  <span class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='You are unable to view offers as this request has expired.'>
                        <button disabled='' class='btn btn-outline-secondary' type='button' style='background-color: rgb(222, 219, 219); width: 260px;'>View Offers</button>
                        </span> ";  

                }
              echo"         
            </article>";
              }

              }
            else {
              echo "<p style='color: grey; text-align: center;'>No Current Requests...</p>
              <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
             } 

             ?>
            </div>

    <p class="footer">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>


    <?php
if(isset($_GET['deleteSuccess']))
$deleteSuccess = true;
else
$deleteSuccess = false;

if(isset($_GET['deleteError']))
$deleteError = true;
else
$deleteError = false;
?>
 <?php if($deleteSuccess)
      echo "<script type='text/javascript'> $(window).load(function(){ $('#deleteSuccess').modal('show'); }); </script>";
      if($deleteError)
      echo "<script type='text/javascript'> $(window).load(function(){ $('#deleteError').modal('show'); }); </script>";
  ?>

<div class="modal fade" id="deleteSuccess" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your job request has been deleted successfully.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteError" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Something went wrong..</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>An error occurred. Please try again.</p>
      </div>
    </div>
  </div>
</div>
<?php
    if(isset($_GET['postSuccess']))
    $msg = true;
    else
    $msg = false;
    ?>
    <?php if($msg)
          echo "<script type='text/javascript'> $(window).load(function(){ $('#postModal').modal('show'); }); </script>";
      ?>

    <div class="modal fade" id="postModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Your request has been added successfully. Please note that equests expire in one hour if no offers have been accepted.</p>
          </div>
        </div>
        </div>
</div>



    <?php
    if(isset($_GET['editSuccess']))
    $m = true;
    else
    $m = false;
    ?>
    <?php if($m)
          echo "<script type='text/javascript'> $(window).load(function(){ $('#editModal').modal('show'); }); </script>";
      ?>

    <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Your request has been edited successfully.</p>
          </div>
        </div>
          </div>
</div>

<?php
    if(isset($_GET['accepted']))
    $acc = true;
    else
    $acc = false;
    ?>  
    <?php
    if($acc)
    echo "<script type='text/javascript'> $(window).load(function(){ $('#accepted').modal('show'); }); </script>";

    ?>


<div class="modal fade" id="accepted" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Offer has been accepted successfully.</p>
      </div>
    </div>
  </div>
</div>


<script>
         document.querySelectorAll('[data-bs-toggle="popover"]')
    .forEach(popover => {
      new bootstrap.Popover(popover)
    })
    </script>

    </body>
</html>