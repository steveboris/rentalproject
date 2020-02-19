<!--== Header Area Start ==-->
<header id="header-area" class="fixed-top">
    <!--== Header Top Start ==-->
    <div id="header-top" class="d-none d-xl-block">
        <div class="container">
            <div class="row">
                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-left">
                    <i class="fa fa-map-marker"></i> Brandenburg an der Havel
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-center">
                    <i class="fa fa-mobile"></i> 0337 12121
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-center">
                    <i class="fa fa-clock-o"></i> MO - FR 08.00 - 18.00
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Social Icons Start ==-->
                <div class="col-lg-3 text-right">
                    <div class="header-social-icons">
                        <a href="#"><i class="fa fa-whatsapp"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <!--== Social Icons End ==-->
            </div>
        </div>
    </div>
    <!--== Header Top End ==-->

    <!--== Header Bottom Start ==-->
    <div id="header-bottom">
        <div class="container">
            <div class="row">
                <!--== Logo Start ==-->
                <div class="col-lg-4">
                    <h4><a href="#" class="logo">MD Autovermietung</a></h4>
                </div>
                <!--== Logo End ==-->

                <!--== Main Menu Start ==-->
                <div class="col-lg-8 d-none d-xl-block nav">
                    <nav class="mainmenu alignright">
                        <ul>
                            <li><a href="./index.php">Startseite</a></li>
                            <li><a href="./about.php">Über uns</a></li>
                            <li><a href="./car_list.php">Fahrzeuge</a></li>
                            <li><a href="./contactus.php">Kontakt</a></li>
                            <?php   if(strlen($_SESSION['login'])==0) { ?>
                            <li class="login_btn"> <a href="#loginform" data-toggle="modal" data-dismiss="modal">Einloggen</a>
                            <?php } else{ ?>
                            <li class="login_btn"> <a href="#">
                                <?php
                                $email=$_SESSION['login'];
                                $sql ="SELECT FullName FROM users WHERE Email=:email ";
                                $query= $dbh -> prepare($sql);
                                $query-> bindParam(':email', $email, PDO::PARAM_STR);
                                $query-> execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                        echo htmlentities($result->FullName); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul>
                                        <?php if($_SESSION['login']){?>
                                            <li><a href="reset_password.php">Password ändern</a></li>
                                            <li><a href="my_booking.php">Meine Bestellungen</a></li>
                                            <li><a href="includes/logout.php">Ausloggen</a></li>
                                        <?php } else { ?>
                                            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Password ändern</a></li>
                                            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Meine Bestellungen</a></li>
                                            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Ausloggen</a></li>
                                        <?php } ?>
                                    </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <!--== Main Menu End ==-->
            </div>
        </div>
    </div>
    <!--== Header Bottom End ==-->
</header>
<!--== Header Area End ==-->