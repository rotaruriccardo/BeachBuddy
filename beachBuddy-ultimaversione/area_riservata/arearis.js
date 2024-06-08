document.addEventListener("scroll",() =>{
    const header = document.querySelector("nav");

    if(window.scrollY > 0){
        header.classList.add("scrolled");
    } else{
        header.classList.remove("scrolled");
    }
});

window.addEventListener('load', function() {
    setTimeout(() => {
      window.scrollTo(0, 0);
    }, 0);
  });


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

const toggleBtn = document.querySelector('.menu-logo');
const toggleBtnIcon = document.querySelector('.menu-logo i');
const dropdown = document.querySelector('.dropdown-menu-area');

toggleBtn.onclick = function() {
    dropdown.classList.toggle('show');
    const isOpen = dropdown.classList.contains('show');
    toggleBtnIcon.classList = isOpen ? 'fa-solid fa-xmark fa-2xl' : 'fa-regular fa-user fa-2xl';
}