<div class="footer">
    <div class="footer__wrapper">
        <div class="footer__column footer__column--brand">
            <img src="{{ $siteSettings->logoUrl() }}" alt="FPROTECT" class="footer__logo">
            <p class="footer__text">{{ $siteSettings->footerText }}</p>
        </div>
        <div class="footer__column footer__column--menu">
            <h4 class="footer__heading">Szybki Dostęp</h4>
            <ul class="footer__list">
                <li class="footer__item">
                    <a href="{{route('home')}}" class="footer__link">Strona główna</a>
                </li>
                <li class="footer__item">
                    <a href="{{route('home')}}#o-nas" class="footer__link">O nas</a>
                </li>
                <li class="footer__item">
                    <a href="{{route('home')}}#uslugi" class="footer__link">Usługi</a>
                </li>
                <li class="footer__item">
                    <a href="{{route('home')}}#realizacje" class="footer__link">Realizacje</a>
                </li>
                <li class="footer__item">
                    <a href="{{route('home')}}#faq" class="footer__link">FAQ</a>
                </li>
                <li class="footer__item">
                    <a href="{{route('contact')}}" class="footer__link">Kontakt</a>
                </li>
            </ul>
        </div>
        <div class="footer__column footer__column--services">
            <h4 class="footer__heading">Usługi</h4>
            <ul class="footer__list">
                @forelse($footerServices as $footerService)
                    <li class="footer__item">
                        <a href="{{ route('service', $footerService->slug) }}" class="footer__link">{{ $footerService->footer_name }}</a>
                    </li>
                @empty
                    <li class="footer__item">
                        <a href="{{route('home')}}#uslugi" class="footer__link">Zobacz usługi</a>
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
    <div class="footer__bottom">
        <span class="footer__copyright">&copy; FPROTECT {{ now()->year }} - Wszelkie prawa zastrzeżone. Projekt i realizacja: <a
                class="footer__author" target="_blank" href="https://webcrafts.pl">Webcrafts.pl</a></span>
        <a href="{{route('privacy')}}" target="_blank" class="footer__privacy">Polityka prywatności</a>
    </div>
</div>
