<!DOCTYPE html> <!--no errors, navbar done-->
<?php
session_start();
if(isset($_SESSION['babysitterID']))
header("Location: babysitterHome.php?error=1");
else if(isset($_SESSION['parentID']))
header("Location: parentHome.php?error=1");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styleProject.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Jalees</title>
</head>
<body>
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
  
    <!-- Hero -->

    <div class="hero" id="home">
      <div class="hero-text">
        <h1>The most trusted site to find a babysitter or nanny near you!</h1>
        <p>Jalees empowers families to thrive by giving them access to the support they need whenever and wherever they need it. </p><br>
        <a class="btn" href="joinnow.php" role="button">Join now!</a>
      </div>
    </div>

    <!-- the grid -->

   
    <div class="container text-center">
      <div class="row"> <!--bootstrap icons-->
        <!-- 1st icon -->
        <div class="col" style="font-size: 25px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="150" fill="currentColor" class="bi bi-browser-chrome" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
          </svg><br>
          Easy-to-use-website
        </div>
        <!-- 2nd icon -->
        <div class="col"  style="font-size: 22px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="150" fill="rgb(229, 221, 175)" class="bi bi-person-workspace" viewBox="0 0 16 16">
            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
          </svg><br>
          Post, edit and cancel <br> job requests
        </div>
        <!-- 3rd icon -->
        <div class="col" style="font-size: 22px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="150" fill="brown" class="bi bi-list-stars" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z"/>
            <path d="M2.242 2.194a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.256-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53zm0 4a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.255-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53zm0 4a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.255-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53z"/>
          </svg><br>
          View babysitter rating and reviews
        </div>
         <!-- 4th icon -->
         <div class="col" style="font-size: 22px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="150" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
          </svg><br>
          Contact babysitters and nannies
        </div>
      </div>
    </div>

    <!-- pic with text -->
   
    <div class="safety">
      <div class="image">
        <!-- image from https://www.pexels.com/ -->
        <img src="css/images/pexels-alex-green-5693030.jpg" style="height: 420px; width: 280px; position: absolute;" alt="Babysitter photo">
        </div>
      <div class="text">
        <h1>SAFETY IS OUR TOP PRIORITY</h1>
        <p> Jalees is committed to the safety of our families and babysitters.
          In order to register on Jalees, every sitter and parent must pass an
           extensive background check, so you can rest 
           assured that your children are in good hands.
       </p>
     </div>
   </div>


  <!-- footer -->
 <br>
    <p class="footer">Jalees &copy;
   <a href="mailto:Jalees@gmail.com">Contact Us</a>
  </p>
                  
<?php
if(isset($_GET['message']))
$modal = true;
else
$modal = false;;

if(isset($_GET['error']))
$err = true;
else
$err = false;
?>
 <?php if($modal)
      echo "<script type='text/javascript'> $(window).load(function(){ $('#myModal').modal('show'); }); </script>";
      if($err)
      echo "<script type='text/javascript'> $(window).load(function(){ $('#errorModal').modal('show'); }); </script>";

  ?>


<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Goodbye!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your account has successfully been deleted. We're sad to see you go!</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="errorModal" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Something went wrong...</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Please log in and try again.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>