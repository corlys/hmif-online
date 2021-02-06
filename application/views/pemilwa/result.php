<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/resultpemilwa.css">
    <title><?= $title; ?></title>
</head>

<body>
    <header class="App-header">
        <h1>PEMILWA 2020</h1>
    </header>
    <main>
        <div class="candidate-item">
            <div class="candidate-img">
                <img class="card-img" src="<?= base_url() ?>assets/keluargahmif/next-gen/PasonOne.jpg" alt="Card image cap">
            </div>
            <div class="candidate-details">
                <h3>Alif</h3>
                <h3>Dimi</h3>
            </div>
            <div class="candidate-votes">
                <h1><?= $result2; ?></h1>
            </div>
        </div>
        <div class="candidate-item">
            <div class="candidate-img">
                <img class="card-img" src="<?= base_url() ?>assets/keluargahmif/next-gen/PasonTwo.jpg" alt="Card image cap">
            </div>
            <div class="candidate-details">
                <h3>Fathur</h3>
                <h3>Rafi</h3>
            </div>
            <div class="candidate-votes">
                <h1><?= $result1; ?></h1>
            </div>
        </div>
        <div class="candidate-item">
            <div class="candidate-img">
                <img class="card-img" src="<?= base_url() ?>assets/keluargahmif/next-gen/abstain.jpg" alt="Card image cap">
            </div>
            <div class="candidate-details">
                <h3>Abstain</h3>
            </div>
            <div class="candidate-votes">
                <h1><?= $result3; ?></h1>
            </div>
        </div>
    </main>
    <footer class="App-footer">
        <span id="copyright">2020 © Kabinet Rumah.</span>
    </footer>
</body>

</html>