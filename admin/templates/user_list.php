<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "delete from brands  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $msg="Page data updated  successfully";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autovermietung | Benutzer</title>
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
                <h2>Benutzerliste</h2>
                <div class="col-md-12">
                    <?php $error ="";
                    if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php }
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
                    <table id="dataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Kontakt Nb</th>
                            <th>Geburtstdatum</th>
                            <th>Adresse</th>
                            <th>Stadt</th>
                            <th>Land</th>
                            <th>Anmeldaungsdatum</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sql = "SELECT * from users ";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->FullName);?></td>
                                    <td><?php echo htmlentities($result->Email);?></td>
                                    <td><?php echo htmlentities($result->ContactNo);?></td>
                                    <td><?php echo htmlentities($result->Birthday);?></td>
                                    <td><?php echo htmlentities($result->Address);?></td>
                                    <td><?php echo htmlentities($result->City);?></td>
                                    <td><?php echo htmlentities($result->Country);?></td>
                                    <td><?php echo htmlentities($result->RegDate);?></td>
                                </tr>
                                <?php $cnt=$cnt+1;
                            }
                        } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Kontakt Nb</th>
                            <th>Geburtstdatum</th>
                            <th>Adresse</th>
                            <th>Stadt</th>
                            <th>Land</th>
                            <th>Anmeldaungsdatum</th>
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



