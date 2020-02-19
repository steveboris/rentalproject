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
        $error = "Etwas ist schief gelaufen. Es kann sein, Ihre Email schon vergeben ist";
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

    <title>MD Autovermietung | Kontakt uns</title>

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

<?php include('includes/header.php');?>

<!--== SlideshowBg Area Start ==-->
<section id="page-title-area" class="section-padding overlay">
    <div class="container">
        <div class="row">
            <!-- Page Title Start -->
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Kontakt uns</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                </div>
            </div>
            <!-- Page Title End -->
        </div>
    </div>
</section>
<!--== SlideshowBg Area End ==-->

<section id="contactus-area" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <<div class="col-lg-12">
                <div class="section-title  text-center">
                    <p>Nutzen Sie das Kontaktformaular um Kontakt mit uns aufzunehmen</p>
                    <span class="title-line"><i class="fa fa-car"></i></span>
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
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--== footer ==-->
<?php include('includes/footer.php');?>
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