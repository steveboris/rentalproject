<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else{
// Code for change password
if(isset($_POST['submit'])) {
    $brand=$_POST['brand'];
    $id=$_GET['id'];
    $sql="update brands set Name=:brand where id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':brand',$brand,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    $msg="Änderung erfolgreich gespeichert";
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Autovermietung | Marke bearbeiten</title>
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
                    <h2>Marke bearbeiten</h2>
                    <div class="col-md-12">
                        <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                            <?php $error ="";
                            if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                            <?php
                            $id=$_GET['id'];
                            $ret="select * from brands where id=:id";
                            $query= $dbh -> prepare($ret);
                            $query->bindParam(':id',$id, PDO::PARAM_STR);
                            $query-> execute();
                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query -> rowCount() > 0) {
                                foreach($results as $result) {?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlentities($result->Name);?>" name="brand" id="brand" required>
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                <?php }
                            } ?>
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
