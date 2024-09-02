<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GBA System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/landingassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/landingassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/landingassets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/landingassets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/landingassets/vendor/aos/aos.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/landingassets/css/main.css" rel="stylesheet">

   {{-- <style>
        .logo img {
            width: 90px; /* Increase width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        @media (max-width: 768px) {
            .logo img {
                width: 60px; /* Smaller size for mobile view */
            }
        }
    </style> --}}
</head>

<body class="index-page">
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/landingassets/img/logo.png" alt=""> -->
        <img src="/img/GBA-LOGO.png" class="card-img-top" alt="Logo">
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

      <a class="btn-getstarted" style="background-color: #00923f;" href="{{ url('/login') }}">Sign In</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Hero Section - Home Page -->
    <section id="hero" class="hero">

      <img src="assets/landingassets/img/birds/2.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
          <h2>Welcome to</h2>
			<h2 data-aos="fade-up" data-aos-delay="300" style="color: #00923f;font-size: 5em;">Group Burial Association<span style="color: red;">.</span></h2><br>
			
          </div>
          <div class="col-lg-5">
            {{-- <form action="/../index.php" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
              <input type="text" class="form-control" placeholder="Enter email address">
              <input type="button" class="btn btn-primary" onclick="document.location='/register'" value="Join Now">
            </form> --}}
          </div>
          
        </div>
      </div>

    </section><!-- End Hero Section -->

  </main>


  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader" >
    <div class="bg-success"></div>
    <div class="bg-success"></div>
    <div class="bg-success"></div>
    <div class="bg-success"></div>
    <div class="bg-success"></div>

  </div>

  <!-- Vendor JS Files -->
  <script src="assets/landingassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/landingassets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/landingassets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/landingassets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/landingassets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/landingassets/vendor/aos/aos.js"></script>
  {{-- <script src="assets/landingassets/vendor/php-email-form/validate.js"></script> --}}

  <!-- Template Main JS File -->
  <script src="assets/landingassets/js/main.js"></script>

</body>

</html>