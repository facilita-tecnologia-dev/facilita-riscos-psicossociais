import "./bootstrap";

import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

import AOS from "aos";
import "aos/dist/aos.css";

import Swiper from "swiper";
import { Navigation } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";

import Typed from "typed.js";

document.addEventListener("DOMContentLoaded", () => {
    initializeAOS();
    initializeTippy();
    window.scrollToY = scrollToY;

    animateString("animated-title", [
        `Gestão de Riscos <span class="text-primary-solid">eficiente</span>.`,
        `Gestão de Riscos <span class="text-primary-solid">confiável</span>.`,
        `Gestão de Riscos <span class="text-primary-solid">transparente</span>.`,
        `Gestão de Riscos <span class="text-primary-solid">segura</span>.`,
    ]);

    heroSectionSwiper();
    ourMetodolodySwiper();
});

function initializeAOS() {
    AOS.init({ once: true });
}

function initializeTippy() {
    tippy("[data-tippy-content]", {
        theme: "custom",
        arrow: true,
        animation: "fade",
    });

    initalizeDropdowns();
}

function initalizeDropdowns() {
    const register = document.getElementById("button-register");
    const registerDropdown = document.getElementById("dropdown-register");

    if (register && registerDropdown) {
        tippy(register, {
            content: registerDropdown, // Elemento dropdown
            allowHTML: true, // Permite usar HTML
            interactive: true, // Permite clicar dentro do dropdown
            trigger: "click", // Abre ao clicar
            placement: "bottom-end", // Posiciona abaixo do botão
            hideOnClick: true, // Fecha ao clicar fora
        });
    }

    const loginButton = document.getElementById("button-login");
    const loginDropdown = document.getElementById("dropdown-login");

    if (loginButton && loginDropdown) {
        tippy(loginButton, {
            content: loginDropdown, // Elemento dropdown
            allowHTML: true, // Permite usar HTML
            interactive: true, // Permite clicar dentro do dropdown
            trigger: "click", // Abre ao clicar
            placement: "bottom-end", // Posiciona abaixo do botão
            hideOnClick: true, // Fecha ao clicar fora
        });
    }

    loginDropdown.classList.remove("hidden");
    registerDropdown.classList.remove("hidden");
}

function animateString(id, strings = []) {
    const string = document.getElementById(id);

    if (string) {
        new Typed(string, {
            strings: strings,
            typeSpeed: 50,
            backSpeed: 50,
        });
    }
}

function scrollToY(event, id, offset = 0) {
    event.preventDefault();

    const element = document.getElementById(id);
    if (!element) return;

    const y = element.getBoundingClientRect().top + window.pageYOffset - offset;

    window.scrollTo({
        top: y,
        behavior: "smooth",
    });
}

function heroSectionSwiper() {
    const sliderContainer = document.querySelector(".hero-section-swiper");

    if (sliderContainer) {
        const videoPlayer = document.getElementById(
            "hero-section-video-canvas"
        );
        const slides = sliderContainer.querySelectorAll(".swiper-slide");

        const swiper = new Swiper(sliderContainer, {
            modules: [Navigation],
            slidesPerView: "auto",
            spaceBetween: 8,
            loop: true,
            allowTouchMove: window.innerWidth < 640,
            navigation: {
                nextEl: ".custom-next",
                prevEl: ".custom-prev",
            },
        });

        function setActiveVideo(videoSrc, activeSlide) {
            videoPlayer.src = videoSrc;

            slides.forEach((slide) => {
                const btn = slide.querySelector("button");
                const span = slide.querySelector("span");
                btn.classList.remove("!bg-primary-solid");
                span.classList.remove("!text-main-background");
            });

            const activeBtn = activeSlide.querySelector("button");
            const activeSpan = activeSlide.querySelector("span");

            activeBtn.classList.add("!bg-primary-solid");
            activeSpan.classList.add("!text-main-background");
        }

        // Inicializa o primeiro GIF
        setActiveVideo(slides[0].dataset.video, slides[0]);

        // Clique nos slides
        slides.forEach((slide, index) => {
            slide.addEventListener("click", () => {
                swiper.slideToLoop(index);
                setActiveVideo(slide.dataset.video, slide);
            });
        });

        // Atualiza o vídeo ao mudar o slide via navegação
        swiper.on("slideChange", () => {
            const activeSlide = slides[swiper.realIndex];
            setActiveVideo(activeSlide.dataset.video, activeSlide);
        });

        window.addEventListener("resize", () => {
            swiper.allowTouchMove = window.innerWidth < 640;
        });
    }
}

function ourMetodolodySwiper() {
    const sliderContainer = document.querySelector(".our-metodology-swiper");

    if (sliderContainer) {
        const swiper = new Swiper(sliderContainer, {
            slidesPerView: "auto",
            spaceBetween: 32,
            allowTouchMove: true,
        });
    }
}
