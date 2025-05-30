document.addEventListener('DOMContentLoaded', function() {
    // Add js-loaded class to body to enable transitions
    document.body.classList.add('js-loaded');
    
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');
    const dropdowns = document.querySelectorAll('.dropdown');
    const body = document.body;
    let isMobile = window.innerWidth <= 768;

    function updateIsMobile() {
        isMobile = window.innerWidth <= 768;
    }

    if (!menuToggle || !navbar) {
        console.error('Required navigation elements not found');
        return;
    }

    // Toggle menu on button click
    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        menuToggle.classList.toggle('active');
        navbar.classList.toggle('active');
        body.classList.toggle('menu-open');
    });

    // Handle dropdowns
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('.link');
        
        // Toggle dropdown on click (mobile) or hover (desktop)
        link.addEventListener('click', function(e) {
            if (isMobile) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('active');
                    }
                });
                
                dropdown.classList.toggle('active');
            }
        });

        // Desktop hover functionality
        if (!isMobile) {
            dropdown.addEventListener('mouseenter', function() {
                if (!isMobile) {
                    this.classList.add('active');
                }
            });

            dropdown.addEventListener('mouseleave', function() {
                if (!isMobile) {
                    this.classList.remove('active');
                }
            });
        }
    });

    function closeAllDropdowns() {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isMenuOpen = navbar.classList.contains('active');
        const clickedOutside = !navbar.contains(event.target) && !menuToggle.contains(event.target);
        
        if (isMenuOpen && clickedOutside) {
            menuToggle.classList.remove('active');
            navbar.classList.remove('active');
            body.classList.remove('menu-open');
        }
    });

    // Close menu when clicking a link
    const navLinks = navbar.querySelectorAll('.link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            menuToggle.classList.remove('active');
            navbar.classList.remove('active');
            body.classList.remove('menu-open');
        }
    });

    // Initial mobile check
    updateIsMobile();

    // Add initial ARIA attributes
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-label', 'Menü öffnen');
    menuToggle.setAttribute('aria-controls', 'navigation-menu');
    navbar.querySelector('.section-inner').setAttribute('id', 'navigation-menu');
}); 