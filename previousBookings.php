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
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel ='stylesheet' href='css/viewOffers.css'>
        <link rel='stylesheet' href='css/reviewStyling.css'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.10.2/css/all.css'>
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
                      <a class='nav-link dropdown-toggle active' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>My Bookings</a>
                      <ul class='dropdown-menu'>
                        <li><a class='dropdown-item' href='currentBookings.php'>Current Bookings</a></li>
                        <li><a class='dropdown-item active' href='previousBookings.php'>Previous Bookings</a></li>
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


            <h1 style=' text-align: center; margin-top: 3%;'>My Previous Bookings</h1>
            <div class = 'bookings'>
              <?php 
             //error_reporting(E_ERROR | E_WARNING | E_PARSE);
              Define("host","localhost");
              Define("Username", "root");
              Define("Password", "");
              Define("db", "Jalees");
              $connection = mysqli_connect(host, Username, Password, db);
              if(!$connection) 
              die();

              ////////////////ابدي هنا بدور
              $count = 0;

              $query = "SELECT * FROM jobRequests WHERE CAST(CURRENT_TIMESTAMP AS DATE) >= endDate AND babysitterID IS NOT NULL AND jobRequests.parentID = ".$_SESSION['parentID']." ORDER BY ID DESC;"; //if the end date for the booking is in the past from today's date (order starting from most recent bookings)
              //for current bookings: SELECT * FROM jobRequests WHERE NOT (CAST(CURRENT_TIMESTAMP AS DATE) > endDate) AND babysitterID IS NOT NULL AND jobRequests.parentID = ".$_SESSION['parentID']." ORDER BY ID DESC;
              //اتوقع ههههه
              $result = mysqli_query($connection, $query);
              if(mysqli_num_rows($result) > 0){
              while($req = mysqli_fetch_array($result)){
                if(date('y-m-d') > $req['endDate'] || (date() == $req['endDate'] && time() > $req['endTime'])){
                   //if the end date is in the past OR if the end time is earlier today -> previous 
                  //for current: ( date() > req end date || ( date() == req end date && time() < req end time) )
                  $bb = "SELECT * FROM Babysitters WHERE ID=".$req['babysitterID'].";";
                  $babysitters = mysqli_fetch_array(mysqli_query($connection, $bb));
                  $offerQuery = "SELECT * FROM Offers WHERE offerStatus = 'Accepted' AND requestID =".$req['ID']." AND babysitterOfferID = ".$req['babysitterID'].";";
                  $offer = mysqli_fetch_array(mysqli_query($connection, $offerQuery));
                  $count++;
                    echo "<article>
                    <img class='requestPicture' src = '".$babysitters['photo']."' alt='Profile Picture'>
                    <div class = 'info'> 
                        <h4 ><strong>Babysitter's name: </strong>".$babysitters['firstName']." ".$babysitters['lastName']."</h4> 
                        <h5>Price: ".$offer['price']." SR/hour</h5>
                        <p><strong>Kid's names: </strong>".$req['kidsNames']."<br>
                        <strong>Type of service: </strong>".$req['serviceType']."<br>
                        <strong> Start date - End date: </strong>".$req['startDate']." - ".$req['endDate']."<br>
                        <strong>Duration: </strong>".$req['startTime']." - ".$req['endTime']." <br>";

                        //هنا ستوب

                        /////////////REVIEW BUTTON 2 cases: previously submitted a review or not

                        $queryReviews = "SELECT * FROM Reviews WHERE parent=".$_SESSION['parentID']." AND babysitter=".$req['babysitterID'].";";
                        $reviewResult = mysqli_query($connection, $queryReviews);
                        if(mysqli_num_rows($reviewResult) == 0){ //if parent has never left a review for this babysitter
                        echo "
                        <button type='button' style='width: 40%;' class='btn btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#modal".$req['ID']."'>
                        Leave a Review </button>
                        </div>
     
                        <!-- Modal -->
                       <div class='modal fade' id='modal".$req['ID']."' tabindex='-1' aria-hidden='true'>
                         <div class='modal-dialog'>
                           <div class='modal-content'>
                             <div class='modal-header'>
                               <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                             </div>
                             <div class='modal-body'>

                              <h4 style='text-align: center;'>How was your experience?</h4>
                              <img src='css/images/undraw_reviews_lp8w.svg' alt='Review picture' style='width: 250px; margin-left: 23%; margin-bottom: 5%;'>

                              <form method='post' action='PHP/postReview.php'>
                                <input type='text' name='title' id='form3Example4cd' class='form-control' placeholder='Title' style='margin-top: 2%; margin-bottom: 4%;'>
                                <input type='hidden' value='".$req['babysitterID']."' name='babysitter'>
                                
                                <label class='form-label' for='exampleFormControlTextarea1'>Leave Your Review!</label>
                                <textarea class='form-control' name='review' id='exampleFormControlTextarea1' rows='3'></textarea>
                                <div class='star-rating'>
                                    <div class='star-input'>
                                        <input type='radio' name='rating' id='rating-5' value='5'>
                                        <label for='rating-5' class='fas fa-star'></label>
                                        <input type='radio' name='rating' id='rating-4' value='4'>
                                        <label for='rating-4' class='fas fa-star'></label>
                                        <input type='radio' name='rating' id='rating-3' value='3'>
                                        <label for='rating-3' class='fas fa-star'></label>
                                        <input type='radio' name='rating' id='rating-2' value='2'>
                                        <label for='rating-2' class='fas fa-star'></label>
                                        <input type='radio' name='rating' id='rating-1' value='1'>
                                        <label for='rating-1' class='fas fa-star'></label>
                        
                                        <!-- Rating Submit Form -->
                                            <button type='submit' class='btn btn-outline-secondary' style='width: 100%;'>Submit</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                    
                </article> ";
                   }
                  else { //parent has left a review for the babysitter in the past
                    echo"<span class='d' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-content='You have previously submitted a review for this babysitter.'>
                    <button disabled='' class='btn btn-outline-secondary' type='button' style='width: 300px; background-color: rgb(222, 219, 219);'>Leave a Review</button>
                    </span></article>";
              }
                  }}
                  if($count == 0){
                    echo "<p style='color: grey; text-align: center;'>No Previous Bookings..</p>
                    <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";          
                   }}
                   else{ 
                    echo "<p style='color: grey; text-align: center;'>No Previous Bookings..</p>
                    <img style='position: static; margin-left: 30%; width: 400px; margin-bottom: 5%;' src='css/images/undraw_searching_re_3ra9.svg'>";
                   } 
               
                   $connection -> close(); 
                   ?>
    <script>
         document.querySelectorAll('[data-bs-toggle="popover"]')
    .forEach(popover => {
      new bootstrap.Popover(popover)
    })
    </script>
            <p class='footer'>Jalees &copy; <a href='mailto:Jalees@gmail.com'>Contact Us</a></p>

      </body>
</html>