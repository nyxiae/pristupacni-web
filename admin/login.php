<?php
include("../elements/head.php");
?>

<body>
    <div id="login" class="container">
        <div class="row full-screen">
            <div class="col-md-12 login-box">
                <div class="heading">
                    <h3 class="title">Prijava</h3>
                </div>
                <div class="login-form">
                    <form id="loginForm">
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <input class="form-control" placeholder="Korisničko ime" name="korisnicko_ime" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control password-input" placeholder="Lozinka" name="lozinka" type="password" value="">
                            <a class="toggle js-toggle-password"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                        <button id="submit" type="button" class="btn-login" onClick="login();">Prijava</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.js-toggle-password').addEventListener('click', function () {
            const passwordInput = document.querySelector('.password-input');
            const passwordIcon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        });

        async function login() {
            const form = document.getElementById('loginForm');
            const formData = new FormData(form);

            try {
                const response = await fetch('/admin/class/SessionControl.php', {
                    method: 'POST',
                    body: formData
                });

                const text = await response.text();

                if (text == 1) {
                    window.location.href = 'index.php';
                } else {
                    Swal.fire("Oops...", text, "error");
                }
            } catch (error) {
                Swal.fire("Oops...", "Something went wrong. Please try again later.", "error");
            }
        }
    </script>

<?php include("footer.php");?>