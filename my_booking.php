<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else { ?>
    <!DOCTYPE html>
    <html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--=== Favicon ===-->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

        <title>MD Autovermietung | Meine Bestellungen</title>

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

    <?php include('includes/header.php'); ?>

    <!--== SlideshowBg Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Bestellungen</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Liste deiner Bestellungen</p>
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
                        <h2>Meine Bestellungsliste</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p class="text-info">MD Autovermietung</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
            <div class="row">
                <?php
                $useremail = $_SESSION['login'];
                $sql = "SELECT * from users where Email=:useremail";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <!-- Single Car Start -->
                        <?php
                        $useremail = $_SESSION['login'];
                        $sql = "SELECT cars.*, cars.CarImage1 as Vimage1,cars.CarTitle,cars.id as vid,brands.Name,booking.FromDate,booking.ToDate,booking.Message,booking.Status  from booking join cars on booking.CarID=cars.id join brands on brands.id=cars.CarBrand where booking.UserEmail=:useremail";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <!-- Single Car Start -->
                                <div class="single-car-wrap">
                                    <div class="row">
                                        <!-- Single Car Thumbnail -->
                                        <div class="col-lg-5">
                                            <div class="vehicle_img"> <a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>""><img src="admin/img/carimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                                        </div>
                                        <!-- Single Car Thumbnail -->
                                        <!-- Single Car Info -->
                                        <div class="col-lg-7">
                                            <div class="display-table">
                                                <div class="display-table-cell">
                                                    <div class="car-list-info">
                                                        <h4><a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>""> <?php echo htmlentities($result->Name);?> , <?php echo htmlentities($result->CarTitle);?></a></h4>

                                                        <p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?></p>

                                                        <p><?php echo htmlentities($result->CarOverview); ?></p>
                                                        <ul class="car-info-list">
                                                            <?php if($result->AirConditioner == 1) { ?>
                                                                <li>Klimaanlage</li>
                                                            <?php } else if ($result->AntiLockBrakingSystem == 1) { ?>
                                                                <li>ABS</li>
                                                            <?php } ?>
                                                            <li><?php echo htmlentities($result->FuelType);?></li>
                                                            <li><?php echo htmlentities($result->ModelYear);?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Car info -->
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    <?php }
                } ?>

            </div>
        </div>
    </section>
    <!--== About Us Area End ==-->

    <!--== footer ==-->
    <?php include('includes/footer.php'); ?>
    <!--== footer ==-->
    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--== Login-Form ==-->
    <?php include('includes/login.php'); ?>
    <!--==/Login-Form ==-->

    <!--== Register-Form ==-->
    <?php include('includes/registration.php'); ?>
    <!--== /Register-Form ==-->

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
<?php } ?>