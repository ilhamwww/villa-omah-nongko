import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Lightbox store for gallery
document.addEventListener('alpine:init', () => {
    Alpine.store('lightbox', {
        open: false,
        images: [],
        alts: [],
        index: 0,

        show(images, alts, index) {
            this.images = images;
            this.alts = alts;
            this.index = index;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.open = false;
            document.body.style.overflow = '';
        },
        next() {
            this.index = (this.index + 1) % this.images.length;
        },
        prev() {
            this.index = (this.index - 1 + this.images.length) % this.images.length;
        },
        currentSrc() {
            return this.images[this.index] ?? '';
        },
        currentAlt() {
            return this.alts[this.index] ?? '';
        },
    });
});

// Global helper used by gallery mosaic buttons
window.openLightbox = (images, alts, index) => {
    Alpine.store('lightbox').show(images, alts, index);
};

// Scroll Reveal Observer
document.addEventListener('DOMContentLoaded', () => {
    const initScrollReveal = () => {
        const revealElements = document.querySelectorAll(
            '.reveal, .reveal-fade, .reveal-slide-up, .reveal-scale-up, .reveal-slide-left, .reveal-slide-right'
        );

        if ('IntersectionObserver' in window) {
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px 50px 0px',
                threshold: 0.01
            };

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                        obs.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => {
                observer.observe(el);
            });
        } else {
            // Fallback for older browsers
            revealElements.forEach(el => {
                el.classList.add('reveal-active');
            });
        }
    };

    initScrollReveal();

    // Hook into Livewire or dynamic changes if any
    document.addEventListener('livewire:navigated', () => {
        initScrollReveal();
    });
});

Alpine.start();
