@extends('layouts.main')
@section('title', \App\Support\SeoMeta::title('Kontakt'))
@section('meta_description', 'Skontaktuj się z FPROTECT. Odpowiemy na zapytanie, wyliczymy zakres robót i opracujemy kalkulację ofertową.')
@section('meta_keywords', 'kontakt FPROTECT, FPROTECT Cieszyn, ochrona przeciwpożarowa kontakt, kalkulacja ofertowa, wycena robót, ul. Stawowa 71 Cieszyn')

@section('content')

<div class="subpage">
    <div class="subpage__breadcrumbs">
        <img src="{{asset('img/tlo2.jpg')}}" alt="" class="subpage__breadcrumbs-image">
        <h1 class="subpage__breadcrumbs-title">Kontakt</h1>
        <div class="subpage__breadcrumbs-links">
            <a href="{{route('home')}}" class="subpage__breadcrumbs-link">Strona główna</a>
            <span class="subpage__breadcrumbs-separator">></span>
            <span class="subpage__breadcrumbs-text">Kontakt</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="subpage__path" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z" fill="#fff"></path>
        </svg>
    </div>

    <div class="contact-page">
        <div class="contact-page__wrapper">
            <div class="contact-page__top">
                <div class="contact-page__text">
                    <h2 class="contact-page__subtitle">Kontakt z nami</h2>
                    <h2 class="contact-page__title">Napisz do nas. Służymy pomocą!</h2>
                    <p class="contact-page__description">Z przyjemnością odpowiemy na każde Państwa zapytanie, wyliczymy
                        zakres robót, opracujemy kalkulację ofertową. Wykonamy to sprawnie, bez zbędnej zwłoki. Podobnie
                        jak każde, zlecone nam zadanie.</p>
                    <div class="contact-page__list">
                        <div class="contact-page__item">
                            <div class="contact-page__image contact-page__image--red">
                                <img src="{{asset('img/location-white.png')}}" alt="" class="contact-page__icon">
                            </div>
                            <div class="contact-page__item-text">
                                <h3 class="contact-page__item-title">Adres</h3>
                                <p class="contact-page__item-description">ul. Stawowa 71, 43-400 Cieszyn</p>
                            </div>
                        </div>

                        <div class="contact-page__item">
                            <div class="contact-page__image contact-page__image--dark">
                                <img src="{{asset('img/phone-white.png')}}" alt="" class="contact-page__icon">
                            </div>
                            <div class="contact-page__item-text">
                                <h3 class="contact-page__item-title">Telefon</h3>
                                <p class="contact-page__item-description"><a class="contact-page__link"
                                        href="tel:{{ setting('kontakt.phone') }}">{{ setting('kontakt.phone') }}</a> |
                                    <a class="contact-page__link"
                                        href="tel:{{ setting('kontakt.phone2') }}">{{ setting('kontakt.phone2') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-page__item">
                            <div class="contact-page__image contact-page__image">
                                <img src="{{asset('img/mail-red.png')}}" alt="" class="contact-page__icon">
                            </div>
                            <div class="contact-page__item-text">
                                <h3 class="contact-page__item-title">Adres email</h3>
                                <p class="contact-page__item-description"><a class="contact-page__link"
                                        href="mailto:{{ setting('kontakt.email') }}">{{ setting('kontakt.email') }}</a>
                                    | <a class="contact-page__link"
                                        href="mailto:{{ setting('kontakt.email2') }}">{{ setting('kontakt.email2') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="kontakt" method="POST" action="{{route('contact.send')}}#kontakt" class="contact__form">
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
            <div class="contact-page__bottom">
                <iframe class="contact-page__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2577.7612484668975!2d18.65388747739989!3d49.75293593733945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4714038ce5a39411%3A0x54931494fd2f47a6!2sStawowa%2071%2C%2043-400%20Cieszyn!5e0!3m2!1spl!2spl!4v1710971129739!5m2!1spl!2spl"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

</div>

@endsection
