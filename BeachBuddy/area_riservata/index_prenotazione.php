<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../index.html');
    exit();
}
if (!isset($_GET['spiaggia'])) {
    header('Location: index_areariservata.php');
    exit();
}

$spiaggia = $_GET['spiaggia'];

$dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar");

$utente_id = $_SESSION['id'];

$query_prenotazioni = "SELECT * FROM prenotazione WHERE utente_id = $1 ";
$result_prenotazioni = pg_query_params($dbconn, $query_prenotazioni, array($utente_id));

$query_recensioni = "SELECT * FROM recensioni WHERE utente_id = $1 ";
$result_recensioni = pg_query_params($dbconn, $query_recensioni, array($utente_id));
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenota ora</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="stile-index_prenotazione.css" />
    <link rel="shortcut icon" href="../assets/icon-blu.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3d4c32ad38.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
</head>
<body>
    <nav class="navigation-container">
        <div class="logo">
            <a href="index_areariservata.php"><img src="../assets/logo-white-piccolo.png" alt="Logo"></a>
        </div>
        <div class="menu-logo">
            <i class="fa-regular fa-user fa-2xl" style="color: white;"></i>
        </div>
        <div class="dropdown-menu-area">
            <li><a href="index_mieprenotazioni.php" class="header-txt">Le mie prenotazioni</a></li>
            <li><a href="index_mierecensioni.php" class="header-txt">Le mie recensioni</a></li>
            <li><a href="logout.php" class="header-btn" style="color: var(--colore-primario);">Logout</a></li> 
        </div>
    </nav>

    <div class="homepage">
        <h1>Prenota il tuo ombrellone!</h1>
        <h2>Ottima scelta, <?php echo htmlspecialchars($spiaggia); ?> farà proprio al caso tuo!</h2>
        
        <form action="prenota.php" method="POST" class="login-form">
            <input type="hidden" name="spiaggia" id="spiaggia" value="">
            <div class="form-selection">
                <div class="input-date">
                    <div class="input-e-label">
                        <label for="data" class="label">Data</label><input type="date" name="data" id="data" required>
                    </div>
                    <a id="scegliServizi" type="button" class="button">Scegli i servizi extra</a>
                </div>
            </div>
            
            <div id="popupServizi" class="modal">
                    <div class="modal-content">
                        <span class="close" type="button">&times;</span>
                        <div class="login-form" style="text-align: center">
                            <img src="../assets/icon-blu.png" class="logo-form">
                            <h2 class="nascondi-responsive">Scegli i servizi aggiuntivi per il tuo soggiorno!</h2>
                            <div class="input-e-label" style="padding-bottom: 1rem;">
                                <label for="lettini" class="label2">n. Lettini (€5.00 al pz.)</label><input type="number" name="lettini" id="lettini" min="0" max="3">
                            </div>
                            <div class="input-e-label" style="padding-bottom: 1rem;">
                                <label for="sdraio" class="label2">n. Sdraio (€4.00 al pz.)</label><input type="number" name="sdraio" id="sdraio" min="0" max="3">
                            </div>
                            <div class="input-e-label" style="padding-bottom: 1rem;">
                                <label for="sedia" class="label2">n. Sedie (€3.00 al pz.)</label><input type="number" name="sedia" id="sedia" min="0" max="3">
                            </div>
                            <div class="checkbox-container" style="padding-bottom: 1rem;">
                                <label for="animazion" class="label3 mr-4">Servizio animazione per bambini (€10.00)</label><input type="checkbox" id="animazione" name="animazione" class="form-checkbox">
                                <label for="pranzo" class="label3">Pranzo (€15.00 a persona)</label><input type="checkbox" id="pranzo" name="pranzo" class="form-checkbox">
                            </div>
                            <div class="input-e-label" style="padding-bottom: 1rem;">
                                <label for="num_ospit" class="label2">n. di ospiti per il pranzo</label><input type="number" name="num_ospiti" id="num_ospiti" min="1" disabled>
                            </div>
                            <button id="confermaServizi" type="button" class="button" type="submit">Conferma servizi</button>  
                        </div>
                    </div>        
            </div>
            <button id="controllaDisponibilita" type="button" class="button" style="align-self: center; margin-top: 3rem; opacity: 0.3; margin-bottom: 1.5rem;" disabled >
                Controlla gli ombrelloni disponibili
            </button>

            <div id="grigliaOmbrelloni" class="griglia-ombrelloni" style="display: none; padding: 2rem;">
                <!-- Qui comparirà la griglia degli ombrelloni-->
            </div>
            <input type="hidden" name="ombrellone" id="ombrellone" value="">
            <button id="confermaPrenotazione" type="submit" class="button" style="display: none; align-self: center;">Conferma Prenotazione</button>
        </form>
    </div>


    <script>       
        document.getElementById('controllaDisponibilita').addEventListener('click', function() {
            var spiaggia = "<?php echo htmlspecialchars($spiaggia); ?>";
            document.getElementById('spiaggia').value = spiaggia;
            var data = document.getElementById('data').value; // Aggiunta della definizione della variabile data
            
    
            // Aggiunta della definizione della variabile data
            document.getElementById('data').value = data;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'verifica_disponibilita.php?data=' + data + '&spiaggia=' + spiaggia, true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var grigliaOmbrelloni = document.getElementById('grigliaOmbrelloni');
                    grigliaOmbrelloni.innerHTML = '';

                    if (response.length > 0) {
                        for (var i = 1; i <= 30; i++) {
                            var ombrello = document.createElement('div');
                            ombrello.classList.add('ombrello');
                            ombrello.textContent = i;
                            ombrello.dataset.ombrellone = i;

                            if (response.indexOf(i) !== -1) {
                                ombrello.style.backgroundColor = 'green';
                                ombrello.classList.add('disponibile');
                                ombrello.addEventListener('click', function() {
                                    var selectedOmbrellone = this.dataset.ombrellone;
                                    document.getElementById('ombrellone').value = selectedOmbrellone;

                                    var ombrelloni = document.querySelectorAll('.ombrello');
                                    ombrelloni.forEach(function(ombrello) {
                                        ombrello.classList.remove('selezionato');
                                    });

                                    this.classList.add('selezionato');
                                    document.getElementById('confermaPrenotazione').style.display = 'block';
                                });
                            } else {
                                ombrello.style.backgroundColor = 'red';
                                ombrello.classList.add('occupato');
                            }
                            grigliaOmbrelloni.appendChild(ombrello);
                        }
                    } else {
                        grigliaOmbrelloni.innerHTML = '<p>Nessun ombrellone disponibile per questa data e spiaggia.</p>';
                        document.getElementById('confermaPrenotazione').style.display = 'none';
                    }
                    grigliaOmbrelloni.style.display = 'grid';
                } else {
                    console.error('Errore nella richiesta AJAX');
                }
            };
            xhr.send();
        });

        document.getElementById('confermaServizi').addEventListener('click', function() {
        let lettini = parseInt(document.getElementById('lettini').value) || 0;
        let sdraio = parseInt(document.getElementById('sdraio').value) || 0;
        let sedia = parseInt(document.getElementById('sedia').value) || 0;
        console.log(lettini);
        console.log(sdraio);
        console.log(sedia);

        if (lettini + sdraio + sedia > 3) {
            alert('Il numero totale di pezzi non può superare 3 per ogni ombrellone!');
            return;
        }

        document.getElementById('popupServizi').style.display = 'none';
        document.getElementById('controllaDisponibilita').disabled = false;
        document.getElementById('controllaDisponibilita').style.opacity = 1;

        });
    </script>
    <script src="prenotazione.js"></script>
</body>
</html>

