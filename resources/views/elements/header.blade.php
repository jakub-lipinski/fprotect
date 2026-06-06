   <nav class="nav">
       <div class="nav__wrapper">
           <a href="{{route('home')}}">
               <img src="{{ $siteSettings->logoUrl() }}" alt="FPROTECT" class="nav__logo">
           </a>

           <ul class="nav__menu">
               <li class="nav__item">
                   <a href="{{route('home')}}" class="nav__link">Strona główna</a>
               </li>
               <li class="nav__item">
                   <a href="{{route('home')}}#o-nas" class="nav__link nav__link--about">O nas</a>
               </li>
               <li class="nav__item">
                   <a href="{{route('home')}}#uslugi" class="nav__link nav__link--services">Usługi</a>
               </li>
               <li class="nav__item">
                   <a href="{{route('home')}}#realizacje" class="nav__link nav__link--portfolio">Realizacje</a>
               </li>
               <li class="nav__item">
                   <a href="{{route('home')}}#faq" class="nav__link nav__link--faq">FAQ</a>
               </li>
               <li class="nav__item">
                   <a href="{{route('contact')}}" class="nav__link nav__link--last nav__link--contact">Kontakt z
                       nami</a>
               </li>
           </ul>
       </div>
   </nav>

   <nav class="mobile-nav">
       <div class="mobile-nav__wrapper">
           <a href="{{route('home')}}">
               <img src="{{ $siteSettings->logoUrl() }}" alt="FPROTECT" class="mobile-nav__logo">
           </a>
           <div class="mobile-nav__haburger-wrapper">
               <img src="{{asset('img/hamburger.png')}}" alt="" class="mobile-nav__hamburger-icon">
               <img src="{{asset('img/close.png')}}" alt="" class="mobile-nav__close">
           </div>

           <div class="mobile-nav__menu">

               <img src="{{ $siteSettings->logoUrl() }}" alt="FPROTECT"
                   class="mobile-nav__logo mobile-nav__logo--menu">
               <ul class="mobile-nav__menu-wrapper">
                   <li class="mobile-nav__item">
                       <a href="{{route('home')}}" class="mobile-nav__link">Strona główna</a>
                   </li>
                   <li class="mobile-nav__item">
                       <a href="{{route('home')}}#o-nas" class="mobile-nav__link mobile-nav__link--about">O nas</a>
                   </li>
                   <li class="mobile-nav__item">
                       <a href="{{route('home')}}#uslugi" class="mobile-nav__link mobile-nav__link--services">Usługi</a>
                   </li>
                   <li class="mobile-nav__item">
                       <a href="{{route('home')}}#realizacje"
                           class="mobile-nav__link mobile-nav__link--portfolio">Realizacje</a>
                   </li>
                   <li class="mobile-nav__item">
                       <a href="{{route('home')}}#faq" class="mobile-nav__link mobile-nav__link--faq">FAQ</a>
                   </li>
                   <li class="mobile-nav__item">
                       <a href="{{route('contact')}}"
                           class="mobile-nav__link mobile-nav__link--last mobile-nav__link--contact">Kontakt z nami</a>
                   </li>
               </ul>

           </div>
       </div>
   </nav>
