$(document).ready(function () {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 2000
    });

    $('#loading').hide();

    $('form').submit(function (e) {
        e.preventDefault();

        // $('button[type=submit], input[type=submit]').prop('disabled', true);

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text
        $('.alert-success').remove();

        $("#loading").fadeIn("slow");
        var formData = new FormData(this);
        // console.log(formData);
        $.ajax({
            type: 'POST',
            // url: '<?= base_url("pemilwa/login") ?>',
            url: 'https://hmif-filkom-ub.online/pemilwa/login',
            data: formData, // data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            error: function (data) {
                alert(data);
                console.log(data)
            }

        }).done(function (data) {
            console.log(data)
            $("#loading").hide();
            // $('button[type=submit], input[type=submit]').prop('disabled', false);
            grecaptcha.reset();

            if (!data.success) {

                Toast.fire({
                    type: 'error',
                    title: data.message ? data.message : "Mohon lengkapi data pada form"
                });
                console.log(data)
                console.log('error di done fucntion')
            } else {

                Toast.fire({
                    type: 'success',
                    title: data.message
                });

                $("#form").trigger("reset");
                setInterval(() => {
                    window.location.replace("https://hmif-filkom-ub.online/pemilwa");
                    // window.location.replace("<?= base_url() ?>pemilwa");
                }, 3000);
            }
        })

    });
});