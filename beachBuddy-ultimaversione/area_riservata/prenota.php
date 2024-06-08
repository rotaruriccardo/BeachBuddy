<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index_areariservata.php');
    exit();
}

$dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar");
$utente_id = $_SESSION['id'];
$spiaggia = $_POST['spiaggia'];
$data = $_POST['data'];
$ombrellone = $_POST['ombrellone'];
$lettini = isset($_POST['lettini']) ? (int)$_POST['lettini'] : 0;
$sdraio = isset($_POST['sdraio']) ? (int)$_POST['sdraio'] : 0;
$sedia = isset($_POST['sedia']) ? (int)$_POST['sedia'] : 0;
$animazione = isset($_POST['animazione']) ? 'true' : 'false';
$pranzo = isset($_POST['pranzo']) ? $_POST['num_ospiti'] : 0;

// Calcolo del costo totale
if (date('m', strtotime($data)) == 7) {
    $prezzo_ombrellone = 20;
} elseif (date('m', strtotime($data)) == 8) {
    $prezzo_ombrellone = 25;
} else {
    $prezzo_ombrellone = 15;
}

$totale = $prezzo_ombrellone + ($lettini * 5) + ($sdraio * 4) + ($sedia * 3) + ($animazione === 'true' ? 10 : 0) + ($pranzo * 15);
$query_check = "SELECT * FROM prenotazione WHERE data = $1 AND spiaggia = $2 AND ombrellone = $3";
$result_check = pg_query_params($dbconn, $query_check, array($data, $spiaggia, $ombrellone));

if (pg_num_rows($result_check) == 0) {
    $query = "INSERT INTO prenotazione (utente_id, spiaggia, data, ombrellone, lettino, sdraio, sedia, animazione, pranzo, totale) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
    $result = pg_query_params($dbconn, $query, array($utente_id, $spiaggia, $data, $ombrellone, $lettini, $sdraio, $sedia, $animazione, $pranzo, $totale));
    if ($result) {
        // Redirect alla pagina dell'area riservata dopo la prenotazione
        header('Location: index_areariservata.php');
    } else {
        echo "Errore nella prenotazione";
    }
} else {
    // Messaggio di errore se l'ombrellone è già stato prenotato
    echo "Ombrellone già prenotato";
}
