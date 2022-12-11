<!DOCTYPE html>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/loginStyleSheet.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
   <script src="bootstrap/js/ie-emulation-modes-warning.js"></script>
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
                <li class="nav-item"><a href="index.php" class="nav-link ">Home</a></li>
                  <li class="nav-item"><a href="joinnow.php" class="nav-link">Join now!</a></li>
                  <li class="nav-item"><a href="login.php" class="nav-link active">Log in</a></li>
                  <li class="nav-item"><a href="mailto:Jalees@gmail.com" class="nav-link">Ask us</a></li>
              </ul>
          </div>
        </div>
        </div>
  

        <div class="vh-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Hello Again!</p>
                  <p class="text-center h6 fw mb-5 mx-1 mx-md-4 mt-4">Sign in to continue</p>
                
             

            
                <br>
                <?php
                        if(isset($_GET['error']))
                            echo "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";
                        ?>

                          <?php
                        if(isset($_GET['success']))
                            echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>";
                        ?>

                  <!-- Form -->
                  <form action="PHP/loginPHP.php" method="post">
                    <div class="form-outline">
                      <label class="form-label" for="loginEmail"><strong>Email</strong></label>
                      <input type="text" name="email" class="form-control" required >
                    </div>
                    <br>
                    <div class="form-outline">
                      <label class="form-label" for="loginPassword"><strong>Password</strong></label>
                      <input type="password" name="password" class="form-control" required >
                    </div>

                  <br>

                    <br>
                    <br>

                    <input type="submit" value="Log In" class="btn btn-outline-secondary btn-lg" style="margin-left:25%;">          
           
                    </form>

                    <br>

                    <p style="font-size:19px;">Don't have an account? <a href="joinnow.html">Sign up now</a></p>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                      
                       <!-- image from https://undraw.co/illustrations -->
                      <img src="css/images/loginPicture.png" class="img-fluid" alt="login picture">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      
        
      </div>

      <!-- Footer -->
      <p class="footer">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>        

</body>

</html>


