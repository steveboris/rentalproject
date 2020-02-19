<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $message=$_POST['message'];
    $useremail=$_SESSION['login'];
    $status=0;
    $vhid=$_GET['vhid'];
    $sql="INSERT INTO  booking(UserEmail,CarID,FromDate,ToDate,Message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
    $query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
    $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
    $query->bindParam(':todate',$todate,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId) {
        echo "<script>alert('Ihre Bestellung wurde erfolgreich aufgenommen!');</script>";
    } else {
        echo "<script>alert('Etwas ist schief gelaufen. Bitte versuchen Sie noch einmal.');</script>";
    }

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
                    <h2>Fahrzeug Beschreibung</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                    <p>Billiger, als man es sonst nirgendwo findet</p>
                </div>
            </div>
            <!-- Page Title End -->
        </div>
    </div>
</section>
<!--== SlideshowBg Area End ==-->

<!--== Car List Area Start ==-->
<section id="car-list-area" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Car List Content Start -->
            <div class="col-lg-8">
                <div class="car-details-content">
                    <?php
                    $vhid=intval($_GET['vhid']);
                    $sql = "SELECT cars.*,brands.Name, brands.id as bid  from cars join brands on brands.id=cars.CarBrand where cars.id=:vhid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0) {
                        foreach($results as $result) {
                        $_SESSION['brndid']=$result->bid;
                    ?>
                    <h2><?php echo htmlentities($result->Name);?> , <?php echo htmlentities($result->CarTitle);?> <span class="price">Preis: <b>€<?php echo htmlentities($result->PricePerDay);?>/Tag</b></span></h2>
                    <div class="car-preview-crousel">
                        <div class="single-car-preview">
                            <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage1);?>" class="img-responsive" alt="image" width="900" height="560">
                        </div>
                        <div class="single-car-preview">
                            <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage2);?>" class="img-responsive" alt="image" width="900" height="560">
                        </div>
                        <div class="single-car-preview">
                            <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage3);?>" class="img-responsive" alt="image" width="900" height="560">
                        </div>
                        <div class="single-car-preview">
                            <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage4);?>" class="img-responsive" alt="image" width="900" height="560">
                        </div>
                        <?php if($result->CarImage5=="") {
                        } else { ?>
                            <div class="single-car-preview">
                                <img src="admin/img/carimages/<?php echo htmlentities($result->CarImage5);?>" class="img-responsive" alt="image" width="900" height="560">
                            </div>
                        }
                        <?php } ?>
                    </div>
                    <div class="car-details-info">
                        <h4>Beschreibung</h4>
                        <p><?php echo htmlentities($result->CarOverview);?></p>
                        <div class="technical-info">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="tech-info-table">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Klasse</th>
                                                <td>
                                                    <?php
                                                    $cid = intval($result->Category);
                                                    $sql3 = "SELECT categories.* from categories where categories.id=:cid";
                                                    $query3 = $dbh->prepare($sql3);
                                                    $query3->bindParam(':cid', $cid, PDO::PARAM_STR);
                                                    $query3->execute();
                                                    $resultc = $query3->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query3->rowCount() > 0) {
                                                        foreach ($resultc as $result3) {
                                                            echo ($result3->Name);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Kraftstoff</th>
                                                <td>
                                                    <?php echo htmlentities($result->FuelType);?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Türs</th>
                                                <td><?php echo htmlentities($result->SeatingCapacity);?></td>
                                            </tr>
                                            <tr>
                                                <th>Getriebe</th>
                                                <td><?php echo htmlentities($result->GearBox);?></td>
                                            </tr>
                                            <tr>
                                                <th>Baujahr</th>
                                                <td><?php echo htmlentities($result->ModelYear);?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="tech-info-list">
                                        <ul>
                                            <?php if($result->AirConditioner == 1) { ?>
                                                <li>Klimaanlage</li>
                                            <?php } ?>
                                            <?php if($result->PowerDoorLocks == 1) { ?>
                                                <li>Elektrische Türschlösser</li>
                                            <?php } ?>
                                            <?php if($result->AntiLockBrakingSystem == 1) { ?>
                                                <li>ABS</li>
                                            <?php } ?>
                                            <?php if($result->BrakeAssist == 1) { ?>
                                                <li>Bremsassistent</li>
                                            <?php } ?>
                                            <?php if($result->PowerSteering == 1) { ?>
                                                <li>Servolenkung</li>
                                            <?php } ?>
                                            <?php if($result->DriverAirbag == 1) { ?>
                                                <li>Fahrer-Airbag</li>
                                            <?php } ?>
                                            <?php if($result->PassengerAirbag == 1) { ?>
                                                <li>Beifahrer-Airbag </li>
                                            <?php } ?>
                                            <?php if($result->PowerWindows == 1) { ?>
                                                <li>Elektrische Fensterheber</li>
                                            <?php } ?>
                                            <?php if($result->CDPlayer == 1) { ?>
                                                <li>CD-Spieler</li>
                                            <?php } ?>
                                            <?php if($result->CentralLocking == 1) { ?>
                                                <li>Zentralverriegelung</li>
                                            <?php } ?>
                                            <?php if($result->CrashSensor == 1) { ?>
                                                <li>Crash-Sensor</li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h3 class="m-5">Ähnliche Fahrzeuge</h3>
                                    <?php
                                    $bid=$_SESSION['brndid'];
                                    $sql="SELECT cars.*, cars.CarTitle,brands.Name,cars.PricePerDay,cars.FuelType,cars.ModelYear,cars.id,cars.SeatingCapacity,cars.CarOverview,cars.CarImage1 from cars join brands on brands.id=cars.CarBrand where cars.CarBrand=:bid";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindParam(':bid',$bid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0) {
                                        foreach($results as $result) { ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="car-list-content">
                                                        <!-- Single Car Start -->
                                                        <div class="single-car-wrap">
                                                            <div class="row">
                                                                <!-- Single Car Thumbnail -->
                                                                <div class="col-lg-5">
                                                                    <div><a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/carimages/<?php echo htmlentities($result->CarImage1);?>" class="img-responsive" alt="image" /> </a></div>
                                                                </div>
                                                                <!-- Single Car Thumbnail -->

                                                                <!-- Single Car Info -->
                                                                <div class="col-lg-7">
                                                                    <div class="display-table">
                                                                        <div class="display-table-cell">
                                                                            <div class="car-list-info">
                                                                                <h4><a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Name);?> , <?php echo htmlentities($result->CarTitle);?></a></h4>
                                                                                <p class="list-price">€<?php echo htmlentities($result->PricePerDay);?>/Tag</p>
                                                                                <p><?php echo htmlentities($result->CarOverview);?></p>
                                                                                <ul class="car-info-list">
                                                                                    <?php if($result->AirConditioner == 1) { ?>
                                                                                        <li>Klimaanlage</li>
                                                                                    <?php } else if ($result->AntiLockBrakingSystem == 1) { ?>
                                                                                        <li>ABS</li>
                                                                                    <?php } ?>
                                                                                    <li><?php echo htmlentities($result->FuelType);?></li>
                                                                                    <li><?php echo htmlentities($result->ModelYear);?></li>
                                                                                </ul>
                                                                                <p class="rating">
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star unmark"></i>
                                                                                </p>
                                                                                <form method="post">
                                                                                    <?php if($_SESSION['login']) { ?>
                                                                                        <div class="form-group">
                                                                                            <input type="submit" class="btn btn-info"  name="submit" value="Abbuchen">
                                                                                        </div>
                                                                                    <?php } else { ?>
                                                                                        <a href="#loginform" class="btn btn-xs btn-info" data-toggle="modal" data-dismiss="modal">Abbuchen</a>
                                                                                    <?php } ?>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Single Car info -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                } ?>
                </div>
            </div>
            <!-- Car List Content End -->
            <!-- Sidebar Area Start -->
            <div class="col-lg-4">
                <div class="sidebar-content-wrap m-t-50">
                    <!-- Single Sidebar Start -->
                    <div class="single-sidebar">
                        <h3>Für weitere Informationen</h3>
                        <div class="sidebar-body">
                            <p><i class="fa fa-mobile"></i> +49 1816 277 243</p>
                            <p><i class="fa fa-clock-o"></i> MO - SA 8.00 - 18.00</p>
                        </div>
                    </div>
                    <!-- Single Sidebar End -->
                    <!-- Single Sidebar Start -->
                    <div class="single-sidebar">
                        <h3>Min uns in Verbindung</h3>
                        <div class="sidebar-body">
                            <div class="social-icons text-center">
                                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-behance"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-dribbble"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Sidebar End -->
                    <div class="review-area">
                        <h3 class="mb-5">Jetzt Abbuchen</h3>
                        <div class="review-form">
                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name-input">
                                            <input type="text" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="email-input">
                                            <input type="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-4">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="date-input">
                                            <input type="date" placeholder="Abholdatum" name="fromdate">Abholdatum
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="date-input">
                                            <input type="date" placeholder="Rückfgabedatum" name="todate">Rückfgabedatum
                                        </div>
                                    </div>
                                </div>

                                <div class="message-input">
                                    <textarea name="message" cols="30" rows="5" placeholder="Nachricht!"></textarea>
                                </div>
                                <?php if($_SESSION['login']) { ?>
                                    <div class="form-group">
                                        <label class="btn btn-info">
                                            <input type="submit"  name="submit" value="Abbuchen">
                                        </label>
                                    </div>
                                <?php } else { ?>
                                    <a href="#loginform" class="btn btn-xs btn-info" data-toggle="modal" data-dismiss="modal">Abbuchen</a>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Area End -->
        </div>
    </div>
</section>

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