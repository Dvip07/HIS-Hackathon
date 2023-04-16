<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>White Hats</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">

  <link rel="stylesheet" href="../css/custom.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/logo.png" />
  <style type="text/css">
    #clg {
      width: 70px;
      height: 50px;
      margin-bottom: 10px;
    }

    #errorprint {
      color: red;
    }
    #clgLG{
      color: rgb(76, 74, 168);
      font-weight: 900;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <?php
  session_start();

  if (isset($_SESSION['success_login']) == TRUE) {
    header('Location:../pages/index.php');
  }
  ?>


  <div class="container-fluid bg-primary text-light">
    <div class="pl-5 pt-4 pb-3 d-flex flex-column">
      <h3> White Hats</h3>
      <!-- <p class="fs-6 mt-1"> This portal is used for students and other education it will help them to manipulate thing in very efficent and structured way that save their time in day to day task.</p> -->
    </div>
  </div>

  <div class="container-scroller setHeight">

    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 setHeight">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center><img src="../images/logo.png" alt="logo" id="clg"><br><text id="clgLG">White Hats</text></center><br>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="../backend/DB_login.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <center><small id="errorprint">
                    <?php
                    if (isset($_SESSION['Invalid'])) {
                      echo $_SESSION['Invalid'];
                      unset($_SESSION['Invalid']);
                    }
                    ?>
                  </small></center>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN">
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>

      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->

  </div>

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Guided By : Piyush Patel & Dr. Ajay Upadhyaya</span>
      <span class=" text-center text-sm-left d-block d-sm-inline-block">Developed by: Shiv Patel, Javlan Patel, Heet Patel, Jatin Parmar, Khyati Patel.</span> -->
    </div>
    <div class="d-sm-flex justify-content-center justify-content-sm-between mt-2">
      <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 SAL Education. All rights reserved.</span> -->
    </div>

  </footer>


  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>