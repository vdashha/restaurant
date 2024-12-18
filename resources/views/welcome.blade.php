<!doctype html>
<html lang="ru" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ресторан</title>

    <link rel="canonical" href="https://bootstrap-4.ru/docs/5.3/examples/headers/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <style>
        /* Основной стиль для изображения-заполнителя */
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 4rem; /* Увеличен размер для больших экранов */
            }
        }

        /* Разделитель */
        .b-example-divider {
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, rgba(0, 0, 0, .1), rgba(0, 0, 0, .3)); /* Градиентный разделитель */
            border: none;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        /* Вертикальный разделитель */
        .b-example-vr {
            flex-shrink: 0;
            width: 2px;
            height: 100vh;
            background-color: rgba(0, 0, 0, .15);
        }

        /* Иконки (например, иконки Bootstrap) */
        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        /* Скроллер навигации */
        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
            background-color: rgba(0, 0, 0, .05);
            box-shadow: 0 .5rem .5rem rgba(0, 0, 0, .1); /* Тень для улучшения контраста */
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            font-weight: 600;
        }

        .nav-scroller .nav-link {
            font-size: 1rem;
            padding: 8px 16px;
            color: #555;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .nav-scroller .nav-link:hover {
            color: #fff;
            background-color: #007bff; /* Плавный переход на синий при наведении */
            border-radius: 25px;
        }

        /* Кнопка Primary (удобно для всех кнопок с таким классом) */
        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
            border-radius: 30px; /* Округленные края кнопок */
            transition: all 0.3s ease;
        }

        .btn-bd-primary:hover {
            background-color: #6528e0; /* Изменение фона на более темный при наведении */
        }

        .btn-bd-primary:focus,
        .btn-bd-primary:active {
            box-shadow: 0 0 0 0.2rem rgba(112, 44, 249, 0.5); /* Легкая тень при фокусе */
        }

        /* Toggle для режима темного/светлого оформления */
        .bd-mode-toggle {
            z-index: 1500;
            position: relative;
            padding: 10px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .bd-mode-toggle:hover {
            background-color: #f0f0f0;
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .2);
        }

        /* Фон с мягким и гармоничным градиентом */
        body {
            height: 100vh; /* Задаем высоту на весь экран */
            margin: 0; /* Убираем отступы по умолчанию */
            background: linear-gradient(135deg, #c4d9e4, #d8c9e3, #f5f9fc); /* Мягкий градиент с приглушенными оттенками голубого и лавандового */
            background-size: cover; /* Растягиваем градиент на весь экран */
            background-attachment: fixed; /* Фиксируем фон, чтобы он не сдвигался при прокрутке */
            color: #333;
            font-family: 'Roboto', sans-serif;
        }

        /* Плавный переход для фона */
        body {
            transition: background 0.5s ease;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">


</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="bootstrap" viewBox="0 0 118 94">
        <title>Bootstrap</title>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
    </symbol>
    <symbol id="home" viewBox="0 0 16 16">
        <path
            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
    </symbol>
    <symbol id="speedometer2" viewBox="0 0 16 16">
        <path
            d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd"
              d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
    </symbol>
    <symbol id="table" viewBox="0 0 16 16">
        <path
            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
    <symbol id="grid" viewBox="0 0 16 16">
        <path
            d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
    </symbol>

</svg>

<main>
    <header class="p-3 text-bg-dark mb-4">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Restaurant">
                        <use xlink:href="#bootstrap"/>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('home') }}" class="nav-link px-2 text-secondary">{{__('main.home')}}</a></li>
                    <li><a href="{{ route('categories') }}" class="nav-link px-2 text-secondary">{{__('main.menu')}}</a></li>
                    <li>
                        @auth('client')
                            <a href="{{ route('cart.index') }}" class="nav-link px-2 text-secondary">{{__('main.cast')}}</a>
                        @else
                            <a href="{{ route('client.login.form') }}" class="nav-link px-2 text-secondary"
                               onclick="event.preventDefault(); this.closest('li').querySelector('form').submit();">{{__('main.cast')}}</a>
                            <form action="{{ route('client.login.form') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </li>
                    <li>
                        @auth('client')
                            <a href="{{ route('order.index') }}" class="nav-link px-2 text-secondary">{{__('main.orders')}}</a>
                        @else
                            <a href="{{ route('client.login.form') }}" class="nav-link px-2 text-secondary"
                               onclick="event.preventDefault(); this.closest('li').querySelector('form').submit();">{{__('main.orders')}}</a>
                            <form action="{{ route('client.login.form') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </li>
                </ul>

                <div class="text-end">
                    @auth('client')
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-light me-2">{{__('main.profile')}}</a>
                        <form action="{{ route('client.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning me-3">{{__('main.logout')}}</button>
                        </form>
                    @else
                        <a href="{{ route('client.login.form') }}" class="btn btn-outline-light me-2">{{__('main.login')}}</a>
                        <a href="{{ route('client.signup') }}" class="btn btn-warning me-3">{{__('main.sing_up')}}</a>
                        <!-- Добавили отступ справа -->
                    @endauth
                </div>

                <!-- Language Selection Dropdown -->
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe"></i> <!-- Globe icon from Bootstrap Icons -->
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
{{--                        <li><a class="dropdown-item" href="{{ route('changeLanguage' , 'en') }}">En</a></li>--}}
{{--                        <li><a class="dropdown-item" href="{{ route('changeLanguage', 'ru' )}}">Ru</a></li>--}}
                        <li><a class="dropdown-item" href="{{ route('changeLanguage' , ['locale' => \App\Enums\LanguageEnum::ENGLISH->value]) }}">{{\App\Enums\LanguageEnum::ENGLISH->getLabel()}}</a></li>
                        <li><a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => \App\Enums\LanguageEnum::RUSSIAN->value])}}">{{\App\Enums\LanguageEnum::RUSSIAN->getLabel()}}</a></li>

                    </ul>
                </div>

            </div>
        </div>
    </header>
</main>

@yield('content')

</body>
</html>
