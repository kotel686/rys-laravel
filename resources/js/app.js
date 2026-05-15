import Alpine from 'alpinejs';
import GLightbox from 'glightbox';

window.Alpine = Alpine;
Alpine.start();

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
            plyr: { css: '', js: '' },
        });
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGalleries);
} else {
    initGalleries();
}
