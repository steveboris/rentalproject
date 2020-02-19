<?php
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Email FROM users WHERE Email=:email and ContactNo=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update users set Password=:newpassword where Email=:email and ContactNo=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>alert('Password erfolgreich geändert');</script>";
    } else {
        echo "<script>alert('Email oder Number stimmt nicht');</script>";
    }
}

?>
<script type="text/javascript">
    function valid() {
        if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("Neues Passwort and Bestätigungspasswort stimmen uberein nicht !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>
<div class="modal fade" id="forgotpassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">Passwort Wiederherstellung</h4>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="forgotpassword_wrap">
                        <div class="col-md-12">
                            <form name="chngpwd" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"
                                           placeholder="Deine Email*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile" class="form-control"
                                           placeholder="Handy Nummer*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword" class="form-control"
                                           placeholder="Neues Passwort*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirmpassword" class="form-control"
                                           placeholder="Password bestätigen*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Widerherstellen" name="update" class="btn btn-block btn-success">
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="gray_text">
                                    Aus Sicherheitsgründen speichern wir Ihr Passwort nicht. Ihr Passwort wird
                                    zurückgesetzt und ein neues Passwort wird Ihnen zugeschickt.
                                </p>
                                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i
                                                class="fa fa-angle-double-left" aria-hidden="true"></i> Sich Anmelden </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>