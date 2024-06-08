<?php
    // Connessione al database
    $dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar");

    // Verifica se la connessione è avvenuta con successo
    if (!$dbconn) {
        die("Connessione al database fallita");
    }

    // Ricezione dei parametri dalla richiesta AJAX
    $data = $_GET['data'];
    $spiaggia = $_GET['spiaggia'];

    // Esecuzione della query per ottenere gli ombrelloni prenotati per quella data e quella spiaggia
    $query = "SELECT ombrellone FROM prenotazione WHERE data = $1 AND spiaggia = $2";
    $result = pg_query_params($dbconn, $query, array($data, $spiaggia));

    // Creazione di un array per memorizzare gli ombrelloni occupati
    $ombrelloni_occupati = array();

    // Se ci sono risultati dalla query, memorizzali nell'array degli ombrelloni occupati
    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $ombrelloni_occupati[] = intval($row['ombrellone']);
        }
    }

    // Creazione di un array per memorizzare tutti gli ombrelloni disponibili
    $ombrelloni_disponibili = array();

    // Popoliamo l'array con tutti gli ombrelloni
    for ($i = 1; $i <= 30; $i++) {
        $ombrelloni_disponibili[] = $i;
    }

    // Rimuoviamo gli ombrelloni occupati dall'array degli ombrelloni disponibili
    $ombrelloni_disponibili = array_diff($ombrelloni_disponibili, $ombrelloni_occupati);

    // Restituzione dei risultati in formato JSON
    echo json_encode(array_values($ombrelloni_disponibili)); // Usiamo array_values per riportare gli indici dall'array

    // Chiusura della connessione al database
    pg_close($dbconn);
?>

