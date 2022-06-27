<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Proserti Blast App</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../prosertiblast/resources/assets/img/favicon.png" rel="icon">
  <link href="../prosertiblast/resources/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../prosertiblast/resources/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../prosertiblast/resources/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../prosertiblast/resources/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

   <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">ProA Blast App</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="../index.php/blast">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->
       
       </li><!-- End Dashboard Nav -->
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Reminder Mail Blast</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../index.php/emailblastquick">
              <i class="bi bi-circle"></i><span>Quick Email Blast</span>
            </a>
          </li>
          <li>
            <a href="../index.php/reminder">
              <i class="bi bi-circle"></i><span>Email Schedules</span>
            </a>
          </li>
           <li hidden="true">
            <a href="../index.php/remindertemplate">
              <i class="bi bi-circle"></i><span>Email Template</span>
            </a>
          </li>
        </ul>
      </li><!-- End Dashboard Nav -->
       
       <li class="nav-item">
        <a class="nav-link collapsed" href="../index.php/peserta">
          <i class="bi bi-journal-text"></i><span>Daftar Peserta</span>
        </a>
      </li><!-- End Dashboard Nav -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="../index.php/templatevoucher">
          <i class="bi bi-journal-text"></i><span>Voucher Template</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../">
          <i class="bi bi-box-arrow-right"></i><span>Logout</span>
        </a>
      </li><!-- End Dashboard Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('konten')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Proserti</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../prosertiblast/resources/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/chart.js/chart.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/quill/quill.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../prosertiblast/resources/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../prosertiblast/resources/assets/js/main.js"></script>

</body>

</html>