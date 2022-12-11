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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/joinstyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        <title>Jalees</title>
    </head>
    <body style=" background-color: #eee">
              <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
              <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);" >
                <div class="container-fluid">
                  <!-- making the brand name as a heading -->
                  <a class="navbar-brand mb-0 h1" href="index.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
                      <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
                      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
          
                    <!-- justify-content-end to make left allignment -->
                  <div class="collapse navbar-collapse" id="cNav">
                      <!-- list of itms in the navbar -->
                      <ul class="navbar-nav" style="margin-left: -200px;">
                        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                          <li class="nav-item"><a href="joinnow.php" class="nav-link active">Join now!</a></li>
                          <li class="nav-item"><a href="login.php" class="nav-link">Log in</a></li>
                          <li class="nav-item"><a href="mailto:Jalees@gmail.com" class="nav-link">Ask us</a></li>
                      </ul>
                  </div>
                </div>
                </div>


    <div class = "join">
      <h1 >Let's get you started!</h1> <br>
      
      <div class = "type" style="float: left; background-color: white;"> <!--undraw.com-->
        <img class="images" src="css/images/undraw_baby_p4dd.svg" alt="Babysitter">
        <h2 class="card-title">I'm a babysitter</h2>
        <p class="card-text">Start searching for babysitting jobs in your area.</p>
        <a href="signUpBabySitter.php" class="btn btn-outline-secondary btn-lg">Find jobs</a>
      </div>

      <div class = "type" style="float: right; background-color: white;"> <!--undraw.com-->
        <img class="images" src="css/images/undraw_family_vg76.svg" alt="Parent">
        <h2 class="card-title">I'm a parent</h2>
        <p class="card-text">Find a trusted and professional babysitter in your area.</p>
        <a href="signUpParent.php" class="btn btn-outline-secondary btn-lg">Find care</a>
      </div>
    </div>

    <p class="footer">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>
    </body>
</html>