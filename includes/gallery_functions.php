<?php
if (!function_exists('getImagesFromDirectory')) {
    // Function to get images from a directory
    function getImagesFromDirectory($directory) {
        $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        // Sort images by name
        sort($images);
        return $images;
    }
}

if (!function_exists('get_category_filters')) {
    // Function to get gallery categories
    function get_category_filters() {
        $categories = [
            'events' => 'Events',
            'workshops' => 'Workshops',
            'meetings' => 'Treffen'
        ];
        
        $output = '';
        foreach ($categories as $key => $label) {
            $output .= sprintf(
                '<button class="filter-button" data-filter="%s">%s</button>',
                htmlspecialchars($key),
                htmlspecialchars($label)
            );
        }
        return $output;
    }
}

if (!function_exists('get_gallery_images')) {
    // Function to get gallery images with their categories
    function get_gallery_images() {
        $gallery_dir = 'Site/gallery-images/';
        $images = getImagesFromDirectory($gallery_dir);
        
        if (empty($images)) {
            return '<p class="no-images">Keine Bilder gefunden.</p>';
        }
        
        $output = '';
        foreach ($images as $image) {
            // Get random category for demo purposes
            // In production, you would get this from a database or image metadata
            $categories = ['events', 'workshops', 'meetings'];
            $category = $categories[array_rand($categories)];
            
            $output .= sprintf(
                '<div class="gallery-item" data-category="%s">
                    <img src="%s" alt="Gallery Image" loading="lazy">
                    <div class="gallery-item-overlay">
                        <span class="gallery-item-category">%s</span>
                        <button class="gallery-item-zoom" onclick="openLightbox(\'%s\')">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </button>
                    </div>
                </div>',
                htmlspecialchars($category),
                htmlspecialchars($image),
                htmlspecialchars(ucfirst($category)),
                htmlspecialchars($image)
            );
        }
        
        return $output;
    }
}

// Function to render slideshow
function renderSlideshow($images, $slideClass = "gallery-old-slide", $dotClass = "gallery-old-dot", $slideIndex = "") {
    if ($images) {
        echo '<div class="gallery-old-slideshow' . ($slideIndex ? ' slideshow' . $slideIndex : '') . '">';
        
        // Render slides
        foreach($images as $index => $image) {
            echo '<div class="' . $slideClass . '">';
            echo '<img src="' . $image . '" alt="Slideshow Image">';
            echo '</div>';
        }
        
        // Navigation arrows
        echo '<a class="gallery-old-prev" onclick="plusSlides(-1, \'' . $slideIndex . '\')">&#10094;</a>';
        echo '<a class="gallery-old-next" onclick="plusSlides(1, \'' . $slideIndex . '\')">&#10095;</a>';
        
        // Dots container
        echo '<div class="gallery-old-dots">';
        foreach($images as $index => $image) {
            echo '<span class="' . $dotClass . '" onclick="currentSlide(' . ($index + 1) . ', \'' . $slideIndex . '\')"></span>';
        }
        echo '</div>';
        
        echo '</div>';
    }
}

// Function to render fixed gallery
function renderGallery($images) {
    if ($images) {
        echo '<div class="gallery-grid">';
        foreach($images as $image) {
            echo '<div class="gallery-item">';
            echo '<img src="' . $image . '" alt="Gallery Image" loading="lazy" onclick="openModal(this.src)">';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Keine Bilder gefunden.</p>';
    }
}

// Function to get all galleries from filesystem
function getGalleryFolders() {
    $baseDir = 'Site/gallery-images/';
    $galleries = [];
    
    // Get all gallery folders
    $galleryFolders = array_filter(glob($baseDir . '*'), 'is_dir');
    
    // Sort folders by creation time, oldest first
    usort($galleryFolders, function($a, $b) {
        return filemtime($a) - filemtime($b);
    });
    
    foreach ($galleryFolders as $folder) {
        $folderName = basename($folder);
        
        // Skip special folders
        if ($folderName === 'slideshow' || $folderName === 'fixed') {
            continue;
        }
        
        // Get slideshow and fixed images
        $slideshowDir = $folder . '/slideshow/';
        $fixedDir = $folder . '/fixed/';
        
        // Create directories if they don't exist
        if (!file_exists($slideshowDir)) {
            mkdir($slideshowDir, 0777, true);
        }
        if (!file_exists($fixedDir)) {
            mkdir($fixedDir, 0777, true);
        }
        
        $slideshowImages = getImagesFromDirectory($slideshowDir);
        $fixedImages = getImagesFromDirectory($fixedDir);
        
        // Only add gallery if it has any images
        if (!empty($slideshowImages) || !empty($fixedImages)) {
            $galleries[$folderName] = [
                'name' => ucwords(str_replace('-', ' ', $folderName)),
                'slideshow' => $slideshowImages,
                'fixed' => $fixedImages,
                'created' => filemtime($folder)
            ];
        }
    }
    
    return $galleries;
}

// Function to create a new gallery folder
function createGalleryFolder($folderName) {
    $baseDir = 'Site/gallery-images/';
    $folderPath = $baseDir . sanitizeFolderName($folderName);
    
    if (!file_exists($folderPath)) {
        return mkdir($folderPath, 0777, true);
    }
    return false;
}

// Function to sanitize folder names
function sanitizeFolderName($name) {
    // Remove special characters and convert spaces to dashes
    $name = preg_replace('/[^a-zA-Z0-9\s-]/', '', $name);
    $name = strtolower(trim($name));
    $name = preg_replace('/[\s-]+/', '-', $name);
    return $name;
}

// Function to render dynamic galleries
function renderDynamicGalleries() {
    $galleries = getGalleryFolders();
    
    if (empty($galleries)) {
        echo '<p class="no-galleries">Keine Galerien gefunden.</p>';
        return;
    }
    
    // Sortiere die Galerien nach Erstellungsdatum, älteste zuerst
    uasort($galleries, function($a, $b) {
        return $a['created'] - $b['created'];
    });
    
    foreach ($galleries as $folderName => $gallery) {
        echo '<div class="gallery-section" id="gallery-' . htmlspecialchars($folderName) . '">';
        echo '<h2 class="gallery-title">' . htmlspecialchars($gallery['name']) . '</h2>';
        
        // Render slideshow if there are slideshow images
        if (!empty($gallery['slideshow'])) {
            renderSlideshow($gallery['slideshow'], "gallery-old-slide", "gallery-old-dot", "");
        }
        
        // Render fixed gallery if there are fixed images
        if (!empty($gallery['fixed'])) {
            echo '<div class="fixed-gallery-container">';
            renderGallery($gallery['fixed']);
            echo '</div>';
        }
        
        echo '</div>';
    }
}

// Function to handle new gallery creation form
function renderGalleryCreationForm() {
    echo '<div class="create-gallery-section">';
    echo '<h2>Neue Galerie erstellen</h2>';
    echo '<form action="create_gallery.php" method="post" class="create-gallery-form">';
    echo '<div class="form-group">';
    echo '<label for="gallery-name">Galerie Name:</label>';
    echo '<input type="text" id="gallery-name" name="gallery-name" required>';
    echo '</div>';
    echo '<button type="submit" class="create-gallery-button">Galerie erstellen</button>';
    echo '</form>';
    echo '</div>';
}

// Function to get a random slideshow image for hero section
function getRandomHeroImage() {
    $baseDir = 'Site/gallery-images/';
    $galleries = array_filter(glob($baseDir . '*'), 'is_dir');
    $allSlideshowImages = [];
    
    foreach ($galleries as $gallery) {
        $slideshowDir = $gallery . '/slideshow/';
        if (file_exists($slideshowDir)) {
            $images = getImagesFromDirectory($slideshowDir);
            $allSlideshowImages = array_merge($allSlideshowImages, $images);
        }
    }
    
    if (!empty($allSlideshowImages)) {
        return $allSlideshowImages[array_rand($allSlideshowImages)];
    }
    
    // Fallback image if no slideshow images found
    return 'Site/gallery-images/hero.jpg';
}

// Add modal for image viewing
echo '<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>';
?> 

