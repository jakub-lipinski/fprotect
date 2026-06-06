// FAQ section
const questions = [...document.querySelectorAll('.faq__title')];
const answers = [...document.querySelectorAll('.faq__answer')];
const arrows = [...document.querySelectorAll('.faq__button')]

questions.forEach((question, i) => {
    question.addEventListener('click', function () {
        answers[i].classList.toggle('faq__answer--active')
        arrows[i].classList.toggle('faq__button--active')
    })
})



// Mobile navigation
const hamburgerBtn = document.querySelector('.mobile-nav__hamburger-icon');
const mobileMenu = document.querySelector('.mobile-nav__menu');
const mobileOptions = [...document.querySelectorAll('.mobile-nav__link')];
const closeBtn = document.querySelector('.mobile-nav__close');


if (hamburgerBtn && mobileMenu && closeBtn) {
    hamburgerBtn.addEventListener('click', function () {
        mobileMenu.classList.toggle('mobile-nav__menu--active');
        closeBtn.classList.toggle('mobile-nav__close--active');
        hamburgerBtn.classList.toggle('mobile-nav__hamburger-icon--hidden');
    });

    closeBtn.addEventListener('click', function () {
        mobileMenu.classList.remove('mobile-nav__menu--active');
        closeBtn.classList.remove('mobile-nav__close--active');
        hamburgerBtn.classList.remove('mobile-nav__hamburger-icon--hidden');
    });
}

mobileOptions.forEach(option => {
    option.addEventListener('click', function () {
        if (!mobileMenu || !closeBtn || !hamburgerBtn) {
            return;
        }

        mobileMenu.classList.remove('mobile-nav__menu--active');
        closeBtn.classList.remove('mobile-nav__close--active');
        hamburgerBtn.classList.remove('mobile-nav__hamburger-icon--hidden');
    });
});


// Hero buttons
const heroServices = document.querySelector('.hero__button--services');
const herContact = document.querySelector('.hero__button--contact');
const servicesSection = document.querySelector('#uslugi');
const contactSection = document.querySelector('#kontakt');

if (heroServices && servicesSection) {
    heroServices.addEventListener('click', function () {
        window.scrollTo({
            top: servicesSection.offsetTop - 100,
            behavior: "smooth"
        });
    });
}

if (herContact && contactSection) {
    herContact.addEventListener('click', function () {
        window.scrollTo({
            top: contactSection.offsetTop - 100,
            behavior: "smooth"
        });
    });
}


// Services section
const services = [...document.querySelectorAll('.services__item')];

if (services.length) {
    const servicesObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('services__item--active');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 1
    });

    services.forEach(service => {
        servicesObserver.observe(service);
    });
}



// Realizations section
const realizations = [...document.querySelectorAll('.portfolio__item')];

if (realizations.length) {
    const realizationsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('portfolio__item--active');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 1
    });

    realizations.forEach(realization => {
        realizationsObserver.observe(realization);
    });
}


// Faq questions
const faqQuestions = [...document.querySelectorAll('.faq__block')];

if (faqQuestions.length) {
    const faqObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('faq__block--active');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 1
    });

    faqQuestions.forEach(question => {
        faqObserver.observe(question);
    });
}


// About section 
const aboutText = document.querySelector('.about__text');
const aboutImage = document.querySelector('.about__image');

if (aboutText && aboutImage) {
    const aboutObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            aboutText.classList.add('about__text--active');
            aboutImage.classList.add('about__image--active');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.5
    });


    aboutObserver.observe(aboutText);
    aboutObserver.observe(aboutImage);
}
