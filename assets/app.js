/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// start the Stimulus application
import './bootstrap';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.drop-container');
const links = document.querySelectorAll('.drop-links li');

hamburger.addEventListener('click', () => {
    // Animate Links
    navLinks.classList.toggle('open');
    links.forEach(link => {
        link.classList.toggle('fade');
    });

    // Hamburger Animation
    hamburger.classList.toggle('toggle');
});
