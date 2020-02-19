<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:dashboard.php');
} else {
    if (isset($_POST['submit'])) {
        $cartitle = $_POST['cartitle'];
        $brand = $_POST['brandname'];
        $location = $_POST['location'];
        $cat = $_POST['cat'];
        $color = $_POST['color'];
        $caroverview = $_POST['caroverview'];
        $priceperday = $_POST['priceperday'];
        $fueltype = $_POST['fueltype'];
        $modelyear = $_POST['modelyear'];
        $seatingcapacity = $_POST['seatingcapacity'];
        $vimage1 = $_FILES["img1"]["name"];
        $vimage2 = $_FILES["img2"]["name"];
        $vimage3 = $_FILES["img3"]["name"];
        $vimage4 = $_FILES["img4"]["name"];
        $vimage5 = $_FILES["img5"]["name"];
        $airconditioner = $_POST['airconditioner'];
        $powerdoorlocks = $_POST['powerdoorlocks'];
        $antilockbrakingsys = $_POST['antilockbrakingsys'];
        $brakeassist = $_POST['brakeassist'];
        $powersteering = $_POST['powersteering'];
        $driverairbag = $_POST['driverairbag'];
        $passengerairbag = $_POST['passengerairbag'];
        $powerwindow = $_POST['powerwindow'];
        $cdplayer = $_POST['cdplayer'];
        $centrallocking = $_POST['centrallocking'];
        $crashcensor = $_POST['crashcensor'];
        move_uploaded_file($_FILES["img1"]["tmp_name"], "../img/carimages/" . $_FILES["img1"]["name"]);
        move_uploaded_file($_FILES["img2"]["tmp_name"], "../img/carimages/" . $_FILES["img2"]["name"]);
        move_uploaded_file($_FILES["img3"]["tmp_name"], "../img/carimages/" . $_FILES["img3"]["name"]);
        move_uploaded_file($_FILES["img4"]["tmp_name"], "../img/carimages/" . $_FILES["img4"]["name"]);
        move_uploaded_file($_FILES["img5"]["tmp_name"], "../img/carimages/" . $_FILES["img5"]["name"]);

        $sql = "INSERT INTO cars(CarTitle,CarBrand,Location,Category,CarColor,CarOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,CarImage1,CarImage2,CarImage3,CarImage4,CarImage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor) VALUES(:cartitle,:brand,:location,:cat,:color,:caroverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cartitle', $cartitle, PDO::PARAM_STR);
        $query->bindParam(':brand', $brand, PDO::PARAM_STR);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':color', $color, PDO::PARAM_STR);
        $query->bindParam(':caroverview', $caroverview, PDO::PARAM_STR);
        $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
        $query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
        $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
        $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
        $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
        $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
        $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
        $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
        $query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
        $query->bindParam(':airconditioner', $airconditioner, PDO::PARAM_STR);
        $query->bindParam(':powerdoorlocks', $powerdoorlocks, PDO::PARAM_STR);
        $query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
        $query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
        $query->bindParam(':powersteering', $powersteering, PDO::PARAM_STR);
        $query->bindParam(':driverairbag', $driverairbag, PDO::PARAM_STR);
        $query->bindParam(':passengerairbag', $passengerairbag, PDO::PARAM_STR);
        $query->bindParam(':powerwindow', $powerwindow, PDO::PARAM_STR);
        $query->bindParam(':cdplayer', $cdplayer, PDO::PARAM_STR);
        $query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
        $query->bindParam(':crashcensor', $crashcensor, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Fahrzeug erfolgreich hinzugeführt";
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
        <title>Autovermietung | Fahrzeug hinzufügen</title>
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
            <div class="container-fluid">
                <div class="row">
                    <h2>Fahrzeug hinufügen</h2>
                    <div class="col-md-12">
                        <?php if ($error) { ?>
                            <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } else if ($msg) { ?>
                            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
                        <?php } ?>
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name(Model)<span style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="cartitle" class="form-control" required>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Marke<span style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <select class="selectpicker" name="brandname" required>
                                        <option value="">Auswählen</option>
                                        <?php $ret="select id, Name from brands";
                                        $query= $dbh -> prepare($ret);
                                        $query-> execute();
                                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                        if($query -> rowCount() > 0)
                                        {
                                            foreach($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Name);?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kategorie<span style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <select class="selectpicker" name="cat" required>
                                        <option value="">Auswählen</option>
                                        <?php $ret="select id, Name from categories";
                                        $query= $dbh -> prepare($ret);
                                        $query-> execute();
                                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                        if($query -> rowCount() > 0)
                                        {
                                            foreach($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Name);?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Farbe<span style="color:red">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="color" rows="3" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fahrzeug Beschreibung<span
                                        style="color:red">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="caroverview" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Preis pro Tag (€)<span
                                        style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="priceperday" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kraftstofftyp auswählen<span
                                        style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <select class="selectpicker" name="fueltype" required>
                                        <option value="">Auswählen</option>
                                        <option value="Benzin">Benzin</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Gas">Gas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Baujahr<span style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="modelyear" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Aktuelle Ort<span style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <select class="selectpicker" name="location" required>
                                        <option value="">Auswählen</option>
                                        <?php $ret="select id, Name from location";
                                        $query= $dbh -> prepare($ret);
                                        $query-> execute();
                                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                        if($query -> rowCount() > 0) {
                                            foreach($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Name);?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sitzplätze<span
                                        style="color:red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="seatingcapacity" class="form-control" required>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <h4 class="p-3"><b>Bilder hochladen</b></h4>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="col-sm-4">
                                                Bild 1 <span style="color:red">*</span><input type="file" name="img1" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-sm-4">
                                                Bild 2 <span style="color:red">*</span><input type="file" name="img2" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-sm-4">
                                                Bild 3 <span style="color:red">*</span><input type="file" name="img3" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="col-sm-4">
                                        Bild 4 <span style="color:red">*</span><input type="file" name="img4" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col-sm-4">
                                        Bild 5<input type="file" name="img5">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group pt-3">
                                <h4>Zubehör</h4>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                                        <label for="airconditioner">klimaanlage</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
                                                        <label for="powerdoorlocks">Elektrische Türschlösser</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
                                                        <label for="powerdoorlocks">ABS</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="brakeassist" name="brakeassist" value="1">
                                                        <label for="powerdoorlocks">Bremsassistent</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="powersteering" name="powersteering" value="1">
                                                        <label for="powerdoorlocks">Servolenkung</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <div class="checkbox checkbox-inline">
                                                            <input type="checkbox" id="driverairbag" name="driverairbag" value="1">
                                                            <label for="powerdoorlocks">Fahrer-Airbag</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
                                                        <label for="inlineCheckbox3">Beifahrer-Airbag </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="powerwindow" name="powerwindow" value="1">
                                                        <label for="inlineCheckbox3">Elektrische Fensterheber</label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                                        <label for="inlineCheckbox1">CD-Spieler</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col">
                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                        <input type="checkbox" id="centrallocking" name="centrallocking" value="1">
                                                        <label for="inlineCheckbox2">Zentralverriegelung</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="crashcensor" name="crashcensor" value="1">
                                                        <label for="inlineCheckbox3">Crash-Sensor</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <a  href="c      ar_management.php" class="btn btn-success active" role="button" aria-pressed="true">Abbrechen</a>
                                    <button class="btn btn-primary" name="submit" type="submit">Speichern</button>
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




