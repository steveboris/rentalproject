<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {
    if(isset($_REQUEST['eid'])) {
        $eid=intval($_GET['eid']);
        $status=1;
        $sql = "UPDATE contactus SET status=:status WHERE  id=:eid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Erfolgreich abgearbeitet";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autovermietung | Kontakt verwalten</title>
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
                <h2>Kontaktanfrange</h2>
                <div class="col-md-12">
                    <?php $error ="";
                    if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php }
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
                    <table id="dataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nummer</th>
                                <th>Message</th>
                                <th>Buchungsdatum</th>
                                <th>Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $sql = "SELECT * from contactus";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0) {
                            foreach($results as $result) {	?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->Name);?></td>
                                    <td><?php echo htmlentities($result->Email);?></td>
                                    <td><?php echo htmlentities($result->ContactNb);?></td>
                                    <td><?php echo htmlentities($result->Message);?></td>
                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                    <?php if($result->status==1) { ?>
                                        <td>
                                            <a href="contactusquery.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Wollen Sie es wirklich lesen?')" >Lesen</a>
                                        </td>
                                    <?php } else {?>
                                        <td>
                                            <a href="contactusquery.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Wollen Sie es wirklich lesen?')" >Lesen</a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php $cnt=$cnt+1;
                            }
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nummer</th>
                                <th>Message</th>
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




