<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

  
<!-- Mirrored from prium.github.io/falcon/v3.22.0/pages/errors/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 08:15:55 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>LPO</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../assets/js/config.js"></script>
    <script src="../vendors/simplebar/simplebar.min.js"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="../vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="../assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="../assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="../assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>

  <body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <div class="row flex-center min-vh-100 py-6 text-center">
          <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
            <div class="card">
              <div class="card-body p-4 p-sm-5">
                <div class="fw-black lh-1 text-300 fs-error">
                <div class="spinner-border text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                </div>
                <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">Please wait while we generate the purchased order pdf.</p>
                <hr />
                <!-- <small class="lead mt-4 text-800 font-sans-serif mx-auto fs-10">if the download has not started after 5 seconds, click the button below.</small> -->

                <form id="autoSubmitForm" action="../config/generate-po.php" method="POST">
                    <input type="text" name="poid" value="<?php echo $_GET['elcoco'];?>" hidden>
                    <!-- Submit Button
                    <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-3" onclick="handleSubmit()" style="display:none;">Submit</button>

                    Loading Button Container
                    <div class="mb-3" id="loading-btn-container" style="display:none;">
                        <button id="loading-btn" class="btn btn-primary d-block w-100 mt-3" type="button" disabled="">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div> -->
                    <button type="submit" class="btn btn-primary mt-3" hidden>submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->
    
    

    <script>
        window.onload = function() {
            document.getElementById("autoSubmitForm").submit();
            setTimeout(function() {
              window.location.href = "../PO-logs/"; // Redirects after submission
            }, 8000); // 5000 milliseconds = 5 seconds
            
        };
    </script>
    <!-- <script>
        // Function to handle submit button click
        function handleSubmit() {
            // Hide the submit button and show the loading container
            document.getElementById("submit-btn").style.display = "none";
            document.getElementById("loading-btn-container").style.display = "block";

            // After 2 seconds, revert the visibility
            setTimeout(() => {
                document.getElementById("loading-btn-container").style.display = "none";
                document.getElementById("submit-btn").style.display = "block";
            }, 2000);
        }

        // Page load event to show loading container for 5 seconds
        window.onload = function() {
            // Show the loading container on page load
            document.getElementById("loading-btn-container").style.display = "block";

            // After 5 seconds, hide the loading container and show the submit button
            setTimeout(() => {
                document.getElementById("loading-btn-container").style.display = "none";
                document.getElementById("submit-btn").style.display = "block";
            }, 5000);
        };
    </script> -->

    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="../vendors/popper/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/anchorjs/anchor.min.js"></script>
    <script src="../vendors/is/is.min.js"></script>
    <script src="../vendors/fontawesome/all.min.js"></script>
    <script src="../vendors/lodash/lodash.min.js"></script>
    <script src="../vendors/list.js/list.min.js"></script>
    <script src="../assets/js/theme.js"></script>
  </body>


<!-- Mirrored from prium.github.io/falcon/v3.22.0/pages/errors/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 08:15:55 GMT -->
</html>
