<?php
session_start(); // Inizia la sessione

// Connessione al database
$dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar");
if ($dbconn) {
    // Recupero dei dati dal form di login
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // Sanitizzazione input
    $email = pg_escape_string($dbconn, $email);
    $password = pg_escape_string($dbconn, $password);

    // Query per trovare l'utente
    $query = "SELECT id, nome, email, pswd FROM utente WHERE email=$1";
    $result = pg_query_params($dbconn, $query, array($email));

    if ($result) {
        $user = pg_fetch_assoc($result);
        if ($user && $user['pswd'] === $password) {
            // Password corretta, salva l'email nella sessione
            $_SESSION['id']=$user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nome'] = $user['nome'];

            header('Location: ../area_riservata/index_areariservata.php');
            exit();
        } else {
            // Password errata, reindirizza alla homepage con un parametro di errore
            header('Location: ../index.html?loginError=true');
            exit();
        }
    } else {
        die('Richiesta fallita');
    }
} else {
    die('Errore di connessione al database');
}
?>
