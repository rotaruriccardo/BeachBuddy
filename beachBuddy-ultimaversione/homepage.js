// APERTURA MODALI
document.getElementById('loginBtn').onclick = function() {
    document.getElementById('loginModal').style.display = 'block';
};
document.getElementById('registerBtn').onclick = function() {
    document.getElementById('registerModal').style.display = 'block';
};
document.getElementById('loginBtn2').onclick = function() {
    document.getElementById('loginModal').style.display = 'block';
};
document.getElementById('registerBtn2').onclick = function() {
    document.getElementById('registerModal').style.display = 'block';
};
document.getElementById('first-log').onclick = function() {
    document.getElementById('loginModal').style.display = 'block';
};
document.getElementById('second-log').onclick = function() {
    document.getElementById('loginModal').style.display = 'block';
};
document.getElementById('third-log').onclick = function() {
    document.getElementById('loginModal').style.display = 'block';
};

// CHIUSURA MODALI X
document.getElementById('closeLogin').onclick = function() {
    document.getElementById('loginModal').style.display = 'none';
};
document.getElementById('closeRegister').onclick = function() {
    document.getElementById('registerModal').style.display = 'none';
};

// CHIUSURA MODALI OUT OF WINDOW
window.onclick = function(event) {
    if (event.target == document.getElementById('loginModal')) {
        document.getElementById('loginModal').style.display = 'none';
    }
    if (event.target == document.getElementById('registerModal')) {
        document.getElementById('registerModal').style.display = 'none';
    }
};

// FUNZIONE ERRORE LOGIN
const urlParams = new URLSearchParams(window.location.search);
const loginError = urlParams.get('loginError');

if (loginError) {
alert("Email o password errati. Riprova.");
}

// FUNZIONE CLASSE SCROLLED
document.addEventListener("scroll",() =>{
    const header = document.querySelector("nav");

    if(window.scrollY > 0){
        header.classList.add("scrolled");
    } else{
        header.classList.remove("scrolled");
    }
});

// FUNZIONE SCROLL ON RELOAD PAGE
window.addEventListener('load', function() {
    setTimeout(() => {
      window.scrollTo(0, 0);
    }, 0);
});

// FUNZIONE 
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      } else {
        entry.target.classList.remove("visible");
      }
    });
  });

  const tags = $(".tag");
  tags.each((index, tag) => {
    observer.observe(tag);
  });

// FUNZIONE ICONA MENU
const toggleBtn = document.querySelector('.menu-logo');
const toggleBtnIcon = document.querySelector('.menu-logo i');
const dropdown = document.querySelector('.dropdown-menu-area');

toggleBtn.onclick = function() {
    dropdown.classList.toggle('show');
    const isOpen = dropdown.classList.contains('show');
    toggleBtnIcon.classList = isOpen ? 'fa-solid fa-xmark fa-2xl' : 'fa-solid fa-bars fa-2xl';
    dropdown.classList.replace('overflow:hidden;','overflow: visible');
}