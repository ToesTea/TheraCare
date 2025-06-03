document.addEventListener('DOMContentLoaded', function() {
    // Add js-loaded class to body to enable transitions
    document.body.classList.add('js-loaded');
    
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');
    const navMenuContent = navbar.querySelector('.nav-links'); // Target the .nav-links container
    const dropdowns = document.querySelectorAll('.dropdown'); // Keep for existing dropdown logic
    const body = document.body;
    let isMobile = window.innerWidth <= 768;

    function updateIsMobile() {
        isMobile = window.innerWidth <= 768;
    }

    if (!menuToggle || !navbar || !navMenuContent) { // Check for navMenuContent
        console.error('Required navigation elements not found: menu-toggle, navbar, or nav-links container missing.');
        return;
    }

    // Setup ARIA attributes for navMenuContent
    const navMenuContentId = 'main-navigation-links';
    navMenuContent.setAttribute('id', navMenuContentId);
    menuToggle.setAttribute('aria-controls', navMenuContentId);
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-label', 'Menü öffnen');

    // Toggle menu on button click
    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const isActive = navMenuContent.classList.toggle('active'); // Toggle active on navMenuContent
        menuToggle.classList.toggle('active', isActive);       // Sync menuToggle's active class
        navbar.classList.toggle('active', isActive);         // Sync navbar's active class
        body.classList.toggle('menu-open', isActive);       // Sync body's menu-open class

        menuToggle.setAttribute('aria-expanded', isActive.toString());
        menuToggle.setAttribute('aria-label', isActive ? 'Menü schließen' : 'Menü öffnen');
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

    function closeMenu() {
        if (navMenuContent.classList.contains('active')) {
            navMenuContent.classList.remove('active');
            menuToggle.classList.remove('active');
            navbar.classList.remove('active');
            body.classList.remove('menu-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Menü öffnen');
            closeAllDropdowns(); // Also close any open dropdowns
        }
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isMenuOpen = navMenuContent.classList.contains('active');
        // Clicked outside the entire navbar (which contains the toggle button and menu content)
        const clickedOutsideNavbar = !navbar.contains(event.target); 
        
        if (isMenuOpen && clickedOutsideNavbar) {
            closeMenu();
        }
    });

    // Close menu when clicking a link within the navMenuContent
    const navLinksItems = navMenuContent.querySelectorAll('.link');
    navLinksItems.forEach(link => {
        link.addEventListener('click', function(event) { // Added event parameter
            // Only close if in mobile view and menu is open
            // Check if the link is not part of a dropdown toggle
            const isDropdownToggle = link.parentElement.classList.contains('dropdown');
            if (isMobile && navMenuContent.classList.contains('active')) {
                if (isDropdownToggle && link.parentElement.classList.contains('active')) {
                    // If it's an active dropdown toggle, let its own click handler manage it
                    // or decide if menu should close. For now, assume main link click closes.
                    // To prevent closing when a dropdown is interacted with, add more checks or stopPropagation in dropdown handler.
                } else if (!isDropdownToggle) {
                     // If it's a direct link (not a dropdown toggle), close the menu.
                    closeMenu();
                }
                // If it is a dropdown toggle link, its click is handled by the dropdown logic.
                // If the user wants menu to close even when opening a dropdown, remove the !isDropdownToggle condition.
            }
            // Allow default link behavior (navigation)
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const previouslyMobile = isMobile; // Store state before update
        updateIsMobile(); // Update isMobile status

        if (window.innerWidth > 768) { // If moved to desktop
            closeMenu(); // Close the menu
        } else if (!isMobile && previouslyMobile) { // Specifically transitioned from mobile to desktop
            closeMenu();
        }
        // If resizing within mobile, menu state persists unless explicitly closed.
        // If resizing to desktop, menu always closes.
    });

    // Initial mobile check
    updateIsMobile();
}); 