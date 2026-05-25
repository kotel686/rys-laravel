import Alpine from 'alpinejs';
import GLightbox from 'glightbox';
import PhotoSwipeLightbox from 'photoswipe/lightbox';

window.Alpine = Alpine;
Alpine.start();

/**
 * Initialise PhotoSwipe on every container marked with `.pswp-gallery`.
 * Each anchor inside must point at the full-size image and expose
 * `data-pswp-width` / `data-pswp-height` so the lightbox can lay out
 * without first measuring the file.
 */
const initPhotoSwipeGalleries = () => {
    document.querySelectorAll('.pswp-gallery').forEach((container) => {
        if (container.dataset.pswpInit === '1') return;
        container.dataset.pswpInit = '1';

        const lightbox = new PhotoSwipeLightbox({
            gallery: container,
            children: 'a',
            pswpModule: () => import('photoswipe'),
        });
        lightbox.init();
    });
};

/**
 * Initialise GLightbox on every gallery container on the page.
 *
 * Anchors inside the container carry the standard `.glightbox` class plus
 * the `data-gallery` group name, so navigation buttons step through every
 * item (photo or video). Videos additionally use `data-type="video"` and
 * an optional `data-poster`.
 */
const initGalleries = () => {
    document.querySelectorAll('[id$="-gallery"]').forEach((container) => {
        if (container.dataset.lbInit === '1') return;
        container.dataset.lbInit = '1';

        const groupName = container.id;
        container.querySelectorAll('a.glightbox').forEach((anchor) => {
            anchor.dataset.gallery = anchor.dataset.gallery || groupName;
        });

        GLightbox({
            selector: `#${container.id} a.glightbox`,
            touchNavigation: true,
            loop: false,
            autoplayVideos: true,
            videosWidth: '90vw',
        });
    });
};

const initAll = () => {
    initGalleries();
    initPhotoSwipeGalleries();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
} else {
    initAll();
}
