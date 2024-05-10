import Swiper from "swiper";
import IMask from "imask";

//toggle mobile menu
function closeMobileMenu() {
    const btn = document.querySelector('.mobile-menu-toggle');
    document.querySelector('.mobile-menu-toggle').classList.toggle('active');
    const menu = document.querySelector('.desktop-header');
    menu.classList.toggle('show');
    document.querySelector('body').classList.toggle('scroll-locked');
}

document.querySelector('.mobile-menu-toggle').onclick = () => {
    closeMobileMenu();
}

const links = document.querySelectorAll('.header-nav-link');
for (let i = 0; i < links.length; i++) {
    links[i].onclick = () => {
        closeMobileMenu();
    }
}

//activities slider
if (window.innerWidth > 1199) {
    const swiper = new Swiper('.activities-slider', {
        slidesPerView: 'auto',
        spaceBetween: 24
    });
}

//phone mask
const element = document.querySelector('.phone-mask');
const maskOptions = {
    mask: '+{7}(000)000-00-00'
};

if (element != null) {
    const mask = IMask(element, maskOptions);
}
