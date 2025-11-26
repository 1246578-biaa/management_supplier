<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="admin/css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="index.php?controller=login&action=process">
                            <fieldset>

                                <!-- EMAIL -->
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                                </div>

                                <!-- PASSWORD -->
                                <div class="form-group">
                                    <input id="passwordField" class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>

                                <!-- TAMPILKAN PASSWORD -->
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="togglePassword"> Tampilkan Password
                                    </label>
                                </div>

                                <!-- PESAN ERROR -->
                                <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                            if ($_GET['error'] == 'wrong_email') echo "Email tidak terdaftar!";
                                            if ($_GET['error'] == 'wrong_password') echo "Email atau password salah!";
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <!-- LOGIN BUTTON -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- SCRIPT -->
    <script src="admin/js/jquery-1.10.2.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="admin/js/sb-admin.js"></script>

    <!-- Show/Hide Password -->
    <script>
        document.getElementById("togglePassword").addEventListener("change", function() {
            let pw = document.getElementById("passwordField");
            pw.type = this.checked ? "text" : "password";
        });
    </script>

</body>

</html>
