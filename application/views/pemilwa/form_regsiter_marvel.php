<!DOCTYPE html>
<html lang="en">

<head>
    <title>Open Recruitment Ketua HMIF 2020</title>
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
</head>

<body>
    <div class="upperBack">
        <h3 style="margin-top: 7.5%;">Open Recruitment Staff EMIF 2020/2021</h3>
    </div>
    <div id="bacotDiv">
        <div class="bacotContainer negMargin">
            <div class="row" style="padding:0;margin:0">
                <div class="col-6">
                    <img class="logo-hmif" src="<?= base_url('assets/images/logo-hmif.png') ?>" alt="">
                </div>
                <div class="col-6">
                    <img class="logo-emif" src="<?= base_url('assets/images/logo-emif.png') ?>" alt="">
                </div>
            </div>

        </div>
    </div>
    <div class="formBox">
        <form id="form" class="tengahin" method="POST">
            <div class="text-danger"><strong><?= $this->session->flashdata('flashError') ?></strong></div>
            <div id="nama_group" class="form-group">
                <label>Nama Lengkap Calon Ketua EMIF </label>
                <input type="text" class="form-control" placeholder="Nama Lengkap (wajib diisi)" name="nama_lengkap" required>
            </div>
            <div id="nim_group" class="form-group">
                <label>NIM Calon Ketua EMIF</label>
                <input type="text" class="form-control" placeholder="NIM (wajib diisi)" name="nim" required>
            </div>

            <div id="kontak_group" class="form-group">
                <label>ID Line Calon Ketua EMIF</label><br>
                <input type="text" class="form-control" name="kontak" placeholder="ID Line (wajib diisi)" required></input>
            </div>
            <div id="nomor_group" class="form-group">
                <label>Nomor HP Calon Ketua EMIF </label><br>
                <input type="text" class="form-control" name="nomor" placeholder="Nomor Hp (wajib diisi)" required></input>
            </div>

            <!-- <div id="pilihan_1_group" class="form-group">
                <label>Pilihan Divisi 1</label>
                <select class="form-control" name="pilihan_1" required>
                    <option value="" disabled selected hidden></option>
                    <option value="Departemen Advokesma">Departemen Advokesma</option>
                    <option value="Departemen Pengembangan Ilmu dan Profesi">Departemen Pengembangan Ilmu dan Profesi
                    </option>
                    <option value="Departemen Pengembangan Sumber Daya Manusia">Departemen Pengembangan Sumber Daya
                        Manusia</option>
                    <option value="Departemen Sosial Masyarakat">Departemen Sosial Masyarakat</option>
                    <option value="Departemen Minat Bakat">Departemen Minat Bakat</option>
                    <option value="Biro Komunikasi & Informasi">Biro Komunikasi & Informasi</option>
                    <option value="Biro Usaha Milik Himpunan">Biro Usaha Milik Himpunan</option>
                    <option value="Biro IT">Biro IT</option>
                </select>
            </div>

            <div id="pilihan_2_group" class="form-group">
                <label>Pilihan Divisi 2</label>
                <select class="form-control" name="pilihan_2" required>
                    <option value="" disabled selected hidden></option>
                    <option value="Departemen Advokesma">Departemen Advokesma</option>
                    <option value="Departemen Pengembangan Ilmu dan Profesi">Departemen Pengembangan Ilmu dan Profesi
                    </option>
                    <option value="Departemen Pengembangan Sumber Daya Manusia">Departemen Pengembangan Sumber Daya
                        Manusia</option>
                    <option value="Departemen Sosial Masyarakat">Departemen Sosial Masyarakat</option>
                    <option value="Departemen Minat Bakat">Departemen Minat Bakat</option>
                    <option value="Biro Komunikasi & Informasi">Biro Komunikasi & Informasi</option>
                    <option value="Biro Usaha Milik Himpunan">Biro Usaha Milik Himpunan</option>
                    <option value="Biro IT">Biro IT</option>
                </select>
            </div> -->

            <div id="alasan_group" class="form-group">
                <label>Alasan Calon Ketua EMIF Mencalonkan Diri</label><br>
                <textarea style="resize: none" class="form-control" rows="4" cols="200" name="alasan_1" placeholder="Silakan isi alasan..." required></textarea>
            </div>

            <!-- <div id="alasan_2_group" class="form-group">
                <label>Alasan pilihan divisi 2</label><br>
                <textarea style="resize: none" class="form-control" rows="4" cols="200" name="alasan_2"
                    placeholder="Silakan isi alasan..." required></textarea>
            </div> -->


            <div id="foto" class="form-group">
                <label>Foto Formal Calon Ketua EMIF memakai Jas Almamater Universitas Brawijaya dengan Latar
                    Belakang(Background) Merah (Ukuran Maks 3Mb)</label><br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="foto" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <p style="font-size: 12px; font-weight: bold">jpeg|jpg|png, max 3MB</p>
            </div>

            <!-- <div id="siam" class="form-group">
                <label>Screenshot SIAM (Format Penamaan File : siam_NAMA)</label><br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02"
                            aria-describedby="inputGroupFileAddon02" name="siam" required>
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                </div>
                <p style="font-size: 12px; font-weight: bold">jpeg|jpg|png, max 3MB</p>
            </div> -->

            <div id="loading" class="spinner-border text-primary" style="margin-left: 47.5%; margin-bottom: 20px;" role="status">
                <span class="sr-only">Loading...</span>
            </div>

            <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>

            <div class="form-group" style="margin-top: 40px;">
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="Submit" style="text-align:center; width: 45%; margin: 0 auto;" />
                </div>
            </div>

            <!-- <div class="form-group">
                <p style="text-align: center">Link download form offline akan muncul setelah submit form</p>
                <div align="center" style="text-align:center; width: 45%; margin: 0 auto;">
                    <button id="btn-download" class="btn btn-primary" style="width:100%"><i class="fa fa-download"></i>
                        Download Form Offline</button>
                </div>
            </div> -->


        </form>

        <hr style="border-width: 1px; border-color: #35405a;">
        <p class="text-center" style="font:14px;">
            &copy; HMIF<br>
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

    <script>
        $('#inputGroupFile01').on('change', function() {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        // $('#inputGroupFile02').on('change', function() {
        //     //get the file name
        //     var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //     //replace the "Choose a file" label
        //     $(this).next('.custom-file-label').html(fileName);
        // })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000
        });

        $("#btn-download").hide();
        $("#loading").hide();

        var link_form_offline = "http://bit.ly/FormOfflineOprec2021";

        // $("#btn-download").click(function(e) {
        //     // window.location.href = "http://google.com";
        //     window.open(link_form_offline, '_blank');
        // })

        $('form').submit(function(e) {
            e.preventDefault();

            $('button[type=submit], input[type=submit]').prop('disabled', true);

            $('.form-group').removeClass('has-error'); // remove the error class
            $('.help-block').remove(); // remove the error text
            $('.alert-success').remove();

            var formData = new FormData(this);

            // alert("Submitted");
            // alert(JSON.stringify(formData));

            $("#loading").fadeIn("slow");

            // process the form
            $.ajax({
                    type: 'POST',
                    url: '<?= base_url("pemilwa/register/add") ?>',
                    data: formData, // data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    error: function(data) {
                        alert("AJAX ERROR")
                        alert(JSON.stringify(data));
                    }
                })

                // using the done promise callback
                .done(function(data) {

                    $("#loading").hide();
                    $('button[type=submit], input[type=submit]').prop('disabled', false);
                    grecaptcha.reset();

                    // here we will handle errors and validation messages
                    if (!data.success) {

                        Toast.fire({
                            type: 'error',
                            title: data.message ? data.message : "Mohon lengkapi data pada form",
                        });

                        for (var key in data.errors) {
                            eval(data.errors[key]);
                        }

                    } else {

                        $("#btn-download").fadeIn("slow");

                        setTimeout(function() {
                            window.open(link_form_offline, '_blank');
                        }, 2000);

                        // ALL GOOD! just show the success message!
                        // $('form[id=form]').prepend('<div class="alert alert-success">' + data.message + '</div>');
                        Toast.fire({
                            type: 'success',
                            title: data.message
                        });

                        // usually after form submission, you'll want to redirect
                        // window.location = '/thank-you'; // redirect a user to another page
                        // alert('success'); // for now we'll just alert the user

                        $("#form").trigger("reset");
                        $("#inputGroupFile01").next('.custom-file-label').html("");
                        $("#inputGroupFile02").next('.custom-file-label').html("");
                        // $('.textarea').summernote('code', '');
                    }
                });
        });
    </script>
</body>

</html>

<!-- Courtesy of Departemen Sosial Masyarakat Kabinet Kembali -->