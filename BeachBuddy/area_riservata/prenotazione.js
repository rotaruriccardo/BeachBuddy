// CHIUSURA MODALE CLICK
document.querySelector('.modal .close').addEventListener('click', function() {
    document.getElementById('popupServizi').style.display = 'none';
    
});

// CHIUSURA MODALE CLICK OUT OF WINDOW
window.onclick = function(event) {
    if (event.target == document.getElementById('popupServizi')) {
        document.getElementById('popupServizi').style.display = 'none';
    }
};

// FUNZIONE NUM_OSPITI
document.getElementById('pranzo').addEventListener('change', function() {
    var numOspiti = document.getElementById('num_ospiti');
    if (this.checked) {
        numOspiti.disabled = false;
        document.getElementById('num_ospiti').value = 1;
    } else {
        numOspiti.disabled = true;
        numOspiti.value = '';
    }
});

// FUNZIONE CHECK DATA
document.getElementById('scegliServizi').addEventListener('click', function(){
    if(document.getElementById('data').value){
        document.getElementById('popupServizi').style.display = 'block';
    } else {
        alert('Inserisci prima la data di prenotazione!');
        return;
    }
});

// FUNZIONE ALERT PRENOTAZIONE
document.getElementById('confermaPrenotazione').addEventListener('click', function() {
    alert('Prenotazione effettuata con successo!');
});

// FUNZIONALITÀ MENU ICON 
const toggleBtn = document.querySelector('.menu-logo');
const toggleBtnIcon = document.querySelector('.menu-logo i');
const dropdown = document.querySelector('.dropdown-menu-area');

toggleBtn.onclick = function() {
    dropdown.classList.toggle('show');
    const isOpen = dropdown.classList.contains('show');
    toggleBtnIcon.classList = isOpen ? 'fa-solid fa-xmark fa-2xl' : 'fa-regular fa-user fa-2xl';
};