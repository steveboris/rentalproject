<?php
session_start();
error_reporting(0);
include('../admin/includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "delete from brands WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $msg="Änderungen erfolgreich gespeichert";
    }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Autovermietung | Marken verwalten</title>
        <link rel="stylesheet" href="css/datatables.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../admin/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../admin/css/bootadmin.min.css">
        <!-- javascript -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#dtBasicExample').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    </head>
    <body>
        <?php include('../admin/includes/header.php'); ?>
        <div class="d-flex"> <?php include('../admin/includes/leftsidebar.php'); ?>
            <div class="content container-fluid bg-light m-3">
                <div class="content-wrapper p-5">
                    <div class="container-fluid">
                        <div class="row">
                            <h2>Marken verwalten</h2>
                            <div class="col-md-12">
                                <div class="mt-4">
                                    <?php $error ="";
                                    if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="th-sm">#</th>
                                                <th class="th-sm">Name</th>
                                                <th class="th-sm">Erstellungsdatum</th>
                                                <th class="th-sm">Aktualisierungsdatum</th>
                                                <th class="th-sm">Aktion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * from brands ";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($result->Name);?></td>
                                                        <td><?php echo htmlentities($result->CreationDate);?></td>
                                                        <td><?php echo htmlentities($result->LastUpdate);?></td>
                                                        <td>
                                                            <i class="text-black-50 fa fa-user"></i>
                                                            <a href="edit-brand.php?id=<?php echo $result->id;?>"><i class="fa fa-pencil-alt"></i></a>
                                                            <a href="manage-brands.php?del=<?php echo $result->id;?>" onclick="return confirm('Möchten Sie wirklich löschen?');"><i class="text-danger fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php $cnt = $cnt + 1;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading scripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/fileinput.js"></script>
        <script src="js/chartData.js"></script>
        <script src="js/main.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/bootadmin.min.js"></script>
    </body>
</html>
<?php } ?>
