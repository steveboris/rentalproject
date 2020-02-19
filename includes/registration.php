<?php
if (isset($_POST['signup'])) {
    $fname = $_POST['fullname'];
    $email = $_POST['emailid'];
    $mobile = $_POST['mobileno'];
    $password = md5($_POST['password']);
    $dob = $_POST['dob'];
    $adr = $_POST['adr'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $sql = "INSERT INTO users(FullName,Email,Password,ContactNo, Birthday, Address, City, Country) VALUES(:fname,:email,:password,:mobile,:dob,:adr,:city,:country)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':dob', $dob, PDO::PARAM_STR);
    $query->bindParam(':adr', $adr, PDO::PARAM_STR);
    $query->bindParam(':city', $city, PDO::PARAM_STR);
    $query->bindParam(':country', $country, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Erfolgreich registriert. Melden Sie nun an.');</script>";
    } else {
        echo "<script>alert('Etwas ist schief gelaufen. Versuchen Sie nochmal');</script>";
    }
}

?>
<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'emailid=' + $("#emailid").val(),
            type: "POST",
            success: function (data) {
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
</script>
<script type="text/javascript">
    function valid() {
        if (document.signup.password.value != document.signup.confirmpassword.value) {
            alert("Passwörte stimmen uberein nicht!!");
            document.signup.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>
<div class="modal fade" id="signupform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-primary">Sign Up</h3>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <form method="post" name="signup" onSubmit="return valid();">
                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" placeholder="Vollständige Name"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobileno" placeholder="Handy Nummer"
                                       maxlength="10" required="required">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="emailid" id="emailid"
                                       onBlur="checkAvailability()" placeholder="Email" required="required">
                                <span id="user-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="dob" placeholder="Abholdatum" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="adr" placeholder="Adresse*"
                                       maxlength="60" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="Stadt*"
                                       maxlength="50" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="country" placeholder="Land*"
                                       maxlength="50" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirmpassword"
                                       placeholder="Password bestädigen" required="required">
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="terms_agree" required="required" checked="">
                                <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Sign Up" name="signup" id="submit"
                                       class="btn btn-block btn-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <p>Haben Sie bereits ein Konto? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Sich Anmelden</a></p>
            </div>
        </div>
    </div>
</div>