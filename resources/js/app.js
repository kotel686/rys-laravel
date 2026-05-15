import Alpine from 'alpinejs';
import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail';
import lgZoom from 'lightgallery/plugins/zoom';
import lgVideo from 'lightgallery/plugins/video';

window.Alpine = Alpine;
Alpine.start();

/**
 * Initialise lightGallery on every gallery container on the page.
 *
 * Each container must use anchor (<a>) children whose `href` points at the
 * full-size asset and (optionally) a `data-sub-html` attribute with caption
 * markup. Videos additionally carry `data-video` / `data-poster`.
 */
const initGalleries = () => {
    document.querySelectorAll('[id$="-gallery"]').forEach((el) => {
        if (el.dataset.lgInit === '1') return;
        el.dataset.lgInit = '1';
        lightGallery(el, {
            selector: 'a',
            plugins: [lgThumbnail, lgZoom, lgVideo],
            speed: 400,
            download: false,
            licenseKey: '0000-0000-000-0000',
        });
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGalleries);
} else {
    initGalleries();
}
