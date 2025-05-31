// Slideshow functionality
let slideIndex = 1;

document.addEventListener('DOMContentLoaded', function() {
    // Finde alle Slideshows
    const slideshows = document.querySelectorAll('.gallery-old-slideshow');
    
    slideshows.forEach((slideshow, idx) => {
        // Hole alle Slides dieser Slideshow
        const slides = slideshow.querySelectorAll('.gallery-old-slide, .gallery-old-slide2');
        if (!slides.length) return;

        // Erstelle Dots Container
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'gallery-old-dots';
        slideshow.after(dotsContainer);

        // Erstelle Dots für jedes Slide
        slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = 'gallery-old-dot';
            if (index === 0) dot.classList.add('active');
            dot.onclick = () => showSlide(slideshow, index);
            dotsContainer.appendChild(dot);
        });

        // Verstecke alle Slides außer dem ersten
        slides.forEach((slide, index) => {
            slide.style.display = index === 0 ? "block" : "none";
        });

        // Funktion zum Anzeigen eines Slides
        function showSlide(slideshow, index) {
            const slides = slideshow.querySelectorAll('.gallery-old-slide, .gallery-old-slide2');
            const dots = dotsContainer.querySelectorAll('.gallery-old-dot');
            
            slides.forEach(slide => slide.style.display = "none");
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].style.display = "block";
            dots[index].classList.add('active');
        }

        // Setup Navigation
        const prev = slideshow.querySelector('.gallery-old-prev');
        const next = slideshow.querySelector('.gallery-old-next');

        if (prev) {
            prev.onclick = () => {
                const currentSlide = slideshow.querySelector('.gallery-old-slide[style*="block"], .gallery-old-slide2[style*="block"]');
                const allSlides = Array.from(slides);
                let currentIndex = allSlides.indexOf(currentSlide);
                const newIndex = currentIndex <= 0 ? allSlides.length - 1 : currentIndex - 1;
                showSlide(slideshow, newIndex);
            };
        }

        if (next) {
            next.onclick = () => {
                const currentSlide = slideshow.querySelector('.gallery-old-slide[style*="block"], .gallery-old-slide2[style*="block"]');
                const allSlides = Array.from(slides);
                let currentIndex = allSlides.indexOf(currentSlide);
                const newIndex = currentIndex >= allSlides.length - 1 ? 0 : currentIndex + 1;
                showSlide(slideshow, newIndex);
            };
        }

        // Auto-Advance für diese Slideshow
        setInterval(() => {
            const currentSlide = slideshow.querySelector('.gallery-old-slide[style*="block"], .gallery-old-slide2[style*="block"]');
            const allSlides = Array.from(slides);
            let currentIndex = allSlides.indexOf(currentSlide);
            const newIndex = currentIndex >= allSlides.length - 1 ? 0 : currentIndex + 1;
            showSlide(slideshow, newIndex);
        }, 5000);
    });
});

// Gallery modal functionality
document.querySelectorAll('.gallery-old-item').forEach(item => {
    item.addEventListener('click', function() {
        const img = this.querySelector('img');
        const modal = document.createElement('div');
        modal.className = 'gallery-old-modal';
        modal.style.display = 'flex';
        
        const modalImg = document.createElement('img');
        modalImg.src = img.src;
        modalImg.style.objectFit = 'contain';
        
        modal.appendChild(modalImg);
        document.body.appendChild(modal);
        
        modal.addEventListener('click', function() {
            modal.remove();
        });
    });
});

// URL parameter handling
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

// Filter functionality
const filterButtons = document.querySelectorAll('.filter-button');
const galleryItems = document.querySelectorAll('.gallery-item');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        filterButtons.forEach(btn => btn.classList.remove('active'));
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

// Modal functionality
function openModal(src) {
    let modal = document.getElementById("imageModal");
    let modalImg = document.getElementById("modalImage");
    if (modal && modalImg) {
        modal.style.display = "block";
        modalImg.src = src;
        modalImg.style.objectFit = 'contain';
    }
}

function closeModal() {
    let modal = document.getElementById("imageModal");
    if (modal) {
        modal.style.display = "none";
    }
} 