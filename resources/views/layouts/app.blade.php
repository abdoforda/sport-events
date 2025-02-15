<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title -->
    <title>@yield('title', 'موقع نادي النيابة العامة')</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/logo.png') }}">
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/logo.png') }}">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo.png') }}">
    
    <link rel="manifest" href="{{ asset('assets/favicons/manifest.json') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    
    <!-- SlickNav CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    
    <!-- Magnific popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    
    <!-- Scroll CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.min.css') }}">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

</head>
<body class="ar-normal">

    
    <!-- Header Area Start -->
    <section class="kick-header-area">
        <div class="header-top-area">
            <div class="header-top-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <a href="https://agleague2024.com/" target="_blank" class="color-primary">
                            موقع الحدس الكروي
                        </a>
                    </div>
                    <div class="col-sm-7">
                        <div class="header-top-right rtl">

                            @auth
                            <div class="profile-a">
                                <a>
                                    <i class="fa fa-user"></i>
                                    <span class="updateName">{{ auth()->user()->name }}</span>
                                    <i class="fa fa-angle-down" style="
                                    margin: 0 6px;
                                "></i>
                                </a>
                                <ul>
                                    <li><a href="/profile">الحساب</a></li>
                                    <li><a href="/my_events">الفعاليات</a></li>
                                    <li><a href="/my_rentals">الحجوزات</a></li>
                                </ul>
                            </div>
                            
                            
                            
                            <a href="{{ Route('logout') }}">
                                
                                تسجيل الخروج
                                <i class="fa fa-sign-in" style="margin-right: 2px; transform: rotate(180deg);"></i>
                            </a>
                            @else
                            <a href="{{ Route('register') }}">
                                <i class="fa fa-user-plus"></i>
                                تسجيل
                            </a>
                            
                            <a href="{{ Route('login') }}">
                                <i class="fa fa-sign-in"></i>
                                دخول الأعضاء
                            </a>
                            @endauth

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mainmenu-area">
            <div class="container">
                <div class="kick-desktop-menu">
                    <div class="row">
                        <div class="col-md-12 rtl">
                            <div class="mainmenu-left second-menu">
                                <nav>
                                    <ul id="navigation_menu_2">
                                        <li>
                                            <a href="/events">فعاليات رياضية</a>
                                            <ul>
                                                <li><a href="{{ route('event.index') }}">الفعاليات</a></li>
                                                <li><a href="{{ route('event.archive') }}">الأرشيف</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="##############">تأجير الملاعب</a>
                                            <ul>
                                                @php
                                                $take = 2;
                                                if (auth()->check() && auth()->user()->type == 'employee') {
                                                    $take = 3;
                                                }
                                                $rentals_type = \App\RentalType::take($take)->get();
                                            @endphp
                                                @foreach ($rentals_type as $item)
                                                    <li><a href="{{ route('rentalType.show', $item->id) }}">{{ $item->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('news.index') }}">أخر الأخبار</a>
                                        </li>
                                        <li>
                                            <a href="{{ Route('gallery.index') }}">مكتبة الصور</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            
                            <div class="kick-site-logo">
                                <div class="responsive-menu-2"></div>
                                <a href="/" class="kick-site-logo">
                                    <img loading="lazy"src="{{ asset('assets/img/logo.png') }}" alt="site logo" />
                                </a>
                                <div class="responsive-menu-1"></div>
                            </div>
                            <div class="mainmenu-left pull-left">
                                <nav>
                                    <ul id="navigation_menu">
                                        {{-- class="current-page-item" --}}
                                        <li  >
                                            <a href="{{ Route('pages.show', 1) }}">القواعد</a>
                                        </li>
                                        <li>
                                            <a href="{{ Route('pages.show', 2) }}">الاستفسار والتواصل</a>
                                        </li>
                                        <li>
                                            <a href="#">منطقة النصائح</a>
                                            <ul>
                                                <li><a href="{{ Route('cat.index', 2) }}">نصائح رياضية</a></li>
                                                <li><a href="{{ Route('cat.index', 3) }}">نصائح ⁠غذائية</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ asset('player.html') }}">أخري</a>
                                            @php
                                                $otherPages = \App\Page::where('id', '>=', 7)->get();
                                            @endphp
                                            @if (count($otherPages) > 0)
                                            <ul>
                                                @foreach ($otherPages as $op)
                                                <li><a href="{{ route('pages.show', $op->id) }}">{{ $op->title }}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        <li class="mobileO">
                                            <a href="https://agleague2024.com/">موقع الحدس الكروي</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Area End -->
    
    @yield('content')
    
    <!-- Footer Area Start -->
    <footer class="kick-footer-area rtl">
        <div class="kick-top-footer-area section_50">
            <div class="container">
                <div class="row rtl">
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>من نحن </h3>
                            <p class="text-justify">
                                {{ setting('site.descFooter') }}
                            </p>
                            <ul class="single-footer-address">
                                <li>
                                    <div class="add-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <p> {{ setting('site.address') }} </p>
                                </li>
                                <li>
                                    <div class="add-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <p><a href="mailto:{{ setting('site.email') }}">{{ setting('site.email') }}</a></p>
                                </li>
                                <li>
                                    <div class="add-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <p><a href="tel:{{ setting('site.phone') }}">{{ setting('site.phone') }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>روابط مفيدة</h3>
                            <ul class="single-footer-link">
                                <li>
                                    <a href="/">
                                        <i class="fa fa-chevron-right"></i>
                                        الرئيسية
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Route('pages.show', 5) }}">
                                        <i class="fa fa-chevron-right"></i>
                                        من نحن
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/2">
                                        <i class="fa fa-chevron-right"></i>
                                        تواصل معنا
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Route('pages.show', 1) }}">
                                        <i class="fa fa-chevron-right"></i>
                                        القواعد والشروط
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Route('news.index') }}">
                                        <i class="fa fa-chevron-right"></i>
                                        آخر الأخبار
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Route('pages.show', 6) }}">
                                        <i class="fa fa-chevron-right"></i>
                                        سياسة الإستخدام
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>آخر الفعاليات</h3>
                            <ul class="single-footer-post">

                                @php
                                    $eventsFooter = \App\Event::where('status', 1)->orderBy('id', 'desc')->take(3)->get();
                                @endphp

                                @foreach ($eventsFooter as $ev)
                                <li>
                                    <a href="{{ route('event.show', $ev->id) }}" class="single-event-footer">
                                        <div class="footer-post-img">
                                            <img loading="lazy"src="{{ Voyager::image($ev->image) }}" alt="footer-post" />
                                        </div>
                                        <div class="footer-post-text">
                                            <p>{{ $ev->title }}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>اتصل بنا</h3>
                            <p>
                                {{ setting('site.descContact') }}
                            </p>
                            {{-- <ul class="single-footer-social">
                                <li>
                                    <a href="{{ asset('index.html#') }}" class="fb"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="{{ asset('index.html#') }}" class="twit"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="{{ asset('index.html#') }}" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="{{ asset('index.html#') }}" class="google"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                   <a href="{{ asset('index.html#') }}" class="skype"><i class="fa fa-skype"></i></a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kick-footer-bottom section_15">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p class="desktop">
                                <a href="/">dxbppsport</a>           حقوق الملكية © 2025 
                            </p>
                            <p class="mobile">
                                <a href="/">dxbppsport</a>     حقوق الملكية © 2025 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->


    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    
    <!-- Magnific Popup JS -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    
    <!-- OwlCarousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    
    <!-- SlickNav JS -->
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
    
    <!-- Scrollbar JS -->
    <script src="{{ asset('assets/js/jquery-perfect-scrollbar.min.js') }}"></script>
    
    <!-- Countdown JS -->
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    
    <!-- Progressbar JS -->
    <script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
    
    <!-- Isotop JS -->
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/custom-isotop.js') }}"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/ajax.form.js') }}"></script>

    @yield('scripts')
</body>
</html>