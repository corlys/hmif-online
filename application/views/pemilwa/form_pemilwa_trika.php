<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/advo/css/pendataan.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pendaftaran Pemilwa</title>
    <style>
        /* .form-group img {

            height: auto;
            width: 220px;
        }

        .card {
            align-content: center;
            align-items: center;
            padding-right: 50px;
            padding-left: 50px;
        } */

        .parent {
            height: auto;
            display: grid;
            place-items: center;
            grid-gap: 20px 50px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-auto-rows: min-content;
        }

        .card-img {
            height: 200px;
            width: 100%;
            object-fit: contain;
        }

        .card {
            width: clamp(23ch, 100%, 46ch);
            display: flex;
            height: 100%;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            padding: 1rem;
        }

        h3 {
            margin: 0
        }

        .btn-wrap {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .header2 {
            padding-top: 100px;
        }

        .calon-wrapper {
            width: 100%;
        }

        .doi1 {
            text-align: center;
        }

        /* .doi2 {
            float: right;
        } */


        #vote-submit {
            grid-column: 1/-1;
            height: 50px;
            width: 100%;
            align-self: end;
            /* align item to bottom of row */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-primary {
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 0%, rgba(0, 212, 255, 1) 100%);
            color: whitesmoke;
        }
    </style>

<body>
    <div class="header2">
        <h4 id="title_calon" style="text-align:center;">Selamat Memilih</h4>
        <h5 style="text-align:center;"><?= $name; ?></h5>
        <h2 style="text-align:center;" id="countdown">10</h2>
    </div>

    <div class="formBox">
        <form id="form" class="tengahin" action="" method="POST">
            <div class="parent">
                <div class="card">
                    <div class="calon-wrapper">
                        <h3 class="doi1">1</h3>
                        <!-- <br />
                        <h3 class="doi2">Dimi</h3> -->
                    </div>
                    <img class="card-img" src="assets/keluargahmif/next-gen/formal1.jpg" alt="Card image cap">
                    <p>Achmad Fais Alif Adityo</p>
                    <p>Dimi Karillah Putra</p>
                    <label>
                        <input type="checkbox" class="radio" value="AlDi" name="calon" /><span>VOTE</span>
                    </label>
                </div>

                <div class="card">
                    <div class="calon-wrapper">
                        <h3 class="doi1">2</h3>
                        <!-- <br />
                        <h3 class="doi2">Rafi</h3> -->
                    </div>
                    <img class="card-img" src="assets/keluargahmif/next-gen/formal2.jpg" alt="Card image cap">
                    <p>Muhammad Fathur Rahman Khairul</p>
                    <p>Muhammad Rafi Adi Wibowo</p>
                    <label>
                        <input type="checkbox" class="radio" value="FaRa" name="calon" /><span>VOTE</span>
                    </label>
                </div>

                <div class="card">
                    <div class="calon-wrapper">
                        <h3 class="doi1">Abstain</h3>
                    </div>
                    <img class="card-img" src="assets/keluargahmif/next-gen/abstain.jpg" alt="Card image cap">
                    <p></p>
                    <p></p>
                    <label>
                        <input type="checkbox" class="radio" value="abstain" name="calon" /><span>Abstain</span>
                    </label>
                </div>
                <div id="vote-submit">
                    <button type="submit" class="btn btn-primary" name="submit" id="submitform">VOTE</button>
                </div>
            </div>

        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.1/dist/sweetalert2.all.min.js"></script>

    <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>

    <script type="text/javascript" src="<?= base_url('assets/js/voting.css') ?>"></script>


</body>

</html>