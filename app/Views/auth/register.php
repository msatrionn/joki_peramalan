<html>

<head>
    <title>Tutorial Login Dan Register</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body>
    <style>
        .container {
            width: 30%;
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
    <?php
    $session = session();
    $error = $session->getFlashdata('error');
    ?>

    <?php if ($error) { ?>
        <p style="color:red">Terjadi Kesalahan:
        <ul>
            <?php foreach ($error as $e) { ?>
                <li><?php echo $e ?></li>
            <?php } ?>
        </ul>
        </p>
    <?php } ?>

    <img src="<?= base_url('assets/img/gmb.jpg') ?>" alt="" style="position: absolute;height: 100vh;width:100%;object-fit: cover;">
    <div class="container col-md-5" style="width:100%;padding-top: 5%;">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form method="post" action="/auth/valid_register">
                    <div class="form-group">
                        Username: <br>
                        <input type="text" name="username" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        Password: <br>
                        <input type="password" name="password" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        Konfirmasi Password: <br>
                        <input type="password" name="confirm" class="form-control" required><br>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Register</button>
                </form>
                <p>
                    <a href="/auth/login">Sudah punya akun?</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>