<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titolo = $_POST['titolo'];
    $valutazione = $_POST['valutazione'];
    $recensione = $_POST['recensione'];
    $utente_id = $_SESSION['id'];
    $data = date('Y-m-d');

    $dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar");

    $query = "INSERT INTO recensioni (titolo, valutazione, recensione, utente_id, data) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($dbconn, $query, array($titolo, $valutazione, $recensione, $utente_id, $data));

    if ($result) {
        header('Location: index_areariservata.php');
        exit();
    } else {
        echo "Errore durante l'inserimento della recensione.";
    }
}
?>
