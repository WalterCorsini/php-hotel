<?php
$count = 0;
$hotels_filtered = [];
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
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

        
        <button type="submit" class="btn btn-outline-success rounded-5">Cerca</button>
        
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
            <div>
            <input class="rounded-5 p-2" id="voto" name="vote" type="number" min="1" max="5" value="1">
            <label for="voto">voto da 1 a 5</label>
            </div>
            <div class="container">
                <input id="park" name="park_required" type="checkbox">
                <span class="checkbox"></span>
                <label for="park">parcheggio</label>
            </div>
        </div>


    </form>
    <!-- /form -->

    <?php if (isset($_POST['park_required'])) { ?>
        <?php $hotels_filtered = array_filter($hotels, function ($hotels) {
            return $hotels["parking"];
        }); ?>
    <?php } else { ?>
        <?php $hotels_filtered = $hotels; ?>
    <?php } ?>
    <?php if (isset($_POST["vote"])) { ?>
        <?php $hotels_filtered = array_filter($hotels_filtered, function ($hotels_filtered) {
            return $hotels_filtered["vote"] >= $_POST["vote"];
        }); ?>
    <?php } ?>

    <?php if (count($hotels_filtered) > 0) { ?>
        <!-- table -->
        <table class="table w-75 m-auto text-center">
            <tbody>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Valutazione</th>
                    <th>Ditanza dal centro</th>
                </tr>
                <?php foreach ($hotels_filtered as $cur_hotel) { ?>
                    <tr>
                        <?php foreach ($cur_hotel as $key => $value) { ?>
                            <td scope="row">
                                <!-- check or cross for parking -->
                                <?php if ($value === true) {
                                    $value = "<span style=color:green>&check;</span>";
                                } elseif ($value === false) {
                                    $value = "<span style=color:red>&cross;</span>";
                                } ?>
                                <!-- add "km" at distance -->
                                <?php if ($key === "distance_to_center") {
                                    $value .= " km";
                                } ?>
                                <?php if ($key === "vote") {
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

                                <?php echo $value; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- /table -->
    <?php } else { ?>
        <h1 class="pt-5">nessun hotel trovato!</h1>
    <?php } ?>


</body>

</html>