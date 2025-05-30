// Slideshow functionality
let slideIndex = 1;
let slideIndex2 = 1;

// Show first slides on page load
document.addEventListener('DOMContentLoaded', function() {
    showSlides(slideIndex, '');
    showSlides(slideIndex2, '2');
});

// Next/previous controls
function plusSlides(n, suffix) {
    if (suffix === '2') {
        showSlides(slideIndex2 += n, suffix);
    } else {
        showSlides(slideIndex += n, suffix);
    }
}

// Thumbnail image controls
function currentSlide(n, suffix) {
    if (suffix === '2') {
        showSlides(slideIndex2 = n, suffix);
    } else {
        showSlides(slideIndex = n, suffix);
    }
}

function showSlides(n, suffix) {
    let i;
    let slides = document.getElementsByClassName("gallery-old-slide" + (suffix || ""));
    let dots = document.getElementsByClassName("gallery-old-dot" + (suffix || ""));
    
    if (!slides.length) return;

    // Reset to first slide if we've gone past the end
    if (n > slides.length) {
        if (suffix === '2') {
            slideIndex2 = 1;
        } else {
            slideIndex = 1;
        }
    }
    
    // Go to last slide if we've gone before the beginning
    if (n < 1) {
        if (suffix === '2') {
            slideIndex2 = slides.length;
        } else {
            slideIndex = slides.length;
        }
    }

    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slides[i].classList.remove('active');
    }
    
    // Remove active class from all dots
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove('active');
    }

    // Show current slide and activate corresponding dot
    let currentIndex = suffix === '2' ? slideIndex2 - 1 : slideIndex - 1;
    slides[currentIndex].style.display = "block";
    slides[currentIndex].classList.add('active');
    if (dots.length) {
        dots[currentIndex].classList.add('active');
    }
}

// Gallery modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Check for URL parameters to show success/error messages
    const urlParams = new URLSearchParams(window.location.search);
    
    if(urlParams.has('success')) {
        alert('Bild wurde erfolgreich hochgeladen!');
    } else if(urlParams.has('error')) {
        const error = urlParams.get('error');
        switch(error) {
            case 'type':
                alert('Fehler: Nur JPG, JPEG, PNG & GIF Dateien sind erlaubt.');
                break;
            case 'upload':
                alert('Fehler beim Hochladen des Bildes. Bitte versuchen Sie es erneut.');
                break;
            case 'nofile':
                alert('Bitte wählen Sie eine Datei zum Hochladen aus.');
                break;
        }
    }

    // Add click handlers for gallery items
    document.querySelectorAll('.gallery-old-item').forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const modal = document.createElement('div');
            modal.className = 'gallery-old-modal';
            modal.style.display = 'flex';
            
            const modalImg = document.createElement('img');
            modalImg.src = img.src;
            
            modal.appendChild(modalImg);
            document.body.appendChild(modal);
            
            modal.addEventListener('click', function() {
                modal.remove();
            });
        });
    });

    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-button');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            const filter = button.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox functionality
    let lightbox = null;

    window.openLightbox = function(imageSrc) {
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <button class="lightbox-close">&times;</button>
                    <img src="" alt="Lightbox Image">
                </div>
            `;
            document.body.appendChild(lightbox);

            // Close lightbox when clicking outside the image
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox || e.target.className === 'lightbox-close') {
                    closeLightbox();
                }
            });

            // Close lightbox with escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            });
        }

        const lightboxImg = lightbox.querySelector('img');
        lightboxImg.src = imageSrc;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (lightbox) {
            lightbox.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    window.closeLightbox = closeLightbox;
}); 