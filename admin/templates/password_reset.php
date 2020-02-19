<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT Password FROM admin WHERE Username=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update admin set Password=:newpassword where Username=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Das Passwort wurde erfolgreich geändert";
        } else {
            $error = "Das aktuelle Passwort ist nicht korrekt";
        }
    } ?>

    <!DOCTYPE html>
    <html lang="en" class="no-js">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Autovermietung | Startseite</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../css/bootadmin.min.css">

            <script type="text/javascript">
                function valid() {
                    if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                        alert("Passwörte stimmen nicht überein !!");
                        document.chngpwd.confirmpassword.focus();
                        return false;
                    }
                    return true;
                }
            </script>
        </head>
        <body>
            <?php include('../includes/header.php'); ?>
            <div class="d-flex"> <?php include('../includes/leftsidebar.php'); ?>
                <div class="content container-fluid bg-light m-3">
                    <div class="content-wrapper p-5">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Passwort Änderungen</h2>
                                    <div class="col-md-8">
                                        <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                                            <?php if ($error) { ?>
                                                <div class="errorWrap">
                                                    <strong>ERROR</strong>: <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } else if ($msg) { ?>
                                                <div class="succWrap">
                                                    <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Aktuelles Passwort</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Neues Passwort</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="newpassword"
                                                           id="newpassword" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Passwort bestätigen</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="confirmpassword"
                                                           id="confirmpassword" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button class="btn btn-primary" name="submit" type="submit">Speichern
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Loading Scripts -->
            <script src="../js/jquery.min.js"></script>
            <script src="../js/datatables.min.js"></script>
            <script src="../js/jquery.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/bootadmin.min.js"></script>
        </body>
    </html>
<?php } ?>