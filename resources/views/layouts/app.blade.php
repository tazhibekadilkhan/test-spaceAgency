<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ordagen</title>
    <link rel="icon" href="/favicon.ico">

    @vite('resources/assets/css/libs.min.css')
    @vite('resources/assets/scss/style.scss')
    @vite('resources/assets/js/libs.min.js')
    @vite('resources/assets/js/app.js')
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="container">
            <div class="mobile-header">
                <a href="/" class="header-logo">
                    <img src="{{ asset('/images/logo/logo.png') }}" alt="">
                </a>
                <button class="btn-plain mobile-menu-toggle">
                    <svg class="header-toggle-burger" width="28" height="29" viewBox="0 0 28 29" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.22656 14.4297H24.6045" stroke="#4F5149" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M4.22656 7.63281H24.6045" stroke="#4F5149" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M4.22656 21.2188H24.6045" stroke="#4F5149" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <svg class="header-toggle-close" width="28" height="28" viewBox="0 0 28 28" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.711 7.63281L7.13281 21.211" stroke="#4F5149" stroke-width="2.26303"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.13281 7.63281L20.711 21.211" stroke="#4F5149" stroke-width="2.26303"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="desktop-header">
                <div class="header-top">
                    <a href="tel:+79999999999" class="header-phone">+ 7 (999) 999 99-99</a>
                    <div class="search-wrapper">
                        <div class="search-form">
                            <input type="text" placeholder="Поиск">
                            <button class="btn-plain search-btn">
                                <svg width="22" height="21" viewBox="0 0 22 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0014 16.2159C8.31532 16.2159 5.32712 13.2277 5.32712 9.54152C5.32712 5.85539 8.31532 2.86719 12.0014 2.86719C15.6876 2.86719 18.6758 5.85539 18.6758 9.54152C18.6758 13.2277 15.6876 16.2159 12.0014 16.2159Z"
                                        stroke="#FEFDFA" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M7.28125 14.2656L3.41967 18.1272" stroke="#FEFDFA" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="header-main">
                    <a href="/" class="header-logo">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="">
                    </a>
                    <ul class="header-nav">
                        @foreach($menus as $menu)
                            <li>
                                <a href="{{ $menu->link }}" class="header-nav-link">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="tel:+79999999999" class="header-phone-sm">+ 7 (999) 999 99-99</a>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="footer" id="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-logo-wrapper">
                    <a href="#" class="footer-logo">
                        <img src="{{ asset('images/logo/footer-logo.png') }}" alt="">
                    </a>
                    <div class="social-nav">
                        <a href="#" class="social-nav-link">
                            <svg width="16" height="27" viewBox="0 0 16 27" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.0077 25.4353V14.2002H13.9687L14.5617 9.82156H10.0076V7.02602C10.0076 5.75832 10.3773 4.89445 12.2868 4.89445L14.722 4.89336V0.9772C14.3008 0.923935 12.8551 0.804688 11.1734 0.804688C7.66215 0.804688 5.25828 2.84517 5.25828 6.59251V9.82156H1.28711V14.2002H5.25828V25.4352H10.0077V25.4353Z"
                                    fill="#80C469"/>
                            </svg>
                        </a>
                        <a href="#" class="social-nav-link">
                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M1.31836 13.12C1.31836 8.20053 1.31836 5.74079 2.49063 3.96911C3.01411 3.17797 3.69164 2.50043 4.48279 1.97696C6.25447 0.804688 8.71421 0.804688 13.6337 0.804688C18.5532 0.804688 21.0129 0.804688 22.7846 1.97696C23.5757 2.50043 24.2533 3.17797 24.7767 3.96911C25.949 5.74079 25.949 8.20053 25.949 13.12C25.949 18.0395 25.949 20.4992 24.7767 22.2709C24.2533 23.0621 23.5757 23.7396 22.7846 24.2631C21.0129 25.4353 18.5532 25.4353 13.6337 25.4353C8.71421 25.4353 6.25447 25.4353 4.48279 24.2631C3.69164 23.7396 3.01411 23.0621 2.49063 22.2709C1.31836 20.4992 1.31836 18.0395 1.31836 13.12ZM20.0093 13.1204C20.0093 16.6416 17.1547 19.4962 13.6335 19.4962C10.1122 19.4962 7.25767 16.6416 7.25767 13.1204C7.25767 9.59914 10.1122 6.7446 13.6335 6.7446C17.1547 6.7446 20.0093 9.59914 20.0093 13.1204ZM13.6335 17.3391C15.9634 17.3391 17.8522 15.4503 17.8522 13.1204C17.8522 10.7905 15.9634 8.9017 13.6335 8.9017C11.3036 8.9017 9.41478 10.7905 9.41478 13.1204C9.41478 15.4503 11.3036 17.3391 13.6335 17.3391ZM20.2611 7.92214C21.0885 7.92214 21.7592 7.25141 21.7592 6.42402C21.7592 5.59663 21.0885 4.92589 20.2611 4.92589C19.4337 4.92589 18.763 5.59663 18.763 6.42402C18.763 7.25141 19.4337 7.92214 20.2611 7.92214Z"
                                      fill="#80C469"/>
                            </svg>
                        </a>
                        <a href="#" class="social-nav-link">
                            <svg width="29" height="21" viewBox="0 0 29 21" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.7057 19.6664L10.1471 19.5625C8.34737 19.5263 6.54315 19.5986 4.77869 19.2236C2.09455 18.6632 1.90439 15.9156 1.70541 13.611C1.43125 10.3709 1.53738 7.072 2.05478 3.85897C2.34686 2.05612 3.49634 0.980347 5.27396 0.863282C11.2747 0.438438 17.3154 0.488786 23.3029 0.686991C23.9353 0.705161 24.572 0.804472 25.1955 0.917514C28.2734 1.46885 28.3484 4.58244 28.548 7.20349C28.7469 9.85159 28.6629 12.5133 28.2826 15.1434C27.9775 17.321 27.3937 19.1471 24.9301 19.3234C21.8434 19.5539 18.8276 19.7395 15.7322 19.6804C15.7323 19.6664 15.7145 19.6664 15.7057 19.6664ZM12.4378 14.1533C14.7639 12.7885 17.0456 11.4464 19.3584 10.0907C17.028 8.72589 14.7506 7.3838 12.4378 6.02813V14.1533Z"
                                    fill="#80C469"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <ul class="footer-nav">
                    @foreach($menus as $menu)
                        <li>
                            <a href="{{ $menu->link }}" class="footer-nav-link">{{ $menu->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="footer-contact">
                    <b>Свяжитесь с нами!</b>
                    <a href="mailto:company@gmail.com" class="footer-contact-link">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.8073 6.86719V15.2005C18.8073 15.7531 18.5878 16.283 18.1971 16.6737C17.8064 17.0644 17.2765 17.2839 16.724 17.2839H4.22396C3.67142 17.2839 3.14152 17.0644 2.75082 16.6737C2.36012 16.283 2.14063 15.7531 2.14062 15.2005V6.86719"
                                stroke="#D4A95A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M18.8073 6.86458C18.8073 6.31205 18.5878 5.78215 18.1971 5.39144C17.8064 5.00074 17.2765 4.78125 16.724 4.78125H4.22396C3.67142 4.78125 3.14152 5.00074 2.75082 5.39144C2.36012 5.78215 2.14063 6.31205 2.14062 6.86458L9.36979 11.3785C9.7009 11.5854 10.0835 11.6951 10.474 11.6951C10.8644 11.6951 11.247 11.5854 11.5781 11.3785L18.8073 6.86458Z"
                                stroke="#D4A95A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>company@gmail.com</span>
                    </a>
                    <a href="tel:+79999999999" class="footer-contact-link">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.7255 17.3002L11.7346 17.3065C12.5217 17.8077 13.4562 18.0253 14.3836 17.9234C15.3111 17.8216 16.176 17.4063 16.8356 16.7463L17.4085 16.1734C17.5355 16.0465 17.6362 15.8958 17.7049 15.73C17.7736 15.5642 17.809 15.3864 17.809 15.2069C17.809 15.0274 17.7736 14.8497 17.7049 14.6839C17.6362 14.5181 17.5355 14.3674 17.4085 14.2405L14.992 11.8258C14.8651 11.6988 14.7144 11.5981 14.5486 11.5294C14.3828 11.4606 14.205 11.4253 14.0255 11.4253C13.846 11.4253 13.6683 11.4606 13.5024 11.5294C13.3366 11.5981 13.1859 11.6988 13.0591 11.8258C12.8028 12.0819 12.4554 12.2258 12.0931 12.2258C11.7308 12.2258 11.3833 12.0819 11.1271 11.8258L7.26314 7.9609C7.00699 7.70467 6.86309 7.35721 6.86309 6.99491C6.86309 6.63261 7.00699 6.28514 7.26314 6.02892C7.3901 5.90203 7.49082 5.75137 7.55954 5.58555C7.62826 5.41972 7.66363 5.24198 7.66363 5.06248C7.66363 4.88297 7.62826 4.70523 7.55954 4.53941C7.49082 4.37358 7.3901 4.22292 7.26314 4.09603L4.84748 1.68129C4.59126 1.42514 4.24379 1.28125 3.88149 1.28125C3.51919 1.28125 3.17173 1.42514 2.9155 1.68129L2.34165 2.25423C1.6818 2.91387 1.26674 3.77889 1.16505 4.70635C1.06336 5.63381 1.28113 6.56822 1.78237 7.35516L1.78783 7.36427C4.43502 11.2809 7.80846 14.6537 11.7255 17.3002V17.3002Z"
                                stroke="#D4A95A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>+ 7 (999) 999 99-99</span>
                    </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="copyright">© 2024 Ассоциация</p>
                <ul class="legal">
                    <li>Все права защищены</li>
                    <li>
                        <a href="#">Политика конфиденциальности</a>
                    </li>
                    <li>
                        <a href="#">Пользовательское соглашение</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
