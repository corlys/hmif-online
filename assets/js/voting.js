$(document).ready(function () {

    $("input:checkbox").on('click', function () {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 2000
    });

    $('#loading').hide();


    if (sessionStorage.getItem("counter") === null) {
        sessionStorage.setItem("counter", 10);
    }
    // let countdown = 10;

    function decreaseCountDown() {

        var countdown = sessionStorage.getItem("counter");

        countdown--;

        sessionStorage.setItem("counter", countdown);

        document.getElementById("countdown").innerHTML = sessionStorage.getItem("counter");

        var counter = sessionStorage.getItem("counter")

        if (parseInt(counter) < 0) {

            $('#countdown').hide();

        } else if (parseInt(counter) === 0) {
            var postData = new FormData();

            postData.append('calon', 'abstain');

            console.log(postData)

            $.ajax({
                traditional: true,
                type: 'POST',
                url: '<?= base_url("pemilwa/vote") ?>',
                data: postData, // data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                processData: false,
                contentType: false,
                cache: false,
                async: true,
                error: function (data) {
                    console.log(error);
                    alert(error);
                }

            }).done(function (data) {
                console.log(data)
                // setInterval(() => {
                sessionStorage.setItem("counter", 10);
                window.location.replace("<?= base_url() ?>/pemilwa/init");
                // }, 10000);
            })
        }
    }

    setInterval(decreaseCountDown, 1000)

    $('form').submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Apakah anda sudah yakin dengan pilihan anda?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Sudah`,
            denyButtonText: `Belum`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                $('button[type=submit], input[type=submit]').prop('disabled', true);

                $('.form-group').removeClass('has-error'); // remove the error class
                $('.help-block').remove(); // remove the error text
                $('.alert-success').remove();

                $("#loading").fadeIn("slow");
                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("pemilwa/vote") ?>',
                    data: formData, // data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    error: function (data) {
                        alert(error);
                    }

                }).done(function (data) {
                    console.log(data)

                    if (!data.success) {
                        Toast.fire({
                            type: 'error',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            type: 'success',
                            title: data.message
                        });
                        sessionStorage.setItem("counter", 10);
                        // setInterval(() => {
                        window.location.replace("<?= base_url() ?>/pemilwa/init");
                        // }, 3000);
                    }

                })
            } else {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })



    });

});