<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT Email,Password,FullName FROM users WHERE Email=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['fname'] = $results->FullName;
        $currentpage = $_SERVER['REQUEST_URI'];
        echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
    } else {
        echo "<script>alert('Benutzername und/oder Password stimmt nicht');</script>";
    }
}
?>
<div class="modal fade" id="loginform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">Anmelden</h4>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email*">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password*">
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="remember">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Login" class="btn btn-block btn-danger">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center line-wrap pb-4">
                <p>Sie haben kein Konto? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Konto herstellen</a></p>
                <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Password Vergessern?</a></p>
            </div>
        </div>
    </div>
</div>