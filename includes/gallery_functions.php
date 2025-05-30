<?php
if (!function_exists('getImagesFromDirectory')) {
    // Function to get images from a directory
    function getImagesFromDirectory($directory) {
        return glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
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
function renderSlideshow($images, $slideClass = "gallery-old-slide", $dotClass = "gallery-old-dot", $slideIndex = "", $title = "") {
    if ($images) {
        if ($title) {
            echo '<h2 class="gallery-old-title">' . htmlspecialchars($title) . '</h2>';
        }
        echo '<div class="gallery-old-slideshow' . ($slideIndex ? ' slideshow' . $slideIndex : '') . '">';
        foreach($images as $index => $image) {
            echo '<div class="' . $slideClass . ' fade">';
            echo '<img src="' . $image . '" alt="Slideshow Image">';
            echo '</div>';
        }
        echo '<a class="gallery-old-prev" onclick="plusSlides(-1, \'' . $slideIndex . '\')">&#10094;</a>';
        echo '<a class="gallery-old-next" onclick="plusSlides(1, \'' . $slideIndex . '\')">&#10095;</a>';
        echo '</div>';

        echo '<div class="gallery-old-dots">';
        foreach($images as $index => $image) {
            echo '<span class="' . $dotClass . '" onclick="currentSlide(' . ($index + 1) . ', \'' . $slideIndex . '\')"></span>';
        }
        echo '</div>';
    }
}

// Function to render fixed gallery
function renderGallery($images, $title = "") {
    if ($images) {
        if ($title) {
            echo '<h3 class="gallery-old-title">' . htmlspecialchars($title) . '</h3>';
        }
        echo '<div class="gallery-old-container">';
        foreach($images as $image) {
            echo '<div class="gallery-old-item">';
            echo '<img src="' . $image . '" alt="Gallery Image" loading="lazy">';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Keine Bilder gefunden.</p>';
    }
}
?> 