<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else { ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Autovermietung | Marken verwalten</title>
        <link rel="stylesheet" href="../css/datatables.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../css/bootadmin.min.css">
        <!-- javascript -->
        <script type="text/javascript" src="../js/jquery.min.js"></script>

        <script>
            $(function () {
                $('#dataTable').DataTable({
                    "scrollX": true,
                    "scrollY": 500,
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    </head>
    <body style="background: #fff">
        <?php include('../includes/header.php'); ?>
        <div class="d-flex"> <?php include('../includes/leftsidebar.php'); ?>
            <div class="content content-wrapper mt-4">
                <div class="container">
                    <div class="row">
                        <h2>Marken verwalten</h2>
                        <div class="col-md-12">
                            content
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading scripts -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap.min.js"></script>
        <script src="../js/Chart.min.js"></script>
        <script src="../js/fileinput.js"></script>
        <script src="../js/chartData.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bootadmin.min.js"></script>
    </body>
</html>
<?php } ?>


<!-- client -->
<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Cardoor - Car Rental HTML Template</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Vegas Min CSS ===-->
    <link href="assets/css/plugins/vegas.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">
<!--== Preloader Area Start ==-->
<div class="preloader">
    <div class="preloader-spinner">
        <div class="loader-content">
            <img src="assets/img/preloader.gif" alt="JSOFT">
        </div>
    </div>
</div>
<!--== Preloader Area End ==-->

<?php include ('includes/header.php');?>

<!--== SlideshowBg Area Start ==-->
<section id="page-title-area" class="section-padding overlay">
    <div class="container">
        <div class="row">
            <!-- Page Title Start -->
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>About US</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <!-- Page Title End -->
        </div>
    </div>
</section>
<!--== SlideshowBg Area End ==-->

<!--== About Us Area Start ==-->
<section id="about-area" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Über uns</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                    <p class="text-info">MD Autovermietung</p>
                </div>
            </div>
            <!-- Section Title End -->
        </div>

        <div class="row">
            <!-- About Content Start -->
            <div class="col-lg-6">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="about-content">
                            <p>
                                Wir sind eine Autovermietung und bieten die beste Qualität zu den besten Preisen.
                                Als Basis unseres Unternehmens streben wir nach Flexibilität und Kundenzufriedenheit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Content End -->

            <!-- About Video Start -->
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="assets/img/home-2-about.png" alt="JSOFT">
                </div>
            </div>
            <!-- About Video End -->
        </div>
    </div>
</section>
<!--== About Us Area End ==-->

<!--== footer ==-->
<?php include ('includes/footer.php');?>
<!--== footer ==-->
<!--== Scroll Top Area Start ==-->
<div class="scroll-top">
    <img src="assets/img/scroll-top.png" alt="JSOFT">
</div>
<!--== Scroll Top Area End ==-->

<!--== Login-Form ==-->
<?php include('includes/login.php');?>
<!--==/Login-Form ==-->

<!--== Register-Form ==-->
<?php include('includes/registration.php');?>

<!--== /Register-Form ==-->

<!-- == Forgot-password-Form ==-->
<?php include('includes/forgotpassword.php');?>
<!--== /Forgot-password-Form ==-->

<!--=======================Javascript============================-->
<!--=== Jquery Min Js ===-->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!--=== Jquery Migrate Min Js ===-->
<script src="assets/js/jquery-migrate.min.js"></script>
<!--=== Popper Min Js ===-->
<script src="assets/js/popper.min.js"></script>
<!--=== Bootstrap Min Js ===-->
<script src="assets/js/bootstrap.min.js"></script>
<!--=== Gijgo Min Js ===-->
<script src="assets/js/plugins/gijgo.js"></script>
<!--=== Vegas Min Js ===-->
<script src="assets/js/plugins/vegas.min.js"></script>
<!--=== Isotope Min Js ===-->
<script src="assets/js/plugins/isotope.min.js"></script>
<!--=== Owl Caousel Min Js ===-->
<script src="assets/js/plugins/owl.carousel.min.js"></script>
<!--=== Waypoint Min Js ===-->
<script src="assets/js/plugins/waypoints.min.js"></script>
<!--=== CounTotop Min Js ===-->
<script src="assets/js/plugins/counterup.min.js"></script>
<!--=== YtPlayer Min Js ===-->
<script src="assets/js/plugins/mb.YTPlayer.js"></script>
<!--=== Magnific Popup Min Js ===-->
<script src="assets/js/plugins/magnific-popup.min.js"></script>
<!--=== Slicknav Min Js ===-->
<script src="assets/js/plugins/slicknav.min.js"></script>

<!--=== Mian Js ===-->
<script src="assets/js/main.js"></script>

</body>

</html>


