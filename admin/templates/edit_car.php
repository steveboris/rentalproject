<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_POST['submit'])) {
        $cartitle = $_POST['cartitle'];
        $brand = $_POST['brandname'];
        $cat = $_POST['cat'];
        $location = $_POST['location'];
        $color = $_POST['color'];
        $caroverview = $_POST['caroverview'];
        $priceperday = $_POST['priceperday'];
        $fueltype = $_POST['fueltype'];
        $modelyear = $_POST['modelyear'];
        $seatingcapacity = $_POST['seatingcapacity'];
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
        $leatherseats = $_POST['leatherseats'];
        $id = intval($_GET['id']);

        $sql = "update cars set CarTitle=:cartitle,CarBrand=:brand,Location=:location, Category=:cat, CarColor=:color, CarOverview=:caroverview,PricePerDay=:priceperday,FuelType=:fueltype,ModelYear=:modelyear,SeatingCapacity=:seatingcapacity,AirConditioner=:airconditioner,PowerDoorLocks=:powerdoorlocks,AntiLockBrakingSystem=:antilockbrakingsys,BrakeAssist=:brakeassist,PowerSteering=:powersteering,DriverAirbag=:driverairbag,PassengerAirbag=:passengerairbag,PowerWindows=:powerwindow,CDPlayer=:cdplayer,CentralLocking=:centrallocking,CrashSensor=:crashcensor where id=:id ";
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
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = "Fahrzeug erfolgreich geändert";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autovermietung | Fahrzeug bearbeiten</title>
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
                <h2>Fahrzeug bearbeiten</h2>
                <div class="col-md-12">
                    <?php if ($msg) { ?>
                        <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                        </div><?php } ?>
                    <?php
                    $id = intval($_GET['id']);
                    $sql = "SELECT cars.*,brands.Name,brands.id as bid from cars join brands on brands.id=cars.CarBrand where cars.id=:id";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0){
                    foreach ($results as $result) { ?>

                    <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="cartitle" class="form-control"
                                       value="<?php echo htmlentities($result->CarTitle) ?>" required>
                            </div>
                        </div>
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Marke<span style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="brandname" required>
                                    <option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($bdname = $result->Name); ?> </option>
                                    <?php $ret = "select id, Name from brands";
                                    $query = $dbh->prepare($ret);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            if ($results->Name == $bdname) {
                                                continue;
                                            } else { ?>
                                                <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->Name); ?></option>
                                            <?php }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kategorie<span style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="cat" required>
                                    <option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($cname = $result->Category); ?> </option>
                                    <?php $ret = "select id, Name from categories";
                                    $query = $dbh->prepare($ret);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            if ($results->Name == $cname) {
                                                continue;
                                            } else { ?>
                                                <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->Name); ?></option>
                                            <?php }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Farbe<span style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="color" class="form-control"
                                       value="<?php echo htmlentities($result->CarColor) ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fahrzeug Beschreibung<span
                                        style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="caroverview" rows="3"
                                          required><?php echo htmlentities($result->CarOverview); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Preis pro Tag (€)<span
                                        style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="priceperday" class="form-control"
                                       value="<?php echo htmlentities($result->PricePerDay); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kraftstofftyp auswählen<span
                                        style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="fueltype" required>
                                    <option value="<?php echo htmlentities($results->FuelType); ?>"> <?php echo htmlentities($result->FuelType); ?> </option>
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
                                <input type="text" name="modelyear" class="form-control"
                                       value="<?php echo htmlentities($result->ModelYear); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ort<span style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="location" required>
                                    <option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($lname = $result->Location); ?> </option>
                                    <?php $ret = "select id, Name from location";
                                    $query = $dbh->prepare($ret);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            if ($results->Name == $lname) {
                                                continue;
                                            } else { ?>
                                                <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->Name); ?></option>
                                            <?php }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sitzplätze<span
                                        style="color:red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="seatingcapacity" class="form-control"
                                       value="<?php echo htmlentities($result->SeatingCapacity); ?>" required>
                            </div>
                        </div>
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <h4><b>Fahrzeug Bildern</b></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <p>Bild 1 <img src="../img/carimages/<?php echo htmlentities($result->CarImage1); ?>"
                                                           width="300" height="200" style="border:solid 1px #000"></p>
                                            <p><a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Bild ändern</a></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <p>Bild 2<img src="../img/carimages/<?php echo htmlentities($result->CarImage2); ?>"
                                                          width="300" height="200" style="border:solid 1px #000"></p>
                                            <a href="changeimage2.php?imgid=<?php echo htmlentities($result->id) ?>">Bild ändern</a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <p>Bild 3<img src="../img/carimages/<?php echo htmlentities($result->CarImage3); ?>"
                                                          width="300" height="200" style="border:solid 1px #000"></p>
                                            <a href="changeimage3.php?imgid=<?php echo htmlentities($result->id) ?>">Bild ändern</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <p>Bild 4<img src="../img/carimages/<?php echo htmlentities($result->CarImage4); ?>"
                                                          width="300" height="200" style="border:solid 1px #000"></p>
                                            <a href="changeimage4.php?imgid=<?php echo htmlentities($result->id) ?>">Bild ändern</a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <p>Bild 5
                                                <img src="../img/carimages/<?php echo htmlentities($result->CarImage5); ?>"
                                                     width="300" height="200" style="border:solid 1px #000"></p>
                                            <a href="changeimage5.php?imgid=<?php echo htmlentities($result->id) ?>">Bild ändern</a>
                                        </div>
                                    </div>
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
                                                <?php if ($result->AirConditioner == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="airconditioner" checked
                                                               value="1">
                                                        <label for="inlineCheckbox1"> Klimaanlage </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="airconditioner" value="1">
                                                        <label for="inlineCheckbox1"> Klimaanlage </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col">
                                                <?php if ($result->PowerDoorLocks == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powerdoorlocks" checked
                                                               value="1">
                                                        <label for="inlineCheckbox2"> Elektrische Türschlösser </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powerdoorlocks" value="1">
                                                        <label for="inlineCheckbox2"> Elektrische Türschlösser </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col">
                                                <?php if ($result->AntiLockBrakingSystem == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="antilockbrakingsys" checked
                                                               value="1">
                                                        <label for="inlineCheckbox3"> ABS </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="antilockbrakingsys" value="1">
                                                        <label for="inlineCheckbox3"> ABS </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <?php if ($result->BrakeAssist == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="brakeassist" checked
                                                               value="1">
                                                        <label for="inlineCheckbox3"> Bremsassistent </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="brakeassist" value="1">
                                                        <label for="inlineCheckbox3"> Bremsassistent </label>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="col">
                                                <?php if ($result->PowerSteering == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powersteering" checked
                                                               value="1">
                                                        <label for="inlineCheckbox1">Servolenkung</label>
                                                    </div>
                                                <?php } else { ?>
                                                <div class="col">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powersteering" value="1">
                                                        <label for="inlineCheckbox1"> Servolenkung </label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col">
                                                    <?php if ($result->DriverAirbag == 1) { ?>
                                                        <div class="checkbox checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1"
                                                                   name="driverairbag" checked
                                                                   value="1">
                                                            <label for="inlineCheckbox2">Fahrer-Airbag</label>
                                                        </div>
                                                    <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="driverairbag" value="1">
                                                        <label for="inlineCheckbox2">Fahrer-Airbag</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <?php if ($result->DriverAirbag == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="passengerairbag"
                                                               checked value="1">
                                                        <label for="inlineCheckbox3"> Beifahrer-Airbag</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="passengerairbag"
                                                               value="1">
                                                        <label for="inlineCheckbox3">Beifahrer-Airbag </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col">
                                                <?php if ($result->PowerWindows == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powerwindow"
                                                               checked value="1">
                                                        <label for="inlineCheckbox3">Elektrische Fensterheber</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="powerwindow"
                                                               value="1">
                                                        <label for="inlineCheckbox3">Elektrische Fensterheber</label>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="col">
                                                <?php if ($result->CDPlayer == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="cdplayer"
                                                               checked value="1">
                                                        <label for="inlineCheckbox1">CD-Spieler</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="cdplayer"
                                                               value="1">
                                                        <label for="inlineCheckbox1">CD-Spieler</label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <?php if ($result->CentralLocking == 1) { ?>
                                                    <div class="checkbox  checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="centrallocking" checked
                                                               value="1">
                                                        <label for="inlineCheckbox2">Zentralverriegelung</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="centrallocking" value="1">
                                                        <label for="inlineCheckbox2">Zentralverriegelung</label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col">
                                                <?php if ($result->CrashSensor == 1) { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="crashcensor"
                                                               checked value="1">
                                                        <label for="inlineCheckbox3">Crash-Sensor</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1"
                                                               name="crashcensor"
                                                               value="1">
                                                        <label for="inlineCheckbox3">Crash-Sensor</label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        } ?>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button class="btn btn-primary" name="submit" type="submit">Speichern</button>
                            </div>
                        </div>
                    </form>
                    <div class="hr-dashed"></div>
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
