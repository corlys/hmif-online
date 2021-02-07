<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/advo/css/pendataan.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pendaftaran Pemilwa</title>
    <style>
        .btn-primary {
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 0%, rgba(0, 212, 255, 1) 100%);
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="upperBack">
        <h3>Pendaftaran Pemilwa</h3>
    </div>
    <div id="bacotDiv">
        <div class="bacotContainer negMargin">
            <div class="row" style="padding:0;margin:0">
                <div class="col-3">
                    <img class="logo-emif" src="<?= base_url('assets/images/logo-bpmif.png') ?>" alt="">
                </div>
                <div class="col-3">
                    <img class="logo-hmif" src="<?= base_url('assets/images/logo-hmif.png') ?>" alt="">
                </div>
                <div class="col-3">
                    <img class="logo-emif" src="<?= base_url('assets/images/logo-emif.png') ?>" alt="">
                </div>
                <div class="col-3">
                    <h5 class="logo-emif"><?= $livecount; ?> Sudah Memilih</h5>
                </div>
            </div>

        </div>
    </div>
    <div class="formBox">
        <form id="form" class="tengahin" action="" method="POST">
            <!-- <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Nama Lengkap (wajib diisi)" name="nama_lengkap" required>
            </div> -->
            <div class="form-group">
                <label>NIM</label>
                <input type="number" class="form-control" placeholder="NIM (wajib diisi)" name="nim" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password SIAM (wajib diisi)" name="password_siam" required>
            </div>

            <div class="g-recaptcha d-flex justify-content-center" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div><br>
            <div id="loading" class="spinner-border text-primary" style="margin-left: 47.5%; margin-bottom: 20px;" role="status">
                <span class="sr-only">Loading...</span>
            </div>

            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="submit" id="submitform">Submit</button>
            </div>
        </form>

        <hr style="border-width: 1px; border-color: #35405a;">
        <p class="text-center" style="font:14px;">
            &copy; Eksekutif Mahasiswa Informatika UB 2020<br>
            Kabinet Rumah<br>

            #SatuPaduInformatika</p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.1/dist/sweetalert2.all.min.js"></script>
    <!-- Toastr -->
    <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <!-- google recapthca-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="<?= base_url('assets/js/formpemilwa.js') ?>?version=1.0.2"></script>

</body>

</html>