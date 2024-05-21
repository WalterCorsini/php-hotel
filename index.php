<?php
$hotels_filtered = [];
$hotels = [

    [
        'nome' => 'Hotel Belvedere',
        'descrizione' => 'Hotel Belvedere Descrizione',
        'parcheggio' => true,
        'voto' => 4,
        'distanza dal centro' => 10.4
    ],
    [
        'nome' => 'Hotel Futuro',
        'descrizione' => 'Hotel Futuro Descrizione',
        'parcheggio' => true,
        'voto' => 2,
        'distanza dal centro' => 2
    ],
    [
        'nome' => 'Hotel Rivamare',
        'descrizione' => 'Hotel Rivamare Descrizione',
        'parcheggio' => false,
        'voto' => 1,
        'distanza dal centro' => 1
    ],
    [
        'nome' => 'Hotel Bellavista',
        'descrizione' => 'Hotel Bellavista Descrizione',
        'parcheggio' => false,
        'voto' => 5,
        'distanza dal centro' => 5.5
    ],
    [
        'nome' => 'Hotel Milano',
        'descrizione' => 'Hotel Milano Descrizione',
        'parcheggio' => true,
        'voto' => 2,
        'distanza dal centro' => 50
    ],

];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-hotel</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <!-- fontawesome -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="p-5 d-flex justify-content-center align-items-center flex-column">

    <!-- form -->
    <form class="pb-5 w-100 d-flex justify-content-center align-items-center gap-5" action="index.php" method="POST">

        <!--  button -->
        <button type="submit" class="btn btn-outline-success rounded-5">Cerca</button>

        <!-- choice -->
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
            <!-- search by voto -->
            <div class="">
                <input class="rounded-5 p-2" id="voto" name="voto" type="number" min="1" max="5" value="1">
                <label for="voto">Qualità: da 1 a 5 stelle</label>
            </div>

            <!-- add parcheggio required -->
            <div class="container">
                <input id="park" name="park_required" type="checkbox">
                <label for="park">parcheggio</label>
            </div>
        </div>
        <!-- /choice -->

    </form>
    <!-- /form -->

    <!-- control park_required -->
    <?php if (isset($_POST['park_required'])) { ?>
        <?php $hotels_filtered = array_filter($hotels, function ($hotels) {
            return $hotels["parcheggio"];
        }); ?>

    <!-- else -->
    <?php } else { ?>
        <?php $hotels_filtered = $hotels; ?>
    <?php } ?>

    <!-- voto key check at startup and filter by voto -->
    <?php if (isset($_POST["voto"])) { ?>
        <?php $hotels_filtered = array_filter($hotels_filtered, function ($hotels_filtered) {
            return $hotels_filtered["voto"] >= $_POST["voto"];
        }); ?>
    <?php } ?>
    
    <!-- shows the hotels found-->
    <?php if (count($hotels_filtered) > 0) { ?>

        <!-- table -->
        <table class="table w-75 m-auto text-center">

            <!-- thead -->
            <thead>
                <tr>
                    <?php foreach(array_keys($hotels[0]) as $key) { ?>
                    <th><?php echo $key; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <!-- /thead -->

            <!-- t-body -->
            <tbody>
                <?php foreach ($hotels_filtered as $cur_hotel) { ?>
                    <tr>
                        <?php foreach ($cur_hotel as $key => $value) { ?>
                            <td scope="row">
                                <!-- check or cross for parcheggio -->
                                <?php if ($value === true) {
                                    $value = "<span style=color:green>&check;</span>";
                                } elseif ($value === false) {
                                    $value = "<span style=color:red>&cross;</span>";
                                } ?>
                                <!-- /check or cross for parcheggio -->

                                <!-- add "km" at distance -->
                                <?php if ($key === "distanza dal centro") {
                                    $value .= " km";
                                } ?>
                                <!-- /add "km" at distance -->

                                <!-- add star -->
                                <?php if ($key === "voto") {
                                    $copy = $value;
                                    $value = "";
                                    for ($i = 0; $i < $copy; $i++) {
                                        $value .= "<span class=gold>&#9733;</span>";
                                    }
                                    for ($i = 0; $i < 5 - $copy; $i++) {
                                        $value .= "&#9734;";
                                    }
                                }
                                ?>
                                <!-- /add star -->

                                <?php echo $value; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
            <!-- /t-body -->

        </table>
        <!-- /table -->

    <!-- show message if no match found -->
    <?php } else { ?>
        <h1 class="pt-5">nessun hotel trovato!</h1>
    <?php } ?>


</body>

</html>