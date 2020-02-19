<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    $sql = "INSERT INTO contactus(Name,Email,ContactNb,Message) VALUES(:name,:email,:contactno,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = "Anfrage gesendet. Wir werden Sie in Kürze kontaktieren.";
    } else {
        $error = "Etwas ist schief gelaufen. Es kann sein, Ihre Email schon vergeben ist.";
    }
}
if(isset($_POST['submit'])) {
    $location = $_POST['location'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $bname = $_POST['bname'];
    $sql2="SELECT cars.*, cars.Location FROM cars WHERE (cars.Location=:location)";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':location',$location,PDO::PARAM_STR);
    $query2->execute();
    $results=$query2->fetchAll(PDO::FETCH_OBJ);
    $lastInsertId = $dbh->lastInsertId();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>MD Autovermietung | Startseite</title>
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
<section id="slideslow-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="slideshowcontent">
                    <div class="display-table">
                        <div class="display-table-cell">
                            <h1>BUCHEN SIE NOCH HEUTE EIN AUTO!</h1>
                            <p>FÜR NUR 10 € PRO TAG PLUS 15% RABATT <br> FÜR UNSERE WIEDERKEHRENDEN KUNDEN</p>
                            <div class="book-ur-car">
                                <form action="index.html">
                                    <div class="pick-location bookinput-item">
                                        <select class="selectpicker" name="location" required>
                                            <option value="standort">standort</option>
                                            <?php $ret = "select id, Name from location";
                                            $query = $dbh->prepare($ret);
                                            $query->execute();
                                            $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($resultss as $results) { ?>
                                                    <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->Name); ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="pick-date bookinput-item">
                                        <input id="startDate2" value="Abholdatum" name="fromdate"/>
                                    </div>

                                    <div class="retern-date bookinput-item">
                                        <input id="endDate2" placeholder="Rückgabedatum" name="todate"/>
                                    </div>

                                    <div class="car-choose bookinput-item">
                                        <select class="selectpicker" name="bname" required>
                                            <option value="Marke">Marke</option>
                                            <?php $ret = "select id, Name from brands";
                                            $query = $dbh->prepare($ret);
                                            $query->execute();
                                            $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($resultss as $results) { ?>
                                                    <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->Name); ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="bookcar-btn bookinput-item">
                                        <a href="car_list.php" class="text-white">Suche</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<!--== Fun Fact Area Start ==-->
<section id="funfact-area" class="overlay section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 col-md-12 m-auto">
                <div class="funfact-content-wrap">
                    <div class="row">
                        <!-- Single FunFact Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-funfact">
                                <div class="funfact-icon">
                                    <i class="fa fa-smile-o"></i>
                                </div>
                                <div class="funfact-content">
                                    <p><span class="counter">550</span>+</p>
                                    <h4>Kunden</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Single FunFact End -->

                        <!-- Single FunFact Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-funfact">
                                <div class="funfact-icon">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="funfact-content">
                                    <p><span class="counter">250</span>+</p>
                                    <h4>Fahrzeuge</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Single FunFact End -->

                        <!-- Single FunFact Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-funfact">
                                <div class="funfact-icon">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <div class="funfact-content">
                                    <p><span class="counter">50</span>+</p>
                                    <h4>Büro</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Single FunFact End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Fun Fact Area End ==-->

<!--== Services Area Start ==-->
<section id="service-area" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <<div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Unsere Angebote</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                    <p>Beispiele unsere Fahrzeuge.</p>
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Service Content Start -->
        <div id="choose-ur-car" class="row">
            <div class="col-lg-11 m-auto ">
                <div class="service-container-wrap">
                    <!-- Single Service Start -->
                    <?php $sql = "SELECT cars.CarTitle,brands.Name,cars.PricePerDay,cars.FuelType,cars.ModelYear,cars.id,cars.SeatingCapacity,cars.CarOverview,cars.CarImage1 from cars join brands on brands.id=cars.CarBrand";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="single-popular-car">
                                <div class="p-car-thumbnails">
                                    <a href="car_details.php?vhid=<?php echo htmlentities($result->id); ?>">
                                        <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage1); ?>"
                                            class="img-responsive" alt="image">
                                    </a>
                                </div>
                                <div class="p-car-content">
                                    <h4>
                                        <a href="car_details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->Name); ?></a>
                                        <span class="price">€<?php echo htmlentities($result->PricePerDay); ?> /Tag</span>
                                    </h4>
                                    <h5><?php echo htmlentities($result->CarTitle); ?></h5>
                                    <p><?php echo substr($result->CarOverview, 0, 70); ?></p>
                                </div>
                                <div class="p-car-feature">
                                    <a href="#"><?php echo htmlentities($result->ModelYear); ?></a>
                                    <a href="#"><?php echo htmlentities($result->FuelType); ?></a>
                                    <a href="#"><?php echo htmlentities($result->SeatingCapacity); ?></a>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- Service Content End -->
    </div>
</section>
<!--== Services Area End ==-->
<!--== Contact us == -->
<section id="contactus-area" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <<div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Kontakt uns</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                    <p>Nutzen Sie das Kontaktformaular um Kontakt mit uns aufzunehmen</p>
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <div  class="row">
            <div class="col-lg-8 m-auto">
                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php }
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?><br>
                <div class="contact_form gray-bg">
                    <form  method="post">
                        <div class="form-group">
                            <label class="control-label">Vollständige Name <span>*</span></label>
                            <input type="text" name="fullname" class="form-control white_bg" id="fullname" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email <span>*</span></label>
                            <input type="email" name="email" class="form-control white_bg" id="emailaddress" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Handy Nummer <span>*</span></label>
                            <input type="text" name="contactno" class="form-control white_bg" id="phonenumber" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nachricht<span>*</span></label>
                            <textarea class="form-control white_bg" name="message" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="send" type="submit">Abschicken<span class="angle_arrow"><i class="fa fa-fw fa-angle-right" aria-hidden="true"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact_detail">
                    <?php
                    $pagetype=$_GET['type'];
                    $sql = "SELECT Address,Email,ContactNb from contactus";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { ?>
                            <ul>
                                <li>
                                    <div class="icon_wrap"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="contact_info_m"><?php   echo htmlentities($result->Address); ?></div>
                                </li>
                                <li>
                                    <div class="icon_wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                    <div class="contact_info_m"><a href="tel:61-1234-567-90"><?php   echo htmlentities($result->Email); ?></a></div>
                                </li>
                                <li>
                                    <div class="icon_wrap"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                    <div class="contact_info_m"><a href="mailto:contact@exampleurl.com"><?php   echo htmlentities($result->ContactNb); ?></a></div>
                                </li>
                            </ul>
                        <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Contact us == -->
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