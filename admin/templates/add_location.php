<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else{
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $country = $_POST['country'];

        $sql = "INSERT INTO location(Name,Country) VALUES(:title,:country)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Ort erfolgreich hinzugeführt";
        } else {
            $error = "Etwas ist schief gelaufen. Bitte versuchen Sie noch einmal";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autovermietung | Kategorie hinzufügen</title>
    <link rel="stylesheet" href="../css/datatables.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/bootadmin.min.css">
    <!-- javascript -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body style="background: #fff">
<?php include('../includes/header.php'); ?>
<div class="d-flex"> <?php include('../includes/leftsidebar.php'); ?>
    <div class="content content-wrapper mt-4">
        <div class="container">
            <div class="row">
                <h2>Ort hinzufügen</h2>
                <div class="col-md-12">
                    <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Land</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="country" id="country" required>
                            </div>
                        </div>
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button class="btn btn-primary" name="submit" type="submit">Senden</button>
                            </div>
                        </div>
                    </form>
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

