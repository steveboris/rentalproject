<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if(isset($_REQUEST['del']))
    {
        $delid=intval($_GET['del']);
        $sql = "delete from cars WHERE id=:delid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':delid',$delid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Das Fahrzeug wurde erfolgreich gelöscht";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin panel | Fahrzeuge verwalten</title>
        <link rel="stylesheet" href="../css/datatables.min.css">
        <link rel="stylesheet" href="../css/style.css">
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
                    <h2>Fahrzeuge verwalten</h2>
                    <div class="col-md-12">
                        <?php
                        $error ="";
                        if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        <table id="dataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Marke</th>
                                <th>Kategorie</th>
                                <th>Farbe</th>
                                <th>Preis/Tag</th>
                                <th>Brennstoff-Typ</th>
                                <th>Baujahr</th>
                                <th>Ort</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = "SELECT cars.CarTitle, cars.CarBrand, cars.Location, cars.Category, cars.CarColor, cars.PricePerDay, cars.FuelType, cars.ModelYear, cars.id from cars join brands on brands.id=cars.CarBrand";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result) {	?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->CarTitle);?></td>
                                        <td>
                                            <?php
                                            $bid = intval($result->CarBrand);
                                            $sql2 = "SELECT brands.* from brands where brands.id=:bid";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->bindParam(':bid', $bid, PDO::PARAM_STR);
                                            $query2->execute();
                                            $resultm = $query2->fetchAll(PDO::FETCH_OBJ);
                                            if ($query2->rowCount() > 0) {
                                                foreach ($resultm as $result2) {
                                                    echo ($result2->Name);
                                                }
                                            }
                                            ?>
                                        </td>
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
                                        <td><?php echo htmlentities($result->CarColor);?></td>
                                        <td><?php echo htmlentities($result->PricePerDay);?></td>
                                        <td><?php echo htmlentities($result->FuelType);?></td>
                                        <td><?php echo htmlentities($result->ModelYear);?></td>
                                        <td>
                                            <?php
                                            $lid = intval($result->Location);
                                            $sql4 = "SELECT location.* from location where location.id=:lid";
                                            $query4 = $dbh->prepare($sql4);
                                            $query4->bindParam(':lid', $lid, PDO::PARAM_STR);
                                            $query4->execute();
                                            $results = $query4->fetchAll(PDO::FETCH_OBJ);
                                            if ($query4->rowCount() > 0) {
                                                foreach ($results as $result4) {
                                                    echo ($result4->Name);
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <i class="text-black-50 fa fa-user"></i>
                                            <a href="edit_car.php?id=<?php echo $result->id;?>"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="car_management.php?del=<?php echo $result->id;?>" onclick="return confirm('Möchten Sie wirklich löschen?');"><i class="text-danger fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php $cnt=$cnt+1;
                                }
                            } ?>
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                <th>Name</th>
                                <th>Marke</th>
                                <th>Kategorie</th>
                                <th>Farbe</th>
                                <th>Preis/Tag</th>
                                <th>Brennstoff-Typ</th>
                                <th>Baujahr</th>
                                <th>Ort</th>
                                <th>Aktion</th>
                            </tfoot>
                        </table>
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

