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
    <link rel="stylesheet" href="stile-homepage.css" />
    <link rel="shortcut icon" href="../assets/icon-blu.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200;300;400;600;700;800;900&family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3d4c32ad38.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>BeachBuddy</title>
</head>
<body>

    <nav class="navigation-container">
        <div class="logo">
            <a href="#"><img src='../assets/logo-white-piccolo.png' alt="Logo"></a>
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

    <div class="homepage">
        <div id="homepage">
            <h1>BeachBuddy</h1>
        </div>
        <h2 class="martel-light">Benvenuto nella tua area riservata, <?php echo $_SESSION['nome']; ?>! </h2>
        <a class="button martel-bold" style="scroll-behavior: smooth;" href="#spiagge">Prenota ora</a> <br>
    </div>

    <div class="banner-servizi" style="padding-bottom: 3rem;">
    </div>

    <div id="spiagge">
        <section class="spotlight style orient-right tag" id="first">
            <div class="content">
                <h2 class="martel-bold">Eden Beach</h2>
                <p class="martel-sans-regular">Un paradiso tropicale incontaminato, dove la sabbia dorata incontra acque cristalline. 
                <br>Eden Beach è un rifugio di pace e tranquillità, un luogo dove perdersi nella bellezza della natura e ritrovare se stessi.</p>
                <ul class="ul-btn">
                    <li><a href="index_prenotazione.php?spiaggia=Eden Beach" class="button">Controlla la disponibilità</a></li>
                </ul>
            </div>
            <div class="image tag">
                <img src="../assets/eden.jpg" alt="Eden Beach" />
            </div>
        </section>
        <section class="spotlight style orient-left tag" id="second">
            <div class="content">
                <h2 class="martel-bold">Celestial Cove</h2>
                <p class="martel-sans-regular">La sabbia di Celestial Cove è soffice e fine, perfetta per rilassarsi e prendere il sole. <br> L'acqua, limpida e pulita, è ideale per fare snorkeling, immersioni subacquee, o nuotare serenamente.
                <br> Se siete alla ricerca di una spiaggia tranquilla e selvaggia, Celestial Cove è la scelta ideale.</p>
                <ul class="ul-btn">
                    <li><a href="index_prenotazione.php?spiaggia=Celestial Cove" class="button">Controlla la disponibilità</a></li>
                </ul>
            </div>
                <div class="image tag">
                    <img src="../assets/spiaggia2.jpg" alt="Celestial Cove" />
                </div>
        </section>
        <section class="spotlight style orient-right tag" id="third">
                <div class="content">
                    <h2 class="martel-bold">Elysium Bay</h2>
                    <p class="martel-sans-regular">Una piccola baia appartata circondata da alte scogliere. Atmosfera esclusiva e raffinata, ma allo stesso tempo accogliente e familiare. 
                    <br>Se siete alla ricerca di un posto dove rilassarvi e godervi la bellezza della natura Elysium è il posto perfetto per voi.</p>
                    <ul class="ul-btn">
                        <li><a href="index_prenotazione.php?spiaggia=Elysium Bay" class="button">Controlla la disponibilità</a></li>
                    </ul>
                </div>
                <div class="image tag">
                    <img src="/assets/elysium beach.webp" alt="" />
                </div>
        </section>   
    </div>

    <div class="banner-servizi">
        <header >
            <h2 class="martel-bold banner-servizi-header" >I nostri eventi e servizi</h2>
        </header>
    </div>

    <div id="servizi" class="gallery-servizi" style="text-align: center;">   
          <img src="../assets/eventi.jpg" alt="Eventi" width="30%" class="tag">
          <img src="../assets/img-animazione-spiaggia.jpg" alt="Animazione" width="30%" class="tag">
          <img src="../assets/servizi.jpg" alt="Cena/Aperitivo" width="30%" class="tag">
    </div>

    <div class="banner-servizi" style="padding-bottom: 3rem;">
    </div>

      
    <div id="chi-siamo">
        <section class="spotlight style orient-right tag" id="fourth">
            <div class="content" style="text-align: center; display: flex; flex-direction: column; justify-content: space-between;">
                <h2 class="martel-bold" style="font-size: 4rem;">Chi Siamo?</h2>
                <h3 class="martel-sans-regular">Beachbuddy è la soluzione digitale completa per gestire al meglio la tua esperienza al mare! <br>
                    Siamo un team appassionato che si impegna a rendere le tue giornate in spiaggia più piacevoli e senza stress, offrendo un'ampia gamma di servizi tramite la nostra innovativa piattaforma online.
                </h3>
                <h2 class="martel-sans-bold">Con BeachBuddy, puoi evitare lunghe code e incertezze, e goderti al massimo ogni momento di relax e divertimento sulla sabbia</h2>
                <h3 class="martel-sans-bold">Per qualsiasi cosa, non esitare a contattarci!</h3>
                <div style="display: flex; justify-content: space-evenly; ">
                    <a href="mailto:savo.2021372@studenti.uniroma1.it" > <h3 class="martel-sans-bold links">Alessandro</h3></a>
                    <a href="mailto:rotaru.1996615@studenti.uniroma1.it" > <h3 class="martel-sans-bold links">Riccardo</h3></a>
                </div>
            </div>
            <div class="image tag">
                <img src="/assets/eventi2.jpeg" alt="Logo BeachBuddy" />
            </div>
        </section>
    </div>
    
    <div class="banner-servizi">
        <header >
            <h2 class="martel-bold banner-servizi-header" >Dicono di noi...</h2>
        </header>
    </div>

    <div class="recensioni-container tag">

        <div class="recensione">
            <div class="flex items-center">
                <i class="fa-regular fa-user fa-2xl" style="color:var(--colore-primario); padding-bottom: 1rem;"></i>
              <div>
                <h2 class="text-lg font-semibold martel-sans-regular">Elisa</h2>
                <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario); font-size: 1.20rem;">VOTAZIONE: 5/5</p>
              </div>
            </div>
            <p class="martel-sans-regular" style="color: var(--colore-primario);">
                Eden Beach è stato il luogo perfetto per chi cerca una vacanza all'insegna del relax e della tranquillità. 
                Non ci sono grandi alberghi o discoteche rumorose, solo la pace e la quiete della natura.
            </p>
            <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario);">12 Luglio, 2022</p>
        </div>
        <div class="recensione">
            <div class="flex items-center">
                <i class="fa-regular fa-user fa-2xl" style="color:var(--colore-primario); padding-bottom: 1rem;"></i>
              <div>
                <h2 class="text-lg font-semibold martel-sans-regular">Paolo</h2>
                <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario); font-size: 1.20rem;">VOTAZIONE: 5/5</p>
              </div>
            </div>
            <p class="martel-sans-regular" style="color: var(--colore-primario);">
                Abbiamo appena trascorso una settimana fantastica a Celestial Cove con la mia famiglia, 
                e non avremmo potuto chiedere di meglio! La spiaggia è un vero e proprio paradiso.
            </p>
            <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario);">15 Agosto, 2021</p>
        </div>
        <div class="recensione">
            <div class="flex items-center">
                <i class="fa-regular fa-user fa-2xl" style="color:var(--colore-primario); padding-bottom: 1rem;"></i>
              <div>
                <h2 class="text-lg font-semibold martel-sans-regular">Annalisa</h2>
                <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario); font-size: 1.20rem;">VOTAZIONE: 5/5</p>
              </div>
            </div>
            <p class="martel-sans-regular" style="color: var(--colore-primario);">
                Io e le mie amiche abbiamo trascorso un weekend indimenticabile all'Elysium Bay che ha saputo conquistarci sin dal primo sguardo.
                La sera, la baia si anima con eventi esclusivi che ci hanno fatto divertire un sacco.
            </p>
            <p class="nome-recensione-stile martel-sans-regular" style="color: var(--colore-terziario);">28 Luglio, 2023</p>
        </div>
    </div>

   <script src="arearis.js"></script> 
</body>
</html>