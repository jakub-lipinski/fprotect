@extends('layouts.main')

@php
    $seoMeta = \App\Support\SeoMeta::forContent(
        $service->name,
        $service->excerpt,
        $service->content,
        $service->meta_title,
        $service->meta_description,
        $service->meta_keywords,
    );
@endphp

@section('title', $seoMeta['title'])
@section('meta_description', $seoMeta['description'])
@section('meta_keywords', $seoMeta['keywords'])

@section('content')
@php
    $contactPhone = setting('kontakt.phone');
    $contactEmail = setting('kontakt.email');
    $contactPhoneHref = $contactPhone ? preg_replace('/[^+0-9]/', '', $contactPhone) : null;
@endphp

<div class="subpage">
    <div class="subpage__breadcrumbs">
        <img src="{{asset('img/tlo2.jpg')}}" alt="" class="subpage__breadcrumbs-image">
        <h1 class="subpage__breadcrumbs-title">{{ $service->name }}</h1>
        <div class="subpage__breadcrumbs-links">
            <a href="{{route('home')}}" class="subpage__breadcrumbs-link">Strona główna</a>
            <span class="subpage__breadcrumbs-separator">></span>
            <span class="subpage__breadcrumbs-text">{{ $service->name }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="subpage__path" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z" fill="#fff"></path>
        </svg>
    </div>

    <div class="detail-page detail-page--service">
        <article class="detail-page__main service">
            @if($service->excerpt)
                <p class="detail-page__lead">{{ $service->excerpt }}</p>
            @endif

            <div class="detail-page__content">
                {!! $service->content !!}
            </div>
        </article>

        <aside class="detail-sidebar" aria-label="Informacje uzupełniające">
            @if($otherServices->isNotEmpty())
                <div class="detail-sidebar__box">
                    <h2 class="detail-sidebar__heading">Pozostałe usługi</h2>
                    <ul class="detail-sidebar__list">
                        @foreach($otherServices as $sidebarService)
                            <li class="detail-sidebar__item">
                                <a href="{{ route('service', $sidebarService->slug) }}" class="detail-sidebar__link">
                                    <span>{{ $sidebarService->name }}</span>
                                    <i class="fa-solid fa-arrow-right detail-sidebar__arrow" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="detail-sidebar__box detail-sidebar__box--contact">
                <h2 class="detail-sidebar__heading">Zapytaj o wycenę</h2>
                <p class="detail-sidebar__text">
                    Dobierzemy zakres prac i przygotujemy konkretną propozycję dla Państwa obiektu.
                </p>
                <div class="detail-sidebar__contact-list">
                    @if($contactPhone)
                        <a href="tel:{{ $contactPhoneHref }}" class="detail-sidebar__contact-link">
                            <i class="fa-solid fa-phone" aria-hidden="true"></i>
                            <span>{{ $contactPhone }}</span>
                        </a>
                    @endif
                    @if($contactEmail)
                        <a href="mailto:{{ $contactEmail }}" class="detail-sidebar__contact-link">
                            <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                            <span>{{ $contactEmail }}</span>
                        </a>
                    @endif
                </div>
                <a href="{{ route('contact') }}" class="detail-sidebar__button">Przejdź do kontaktu</a>
            </div>
        </aside>
    </div>
</div>
@endsection
