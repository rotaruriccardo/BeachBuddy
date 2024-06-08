<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../index.html');
    exit();
}

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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="stile-index_prenotazione.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="../assets/icon-blu.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3d4c32ad38.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Le mie recensioni</title>
</head>
<body>
<nav class="navigation-container">
        <div class="logo">
            <a href="index_areariservata.php"><img src='../assets/logo-white-piccolo.png' alt="Logo"></a>
        </div>
        <div class="contatti-servizi2"> 
            <a href="#" id="nuova-recensione" class="header-txt">Scrivi una recensione!</a>
        </div>
        <div class="menu-logo">
            <i class="fa-regular fa-user fa-2xl" style="color: white;"></i>
        </div>
        <div class="dropdown-menu-area">
            <li><a href="index_mieprenotazioni.php" class="header-txt">Le mie prenotazioni</a></li>
            <li><a href="index_mierecensioni.php" class="header-txt">Le mie recensioni</a></li>
            <li><a href="logout.php" class="header-btn" style="text-self; center">Logout</a></li>
        </div>
    </nav>  

    <div class="homepage" style="scroll-behavior: smooth;">
    <h1 style="margin-top: -3.5rem;">Le tue recensioni!</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>Titolo</th>
                <th>Valutazione (1-5)</th>
                <th>Recensione</th>
                <th>Data</th>
            </tr>
            <?php while ($row = pg_fetch_assoc($result_recensioni)): ?>
            <tr>
                <td><?php echo $row['titolo']; ?></td>
                <td><?php echo $row['valutazione']; ?></td>
                <td><?php echo $row['recensione']; ?></td>
                <td><?php echo $row['data']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div id="popupRecensione" class="modal">
        <div class="modal-content">
            <span class="close" id="chiudiRecensione">&times;</span>
            <form action="recensisci.php" method="POST" class="login-form">
                <img src="../assets/icon-blu.png" class="logo-form">
                <h2 class="nascondi-responsive">Racconta la tua esperienza!</h2>
                <div class="form-selection2">
                    <div class="input-e-label" style="padding-bottom: 1rem;">
                            <label for="titolo" class="label2">Titolo</label><input type="text" name="titolo" id="titolo" required>
                    </div>
                    <div class="input-e-label" style="padding-bottom: 1rem;">
                            <label for="valutazione" class="label2">Valutazione (1-5)</label><input type="number" name="valutazione" id="valutazione" min="1" max="5" required>
                    </div>
                    <div class="input-e-label" style="padding-bottom: 1rem;">
                            <label for="recensione" class="label2" style="top: -16.5px;">Recensione</label><textarea name="recensione" id="recensione" required></textarea>
                    </div>
                    <button type="submit" class="button" id="confermaRecensione">Invia Recensione</button>
                </div>
            </form>
        </div>
    </div> 


    <script>
        const toggleBtn = document.querySelector('.menu-logo');
        const toggleBtnIcon = document.querySelector('.menu-logo i');
        const dropdown = document.querySelector('.dropdown-menu-area');

        toggleBtn.onclick = function() {
            dropdown.classList.toggle('show');
            const isOpen = dropdown.classList.contains('show');
            toggleBtnIcon.classList = isOpen ? 'fa-solid fa-xmark fa-2xl' : 'fa-regular fa-user fa-2xl';
        };

        // MODALE NUOVA RECENSIONE
        document.getElementById('nuova-recensione').onclick = function() {
            document.getElementById('popupRecensione').style.display = 'block';
        };

        document.getElementById('chiudiRecensione').onclick = function() {
            document.getElementById('popupRecensione').style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById('popupRecensione')) {
                document.getElementById('popupRecensione').style.display = 'none';
            }
        };

        //ALERT
        document.getElementById('confermaRecensione').addEventListener('click', function() {
            alert('Grazie per averci raccontato la tua esperienza!');
        });
    </script>
 </body>
</html>
