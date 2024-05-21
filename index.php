<?php
$hotels_filtered=[];
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
    <!-- style css -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <form action="index.php" method="POST">
        <button type="submit">click</button>
        <label for="park">parcheggio</label>
        <input id="park" name="park_required" type="checkbox">
        <input id="voto" name="voto" type="number" min="1" max="5">
        <label for="voto"></label>
    </form>

        <?php if(isset($_POST['park_required'])){?>
        <?php $hotel_filtered = array_filter($hotels , function($hotels) { return $hotels["parking"]; }) ; ?>
        <?php } else{ ?>
        <?php $hotel_filtered = $hotels; ?>
        <?php } ?>
        <?php $hotel_filtered = array_filter($hotels , function($hotels) { return $hotels["vote"] >= $_POST["voto"]; }) ; ?>


        <!-- table -->
        <table class="table">
            <tbody>
                <?php foreach ($hotel_filtered as $cur_hotel) { ?>
                    <tr>
                        <?php foreach ($cur_hotel as $key => $value) { ?>
                            <td scope="row">
                                <?php if($value === true){ $value = "si"; } elseif($value === false) { $value = "no"; } ?>
                                <?php echo "$key : $value"; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- /table -->

</body>

</html>