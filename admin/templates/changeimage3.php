<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {

    if(isset($_POST['update']))
    {
        $vimage=$_FILES["img3"]["name"];
        $id=intval($_GET['imgid']);
        move_uploaded_file($_FILES["img3"]["tmp_name"],"../img/carimages/".$_FILES["img3"]["name"]);
        $sql="update cars set CarImage3=:vimage where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vimage',$vimage,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->execute();
        $msg="Bild erfolgreich geändert";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Autovermietung | Bild Änderung</title>
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
                    <h2>Bild Änderung</h2>
                    <div class="col-md-12">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <?php $error ="";
                            if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php }
                            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Aktuelles Bild</label>
                                <?php
                                $id=intval($_GET['imgid']);
                                $sql ="SELECT CarImage3 from cars where cars.id=:id";
                                $query = $dbh -> prepare($sql);
                                $query-> bindParam(':id', $id, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result) {	?>
                                        <div class="col-sm-8">
                                            <img src="../img/carimages/<?php echo htmlentities($result->CarImage3);?>" width="300" height="200" style="border:solid 1px #000">
                                        </div>
                                    <?php }}?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Bild Hochladen<span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="file" name="img3" required>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button class="btn btn-primary" name="update" type="submit">Update</button>
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





