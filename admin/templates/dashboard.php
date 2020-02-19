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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../css/bootadmin.min.css">
        <title>Autovermietung | Dashboard</title>
    </head>

    <body style="background: #fff">
        <?php include('../includes/header.php'); ?>
        <div class="d-flex justify-content-center align-items-center"> <?php include('../includes/leftsidebar.php'); ?>
            <div class="container-fluid content-wrapper mt-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="row mb-4">
                                <!-- Number of booking  -->
                                <div class="col bg-danger text-center text-white p-4">
                                    <?php
                                    $sql ="SELECT id from booking ";
                                    $query= $dbh -> prepare($sql);
                                    $query ->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $bookings=$query->rowCount();
                                    ?>
                                    <div class="h1"><?php echo htmlentities($bookings);?></div>
                                    <div class="text-uppercase">
                                        <p>Bestellungen</p>
                                    </div>
                                    <a href="bookings_management.php" class="text-white"><i class="fa fa-fw fa-eye-dropper"></i>Mehr</a>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <!-- Number of registered users -->
                                <div class="col mr-5 bg-info text-center text-white p-4">
                                    <?php
                                    $sql1 ="SELECT id from users ";
                                    $query1 = $dbh -> prepare($sql1);
                                    $query1->execute();
                                    $results=$query1->fetchAll(PDO::FETCH_OBJ);
                                    $reg_users=$query1->rowCount();
                                    ?>
                                    <div class="h1 "><?php echo htmlentities($reg_users);?></div>
                                    <div class="text-uppercase">
                                        <p>Benutzer</p>
                                    </div>
                                    <a href="user_list.php" class="text-white"><i class="fa fa-fw fa-eye-dropper"></i>Mehr</a>
                                </div>
                                <!-- Number of registered cars -->
                                <div class="col mr-5 bg-primary text-center text-white p-4">
                                    <?php
                                    $sql2 ="SELECT id from cars ";
                                    $query2 = $dbh -> prepare($sql2);;
                                    $query2->execute();
                                    $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                                    $total_cars=$query2->rowCount();
                                    ?>
                                    <div class="h1 "><?php echo htmlentities($total_cars); ?></div>
                                    <div class="text-uppercase">
                                        <p>Autos</p>
                                    </div>
                                    <a href="car_management.php" class="text-white"><i class="fa fa-fw fa-eye-dropper"></i>Mehr</a>
                                </div>
                                <!-- Number of registered brands -->
                                <div class="col mr-5 bg-info text-center text-white p-4">
                                    <?php
                                    $sql3 ="SELECT id from brands ";
                                    $query3= $dbh -> prepare($sql3);
                                    $query3->execute();
                                    $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                    $brands=$query3->rowCount();
                                    ?>
                                    <div class="h1 "><?php echo htmlentities($brands);?></div>
                                    <div class="text-uppercase">
                                        <p>Autos Marken</p>
                                    </div>
                                    <a href="brands_management.php" class="text-white"><i class="fa fa-fw fa-eye-dropper"></i>Mehr</a>
                                </div>
                                <!-- Number of contact us queries -->
                                <div class="col mr-5 bg-primary text-center text-white p-4">
                                    <?php
                                    $sql4 ="SELECT id from contactus ";
                                    $query4= $dbh -> prepare($sql4);
                                    $query4->execute();
                                    $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                                    $contacts=$query4->rowCount();
                                    ?>
                                    <div class="h1"><?php echo htmlentities($contacts);?></div>
                                    <div class="text-uppercase">
                                        <p>Kontaktanfragen</p>
                                    </div>
                                    <a href="contactusquery.php" class="text-white"><i class="fa fa-fw fa-eye-dropper"></i>Mehr</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading scripts -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bootadmin.min.js"></script>
    </body>
</html>
<?php } ?>
