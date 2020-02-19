<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {
    if(isset($_REQUEST['eid']))
    {
        $eid=intval($_GET['eid']);
        $status="2";
        $sql = "UPDATE booking SET Status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Bestelung wurde erfolgreich abgebrochen";
    }

    if(isset($_REQUEST['aeid']))
    {
        $aeid=intval($_GET['aeid']);
        $status=1;
        $sql = "UPDATE booking SET Status=:status WHERE id=:aeid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Bestellung erfolgreich gebucht";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autovermietung | Bestellungen verwalten</title>
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
                <h2 class="mb-5">Bestellungen verwalten</h2>
                <div class="col-md-12">
                    <?php $error ="";
                    if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php }
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                        <?php
                    } ?>
                    <table id="dataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Fahrzeug</th>
                            <th>Von</th>
                            <th>Bis</th>
                            <th>Nachricht</th>
                            <th>Status</th>
                            <th>Buchungsdatum</th>
                            <th>Aktion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT users.FullName,brands.Name,cars.CarTitle,booking.FromDate,booking.ToDate,booking.Message,booking.CarID as vid,booking.Status,booking.PostingDate,booking.id from booking join cars on cars.id=booking.CarID join users on users.Email=booking.UserEmail join brands on cars.CarBrand=brands.id  ";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result) { ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->FullName);?></td>
                                    <td><a href="edit_car.php?id=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->Name);?> , <?php echo htmlentities($result->CarTitle);?></td>
                                    <td><?php echo htmlentities($result->FromDate);?></td>
                                    <td><?php echo htmlentities($result->ToDate);?></td>
                                    <td><?php echo htmlentities($result->Message);?></td>
                                    <td><?php
                                        if($result->Status==0)
                                        {
                                            echo htmlentities('Noch nicht bestätigt');
                                        } else if ($result->Status==1) {
                                            echo htmlentities('Bestätigt');
                                        }
                                        else{
                                            echo htmlentities('storniert');
                                        }
                                        ?></td>
                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                    <td>
                                        <i class="text-black-50 fa fa-user"></i>
                                        <a href="bookings_management.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Möchten Sie diese Buchung wirklich bestätigen?')"><i class="fa fa-pencil-alt"></i>Bestätigt</a> /
                                        <a href="bookings_management.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Wollen Sie diese Buchung wirklich stornieren')"><i class="text-danger fa fa-times"></i>Stoniert</a>
                                    </td>

                                </tr>
                                <?php $cnt=$cnt+1; }} ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Fahrzeug</th>
                            <th>Von</th>
                            <th>Bis</th>
                            <th>Nachricht</th>
                            <th>Status</th>
                            <th>Buchungsdatum</th>
                            <th>Aktion</th>
                        </tr>
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



