import "./bootstrap";

import { registerAccessHandler } from './access-handler';

import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

import toastr from "toastr";
import "toastr/build/toastr.min.css";

import AOS from "aos";
import "aos/dist/aos.css";

import Swiper from "swiper";
import { Navigation } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";

import Typed from "typed.js";

import { Chart, registerables } from "chart.js";
import ChartDataLabels from "chartjs-plugin-datalabels";

registerAccessHandler();

// registra tudo do chart.js + o plugin
Chart.register(...registerables, ChartDataLabels);

window.Chart = Chart;

document.addEventListener("DOMContentLoaded", () => {
    initializeAOS();
    initializeScrollByURL();
    initializeTippy();
    initializeToastr();
    initializeLGPDBar();
    watchCNPJInputsToLiveFormat();
    watchCPFInputsToLiveFormat();

    const body = document.querySelector("body");

    window.body = body;
    window.scrollToY = scrollToY;

    // Site
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

function initializeToastr() {
    // Toast
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-bottom-right",
        timeOut: "3000",
    };

    if (typeof Livewire !== "undefined") {
        Livewire.on("alert:success", (data) => {
            toastr.success(data);
        });

        Livewire.on("alert:danger", (data) => {
            toastr.error(data);
        });

        Livewire.on("alert:info", (data) => {
            toastr.info(data);
        });
    }
}

function initializeLGPDBar() {
    const LGPDBar = document.querySelector('[data-role="lgpd-bar"]');

    if (!LGPDBar) {
        return;
    }

    const LGPDAcceptButton = LGPDBar.querySelector("button");

    if (!getCookie("lgpd_consent")) {
        LGPDBar.style.display = "flex";
    }

    if (LGPDAcceptButton) {
        LGPDAcceptButton.addEventListener("click", () => {
            setCookie("lgpd_consent", "1", 30);
            LGPDBar.style.display = "none";
        });
    }
}

function watchCPFInputsToLiveFormat() {
    const cpfInput = document.querySelector('[name="cpf"]');
    if (cpfInput) {
        cpfInput.addEventListener("input", function (e) {
            e.target.value = formatCPF(e.target.value);
        });
    }

    function formatCPF(cpf) {
        cpf = cpf.replace(/\D/g, "");

        cpf = cpf.substring(0, 11);

        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        return cpf;
    }
}

function watchCNPJInputsToLiveFormat() {
    const cnpjInput = document.querySelector('[name="cnpj"]');
    if (cnpjInput) {
        cnpjInput.addEventListener("input", function (e) {
            e.target.value = formatCNPJ(e.target.value);
        });
    }

    // Format CNPJ
    function formatCNPJ(cnpj) {
        cnpj = cnpj.replace(/\D/g, "");

        cnpj = cnpj.substring(0, 14);

        cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
        cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
        cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");

        return cnpj;
    }
}

function getCookie(name) {
    const match = document.cookie.match(
        new RegExp("(^| )" + name + "=([^;]+)")
    );
    return match ? match[2] : null;
}

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    const expires = "expires=" + date.toUTCString();
    document.cookie =
        name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
}

// Site

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

        registerDropdown.classList.remove("hidden");
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

        loginDropdown.classList.remove("hidden");
    }
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

    if (!sliderContainer) return;

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
            slide.querySelector("button")
                .classList.remove("!bg-primary-solid");

            slide.querySelector("span")
                .classList.remove("!text-main-background");
        });

        activeSlide.querySelector("button")
            .classList.add("!bg-primary-solid");

        activeSlide.querySelector("span")
            .classList.add("!text-main-background");
    }

    // Inicializa
    setActiveVideo(slides[0].dataset.video, slides[0]);

    slides.forEach((slide, index) => {
        slide.addEventListener("click", () => {
            swiper.slideToLoop(index);
            setActiveVideo(slide.dataset.video, slide);
        });
    });

    swiper.on("slideChange", () => {
        const activeSlide = slides[swiper.realIndex];
        setActiveVideo(activeSlide.dataset.video, activeSlide);
    });

    // Clique no preview → abre modal
    document
        .getElementById("hero-video-click")
        .addEventListener("click", () => {
            Livewire.dispatch("openHeroVideoModal", {
                video: videoPlayer.src,
            });
        });

    window.addEventListener("resize", () => {
        swiper.allowTouchMove = window.innerWidth < 640;
    });
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

function initializeScrollByURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const section = urlParams.get('scroll');

    if (section) {
        const el = document.getElementById(section);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth' });
        }
    }
}
