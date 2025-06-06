// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');
    const body = document.body;

    if (menuToggle && navbar) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            menuToggle.classList.toggle('active');
            navbar.classList.toggle('active');
            body.classList.toggle('menu-open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbar.contains(event.target) && !menuToggle.contains(event.target)) {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });

        // Close menu when clicking a link
        navbar.querySelectorAll('.link').forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            });
        });

        // Prevent menu from staying open on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });
    }
    if(document.getElementById("lorem")!=null){
        document.getElementById('lorem').innerHTML = content;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const langSelect = document.getElementById('language-select');
    const homeTextEl = document.getElementById('home-text');
  
    async function loadHomeText(lang = 'de') {
      try {
        const res = await fetch('texts.json');
        if (!res.ok) throw new Error('Fehler beim Laden der Texte');
        const data = await res.json();
        homeTextEl.textContent = data.home[lang] || 'Text nicht gefunden.';
      } catch (e) {
        homeTextEl.textContent = 'Fehler beim Laden der Texte.';
        console.error(e);
      }
    }
  if(langSelect!==null){
    langSelect.addEventListener('change', (e) => {
      loadHomeText(e.target.value);
    });
  
    // load default language on page load
    loadHomeText(langSelect.value);
  }
});
