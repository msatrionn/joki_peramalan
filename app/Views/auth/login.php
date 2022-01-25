<html>

<head>
    <title>Login</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body>
    <style>
        .container {
            width: 100%;
            padding-top: 5%;
        }

        .card {
            box-shadow: 1px 1px 3px 3px skyblue;
        }

        h5 {
            color: skyblue;
        }

        .card-header {
            text-align: center;
            background: skyblue;
            color: #fff;
            font-size: x-large;
        }
    </style>
    <div>
        <img src="<?= base_url('assets/img/gmb.jpg') ?>" alt="" style="position: absolute;height: 100vh;width:100%;object-fit: cover;">
        <?php
        $session = session();
        $login = $session->getFlashdata('login');
        $username = $session->getFlashdata('username');
        $password = $session->getFlashdata('password');
        ?>


        <?php if ($username) { ?>
            <p style="color:red"><?php echo $username ?></p>
        <?php } ?>

        <?php if ($password) { ?>
            <p style="color:red"><?php echo $password ?></p>
        <?php } ?>

        <?php if ($login) { ?>
            <p style="color:green"><?php echo $login ?></p>
        <?php } ?>

        <div class="container col-md-5">
            <div class="card">
                <div class=" card-header">Login</div>
                <div class="card-body">
                    <form method="post" action="/auth/valid_login">
                        <div class="form-group">
                            <h5> Username:</h5>
                            <input type="text" name="username" class="form-control" required><br>
                        </div>
                        <div class="form-group">
                            <h5> Password:</h5>
                            <input type="password" name="password" class="form-control" required><br>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                    <p>
                        <a href="/auth/register">Belum punya akun?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>