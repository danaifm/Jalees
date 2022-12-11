<!DOCTYPE html> <!--no errors, navbar done-->
<?php
session_start();
include 'PHP/connection.php';
if(!isset($_SESSION['parentID'])){
  if(isset($_SESSION['babysitterID']))
  header("Location: babysitterHome.php?error=1");
  else
  header("Location: index.php?error=1");
}
if(!isset($_GET['reqID']))
header("Location: parentHome.php?error=1");
include 'PHP/offerStatusUpdate.php' ?>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> <!--stars rating-->
        <link rel ='stylesheet' href='css/viewOffers.css'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>
        
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
                      <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Profile</a>
                      <ul class='dropdown-menu'>
                        <li><a class='dropdown-item' href='viewProfileParent.php'>View Profile</a></li>
                        <li><a class='dropdown-item' href='EditParentProfile.php'>Manage Profile</a></li>
                        <li><a class='dropdown-item' href='php/signout.php'>Log Out</a></li>
                      </ul>
                    </li>
                  <li class='nav-item ' ><a href='mailto:Jalees:gmail.com' class='nav-link '>Ask Us</a></li>
              </ul>
            </div>
          </div>
          </div>

          
            <h1 style=' text-align: center; margin-top: 3%; margin-right: 4%;'>Offer List</h1>
            <div class = 'req'>
            <?php
                    $query = "SELECT * FROM Offers INNER JOIN jobRequests ON jobRequests.ID = Offers.requestID WHERE parentID = ".$_SESSION['parentID']." AND jobRequests.createdAt > DATE_SUB( NOW( ) , INTERVAL 1 HOUR ) AND offerStatus = 'Pending' AND Offers.requestID=".$_GET['reqID'].";";
                    $result = mysqli_query($connection, $query);
                    if(mysqli_num_rows($result) > 0){
                      while($offer = mysqli_fetch_array($result)){
                        $babysitterQuery = "SELECT * FROM Babysitters WHERE Babysitters.ID = ".$offer['babysitterOfferID'].";";
                        $babysitter = mysqli_fetch_array(mysqli_query($connection, $babysitterQuery));
                        echo "<article>
                        <img class='requestPicture' src = '".$babysitter['photo']."' alt='Profile Picture'>
                        <h3 class = 'requestName'><strong>Babysitter's name: </strong> ".$babysitter['firstName']." ".$babysitter['lastName']." </h3> 
                        <h4>Price: ".$offer['price']." SR/hour</h4>
                        <!-- Button trigger modal -->
                      <button type='button' class='btn btn-outline-secondary' style='float: left;' data-bs-toggle='modal' data-bs-target='#modal".$babysitter['ID']."'>
                       View Details </button>
                       <div class='modal fade' id='modal".$babysitter['ID']."' tabindex='-1'  aria-hidden='true'>
                       <div class='modal-dialog modal-lg'>
                         <div class='modal-content'>
                           <div class='modal-header'>
                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                           </div>
                           <div class='modal-body'>
                             <div class = 'profile'>
                               <img src = '".$babysitter['photo']."' alt='Profile Picture' style='border-radius: 50%;'>
                               <div class = 'info'>
                                   <h2 ><strong>Name: </strong>".$babysitter['firstName']." ".$babysitter['lastName']."</h2>                            
                                   <p><strong>ID: </strong>".$babysitter['userID']."<br>
                                   <strong>Age: </strong>".$babysitter['age']." years old <br>
                                   <strong>Gender: </strong>".$babysitter['gender']."<br>
                                   <strong>City: </strong>".$babysitter['city']."<br>
                                   <strong>Bio: </strong> <br> ".$babysitter['bio']."
                               </p>";?>
       
                               
                                   <a class='btn btn-outline-secondary'data-bs-toggle="modal" href="#contactModal" role='button'>Contact Me</a>
                                   <?php echo"
                               </div>
                               <h3 style='margin-left: 5%; margin-bottom: 2%;'>Ratings and Reviews:</h3>
                               <div>";
                                 $queryReviews = "SELECT * FROM Reviews LEFT JOIN Parents ON Reviews.parent=Parents.parentID WHERE Reviews.babysitter=".$babysitter['ID'].";";
                                 $resultReviews = mysqli_query($connection, $queryReviews);
                                 if(mysqli_num_rows($resultReviews)>0){
                                  while($rowRev = mysqli_fetch_array($resultReviews)){
                                      echo "<article><img class='requestPicture' style='width: 150px; border-radius: 7px; float: left; margin-top: 2%; margin-right: 3%; border-radius: 70px;' src=".$rowRev['photo']." alt='Profile Picture'>
                                      <div class='information'>
                                      <h5 class='requestName'><strong>Parent's name: </strong>".$rowRev['firstName']." ".$rowRev['lastName']."</h5>
                                      <div class='ratings'>";
                                      switch($rowRev['stars']){
                                          case '0':
                                              echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
                                              break;
                                          case '1':
                                              echo "<i class='fa fa-star rating-color'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
                                              break;
                                          case '2':
                                              echo "<i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
                                              break;
                                          case '3':
                                              echo "<i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
                                              break;
                                          case '4':
                                              echo "<i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star'></i>";
                                              break;
                                          case '5':
                                              echo "<i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i><i class='fa fa-star rating-color'></i>";
                                              break;
                                      }
                                      echo "</div></div>
                                      <h6 class = 'title'>".$rowRev['title']."</h6>
                                      <p>".$rowRev['review']."</p>
                              </article>";
                                  }
                              }
                              else{
                                  echo "<p style='color: grey; position: static; text-align: center;'>No reviews yet..</p>";
                              }
                              echo"
                            </div>
                           </div>
                           </div>
                         </div>
                       </div>
                     </div>";?>
                     <span>
                     <form onsubmit="return confirm('Are you sure you want to accept this offer?');" method="post" action="<?php echo "PHP/acceptOffer.php?offerID=".$offer['offerID']."&reqID=".$offer['requestID']."";?>">
                     <?php
                     echo"
                       <input type='submit' value='Accept Offer' class='btn btn-outline-secondary' style='color: green; border-color: green; float: left;'></form>";?>
                       <form onsubmit="return confirm('Are you sure you want to reject this offer?');" method="post" action="<?php echo "PHP/rejectOffer.php?offerID=".$offer['offerID']."&reqID=".$offer['requestID']."";?>">
                       <?php echo"
                       <input type='submit' value='Reject Offer' class='btn btn-outline-secondary' style='color: red; border-color: red;'></form></span>
                   </article>";
                      }
                    }
                    else
                    echo "<p style='color: grey; position: static; text-align: center; margin-top: -2%; margin-right: 5%;'>No offers yet..</p>
                    <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";

                    ?>

              <!-- footer -->
    <br>
    <p class='footer'>Jalees &copy;
    <a href='mailto:Jalees@gmail.com'>Contact Us</a>
    </p>

    <?php
    if(isset($_GET['accepted']))
    $acc = true;
    else
    $acc = false;
    if(isset($_GET['rejected']))
    $rej = true;
    else
    $rej = false;
    ?>  
    <?php
    if($acc)
    echo "<script type='text/javascript'> $(window).load(function(){ $('#accepted').modal('show'); }); </script>";
    else if($rej)
    echo "<script type='text/javascript'> $(window).load(function(){ $('#rejected').modal('show'); }); </script>";

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

<div class="modal fade" id="rejected" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Offer has been rejected successfully.</p>
      </div>
    </div>
  </div>
</div>

                                    <div class="modal fade" id="contactModal"  aria-hidden="true" >
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Contact me...</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <span>
                                          <a class='btn btn-outline-secondary'style='float: left; margin-left: 25px; width: 45%;' href="mailto:<?php echo $babysitter['email'];?>" role='button'>Email</a>
                                          <a class='btn btn-outline-secondary' style="width: 45%;" href=" https://wa.me/<?php echo $babysitter['phone'];?>" target="_blank" role='button'>Whatsapp</a>       
                                          </span>
                                          </div>
                                          <div class="modal-footer">
                                          <button class="btn btn-secondary" data-bs-target="#modal<?php echo $babysitter['ID']?>" data-bs-toggle="modal">Back</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

    </body>
</html>