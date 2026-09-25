const lightbox = document.querySelector('.lightbox');
const lightboxImage = lightbox.querySelector('.lightbox-image');
const lightboxCaption = lightbox.querySelector('.lightbox-caption');

document.querySelectorAll('.gallery-open').forEach((button) => {
    button.addEventListener('click', () => {
        const image = button.querySelector('img');
        const caption = button.parentElement.querySelector('figcaption');

        lightboxImage.src = image.src;
        lightboxImage.alt = image.alt;
        lightboxCaption.textContent = caption.textContent;
        lightbox.showModal();
    });
});

lightbox.querySelector('.lightbox-close').addEventListener('click', () => lightbox.close());

lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) lightbox.close();
});