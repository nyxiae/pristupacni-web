<?php
include("../elements/head.php");
?>

<body>
    <div id="login" class="container">
        <main class="row full-screen">
            <div class="col-md-12 login-box">
                <div class="heading">
                    <h3 class="title">Prijava</h3>
                </div>
                <div class="login-form">
                    <form>
                        <fieldset>
                            <input type="hidden" name="action" value="login">
                            <div class="form-group">
                                <input class="form-control" placeholder="Korisničko ime" name="email_login" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control password-input" placeholder="Lozinka" name="lozinka" type="password" value="">
                                <a class="toggle js-toggle-password"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                            <button id="submit" type="button" class="btn-login" onClick="login();">Prijava</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </main>
    </div>

<?php include("footer.php");?>