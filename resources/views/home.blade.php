@extends('layouts.main')

@section('title', \App\Support\SeoMeta::title('Kompleksowa ochrona przeciwpożarowa'))
@section('meta_description', 'FPROTECT specjalizuje się w ochronie przeciwpożarowej obiektów. Oferujemy usługi kompleksowe, indywidualnie dostosowane do potrzeb klienta.')
@section('meta_keywords', 'ochrona przeciwpożarowa, usługi przeciwpożarowe, zabezpieczenia ppoż, FPROTECT, nadzór przeciwpożarowy, obiekty projektowane, obiekty nowobudowane, obiekty istniejące')

@section('content')
<div class="hero">
    <div class="hero__wrapper">
        <div class="hero__text">
            <h6 class="hero__title">fprotect</h6>
            <h1 class="hero__heading">{{ setting('strona.hero_title') }}</h1>
            <p class="hero__description">{{ setting('strona.hero_text') }}</p>
            <div class="hero__buttons">
                <a class="hero__button hero__button--services">Nasze usługi</a>
                <a class="hero__button hero__button--empty hero__button--contact">Napisz do nas</a>
            </div>

        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="hero__path" viewBox="0 0 1000 100" preserveAspectRatio="none">
        <path d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z" fill="#fff"></path>
    </svg>
</div>

<div id="o-nas" class="section about">
    <div class="about__wrapper">
        <div class="about__text">
            <h2 class="about__subheading section__subheading">o nas</h2>
            <h1 class="section__heading">Twoje Bezpieczeństwo i Ochrona -
                Nasza Misja. <span class="section__underline">Jesteśmy Ekspertami</span>
            </h1>
            <p class="about__description">Jesteśmy firmą wyspecjalizowaną w ochronie przeciwpożarowej obiektów.
                Świadczymy usługi kompleksowe i zawsze indywidualnie dostosowane do Państwa oczekiwań. <b>Naszą domeną
                    są
                    zagadnienia nietypowe, problematyczne, dla których zawsze staramy się znaleźć najlepsze rozwiązanie
                    techniczne, poparte odpowiednią dokumentacją, a co niemniej ważne - możliwe najbardziej korzystne
                    ekonomicznie.</b></p>
            <p class="about__description">Współpracujemy z największymi dostawcami materiałów ogniochronnych, ściśle
                współpracujemy z szeregiem rzeczoznawców ds. zabezpieczeń ppoż., jesteśmy członkami Stowarzyszenia
                Inżynierów i Techników Pożarnictwa.
                Zatrudniamy doświadczoną kadrę inżynieryjno-techniczną, nieustannie pogłębiającą swoją wiedzę dzięki
                specjalistycznym szkoleniom, w których cyklicznie uczestniczymy. Oferujemy pełny nadzór nad ochroną
                przeciwpożarową obiektów projektowanych, nowobudowanych (przed, w trakcie budowy jak i w późniejszej
                eksploatacji) oraz istniejących (również zabytkowych).</p>
            <!-- <a class="about__link" href="#">Dowiedz się więcej</a> -->
        </div>
        <img class="about__image" src="{{asset('img/tlo2.jpg')}}" alt="">
    </div>
</div>

<div id="uslugi" class="section services">
    <div class="services__wrapper">
        <h2 class="section__subheading services__subheading">Usługi</h2>
        <h1 class="section__heading services__subheading">Obszary naszej działalności</h1>
        <div class="services__items">
            @foreach($services as $index => $service)
            <div class="services__item">
                <div class="services__body">
                    <h3 class="services__count">0{{ $index+1 }}</h3>
                    <h3 class="services__title">{{ $service->name }}</h3>
                    <p class="services__description">{{ $service->excerpt }}</p>
                    <a href="{{route('service', $service->slug)}}" class="services__link">Dowiedz się więcej <i
                            class="fa-solid fa-arrow-right services__arrow"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="realizacje" class="section portfolio">
    <div class="swiper portfolio__wrapper">
        <div class="portfolio__intro">
            <div class="portfolio__headings">
                <h2 class="section__subheading portfolio__subheading">realizacje</h2>
                <h1 class="section__heading portfolio__subheading">Kategorie naszych realizacji</h1>
            </div>
        </div>

        <div class="swiper-wrapper portfolio__items">
            @foreach($realizations as $realization)
            <div class="swiper-slide portfolio__item">
                <img src="{{Storage::url($realization->main_image)}}" alt="" class="portfolio__image">
                <div class="portfolio__text">
                    <h3 class="portfolio__name">{{ $realization->name }}</h3>
                    <p class="portfolio__description">{{ $realization->excerpt }}</p>
                    <a href="{{route('realization', $realization->slug)}}" class="portfolio__link">Zobacz realizacje</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination portfolio__pagination"></div>
    </div>
</div>

<div id="faq" class="section faq">
    <div class="faq__wrapper">
        <img class="faq__image" src="{{asset('img/tlo2.jpg')}}" alt="">
        <div class="faq__text">
            <h2 class="section__subheading">faq</h2>
            <h1 class="section__heading">Najczęściej zadawane pytania</h1>
            <div class="faq__questions">
                @foreach($questions as $index => $question)
                <div class="faq__block">
                    <div class="faq__title">
                        <h3 class="faq__question">{{ $question->question }}</h3>
                        <i
                            class="fa-solid fa-arrow-right faq__button {{ $index == 1 ? 'faq__button--active' : '' }} "></i>
                    </div>
                    <p class="faq__answer {{ $index == 1 ? 'faq__answer--active' : '' }}">{{ $question->answer }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="kontakt" class="section contact">
    <div class="contact__wrapper">
        <div class="contact__text">
            <h2 class="section__subheading contact__subheading">kontakt</h2>
            <h1 class="section__heading contact__heading">Napisz do nas. Służymy pomocą!</h1>

            <p class="contact__description">Z przyjemnością odpowiemy na każde Państwa zapytanie, wyliczymy zakres
                robót, opracujemy kalkulację ofertową. Wykonamy to sprawnie, bez zbędnej zwłoki. Podobnie jak każde,
                zlecone nam zadanie.</p>
            <div class="contact__links">
                <a href="mailto:{{ setting('kontakt.email') }}" class="contact__link"><i
                        class="fa-solid fa-envelope contact__icon"></i>
                    {{ setting('kontakt.email') }}</a>
                <a href="tel:{{ setting('kontakt.phone') }}" class="contact__link"><i
                        class="fa-solid fa-phone contact__icon"></i>
                    {{ setting('kontakt.phone') }}</a>
            </div>
        </div>
        <form method="POST" action="{{route('contact.send')}}#kontakt" class="contact__form">
            @csrf

            <div class="contact__input-group">
                <input name="name" type="text" class="contact__input" placeholder="Imię i nazwisko"
                    value="{{old('name')}}">
                @error('name')
                <span class="contact__error">{{ $message }}</span>
                @enderror
            </div>
            <div class="contact__group">
                <div class="contact__input-group">
                    <input name="email" type="email" class="contact__input" placeholder="Adres email"
                        value="{{old('email')}}">
                    @error('email')
                    <span class="contact__error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="contact__input-group">
                    <input name="phone" type="text" class="contact__input" placeholder="Numer telefonu"
                        value="{{old('phone')}}">
                    @error('phone')
                    <span class="contact__error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="contact__input-group">
                <textarea name="message" id="message" class="contact__input contact__input--textarea"
                    placeholder="Treść wiadomości">{{old('message')}}</textarea>
            </div>
            <div class="contact__group contact__group--checkbox">
                <input class="contact__checkbox" type="checkbox" name="privacy_policy">
                <label for="privacy_policy" class="contact__label">Zapoznałem/am się z treścią <a
                        class="contact__privacy-link" target="_blank" href="{{route('privacy')}}">polityki
                        prywatności</a> i
                    wyrażam zgodę na
                    przetwarzanie moich danych osobowych.</label>
            </div>
            @error('privacy_policy')
            <span class="contact__error">{{ $message }}</span>
            @enderror
            <button type="submit" class="contact__button">Wyślij wiadomość</button>
            @if(session('success'))
            <div class="contact__message contact__message--success">
                <p class="contact__message-text contact__message-text--success">{{session('success')}}</p>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<script>
    const swiper = new Swiper(".swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
        },
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    });

</script>
@endsection
