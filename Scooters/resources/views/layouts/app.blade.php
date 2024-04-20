<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ '/css/navbar.css' }}" rel="stylesheet"/>
    <link href="{{'/css/dropdown.css' }}" rel="stylesheet"/>
    <link href="{{'/css/themes.css' }}" rel="stylesheet"/>
    <link href="{{ asset('../public/css/themes.css') }}" rel="stylesheet"/>
    <link href="{{ asset('../public/css/navbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('../public/css/dropdown.css') }}" rel="stylesheet"/>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        // Immediately invoked function to set the theme on initial load
        (function () {
            if (localStorage.getItem('theme') === 'theme-dark') {
                setTheme('theme-dark');
            } else {
                setTheme('theme-light');
            }
        })();

        // function to set a given theme/color-scheme
        function setTheme(themeName) {
            localStorage.setItem('theme', themeName);
            document.documentElement.className = themeName;
        }

        // function to toggle between light and dark theme
        function toggleTheme() {
            if (localStorage.getItem('theme') === 'theme-dark') {
                setTheme('theme-light');
            } else {
                setTheme('theme-dark');
            }
        }

    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pl.js"></script>

</head>
<body class="bg-gray-100">
<div class="sidebar">
    <div class="logo-details">
        <i class='bx bx-menu'></i>
        <span class="logo_name">Hulajnogi</span>
    </div>
    <div class="pt-12">
    <ul class="nav-links">
        <li>
            <a href="{{ route('placowki.index') }}">
                <i class="bx bx-home"></i>
                <span class="link_name">Placowki</span>
            </a>
        </li>
        @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
        <li>
            <div class="iocn-link">
                <a href="#{{--{{ route('users.index') }}--}}">
                    <i class="bx bx-group"></i>
                    <span class="link_name">Uzytkownicy</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a href="{{ route('pracownicy.index') }}">Pracownicy</a></li>
                <li><a href="{{ route('klienci.index') }}">Klienci Stacjonarnie</a></li>
                <li><a href="{{ route('kliencikonta.index') }}">Klienci</a></li>
                {{-- <li><a href="{{ route('kierownicy.index') }}">Kierownicy</a></li> --}}
            </ul>
        </li>
        @endif

        <li>
            <a href="{{ route('hulajnogi.index') }}">
                <i class="bx bx-map"></i>
                <span class="link_name">Hulajnogi</span>
            </a>
        </li>

        <li>
            <a href="{{ route('rezerwacje.index') }}">
                <i class="bx bx-file"></i>
                <span class="link_name">Rezerwacje</span>
            </a>
        </li>
        @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
        <li>
            <a href="{{ route('wypozyczenia.index') }}">
                <i class='bx bx-calendar'></i>
                <span class="link_name">Wypożyczenia</span>
            </a>
        </li>

        <li>
            <a href="{{ route('rewizje.index') }}">
                <i class="bx bx-revision"></i>
                <span class="link_name">Rewizje</span>
            </a>
        </li>
        <li>
            <a href="{{ route('odbiory.index') }}">
                <i class="bx bxs-package"></i>
                <span class="link_name">Odbiory</span>
            </a>
        </li>
        <li>
        @endif

        @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
            <li>
                <div class="iocn-link">
                    <a href="#{{--{{ route('users.index') }}--}}">
                        <i class="bx bx-group"></i>
                        <span class="link_name">Raporty</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="{{ route('raporty.index') }}">Z placówki</a></li>
                    @if(Auth::user()->isAdmin())
                    <li><a href="{{ route('podsumowania.index') }}">Z firmy</a></li>
                    @endif
                </ul>
            </li>
        @endif

        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="/images/totallyImportant.jpg" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ optional(Auth::user())->name }}</div>
                    <div class="job"></div>
                </div>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out' ></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<section class="home-section">

    <div class="overlay-button">
    </div>
    <div class="bg-gray-100  text-gray-600 h-screen flex overflow-hidden text-sm">

        <div class="flex-grow overflow-hidden h-full flex flex-col">

            <div class="flex-grow flex overflow-x-hidden">

                <div class="flex-grow border-gray-200 overflow-y-hidden ">
                    <div class="themecontainer transition-all duration-200">

                    <div class="h-16 lg:flex w-full border-b border-gray-200 hidden px-10 ">




                        @php
                            $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
                        @endphp
                        @if($currentRoute === 'placowki.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Placowki
                                </a>
                            </div>
                            @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="theme-icon">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300" data-modal-target="defaultModal" data-modal-toggle="defaultModal">Dodaj placówkę</button>
                            </div>
                            @endif
                        @elseif($currentRoute === 'hulajnogi.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Hulajnogi
                                </a>
                            </div>
                            @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="hulajnogiModal" data-modal-toggle="hulajnogiModal">Dodaj hulajnoge</button>
                            </div>
                            @endif
                        @elseif($currentRoute === 'users.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Uzytkownicy
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500"  data-modal-target="addEmployee" data-modal-toggle="addEmployee">Dodaj uzytkownika</button>
                            </div>
                        @elseif($currentRoute === 'klienci.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Klienci
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addClient" data-modal-toggle="addClient">Dodaj klienta</button>
                            </div>
                            @elseif($currentRoute === 'kliencikonta.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Klienci Online
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addClientOnline" data-modal-toggle="addClientOnline">Dodaj klienta</button>
                            </div>
                        @elseif($currentRoute === 'raporty.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Raport z placówki
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addRaport" data-modal-toggle="addRaport">Dodaj raport</button>
                            </div>

                        @elseif($currentRoute === 'pracownicy.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Pracownicy
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="registrationModal" data-modal-toggle="registrationModal">Dodaj pracownika</button>
                            </div>
                        {{-- @elseif($currentRoute === 'kierownicy.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Kierownicy
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addClient" data-modal-toggle="addClient">Dodaj kierownika</button>
                            </div> --}}
                        @elseif($currentRoute === 'podsumowania.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Raport dzienny z firmy
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addpodsumowanie" data-modal-toggle="addpodsumowanie">Dodaj raport</button>
                            </div>
                        @elseif($currentRoute === 'wypozyczenia.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Wypożyczenia
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addWypozyczenie" data-modal-toggle="addWypozyczenie">Dodaj wypożyczenie</button>
                            </div>
                        @elseif($currentRoute === 'rewizje.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Rewizje
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addRewizje" data-modal-toggle="addRewizje">Dodaj rewizje</button>
                            </div>
                        @elseif($currentRoute === 'odbiory.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Odbiory
                                </a>
                            </div>
                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addOdbior" data-modal-toggle="addOdbior">Dodaj odbiór</button>
                            </div>
                        @elseif($currentRoute === 'rezerwacje.index')
                            <div class="flex h-full text-gray-600">
                                <a href="#" class="cursor-pointer h-full border-b-2 border-blue-500 text-blue-500 inline-flex mr-8 items-center">
                                    Rezerwacje
                                </a>
                            </div>

                            <div class="ml-auto flex items-center space-x-7">
                                <button id="switch" onclick="toggleTheme()">
                                    <i id="theme-icon" class="bx ">
                                        <i class='bx bxs-moon' ></i>
                                        <i class='bx bxs-sun' ></i>
                                    </i>
                                </button>
                                <button class="h-8 px-3 rounded-md shadow text-white bg-blue-500" data-modal-target="addRezerwacja" data-modal-toggle="addRezerwacja">Dodaj rezerwację</button>
                            </div>
                        @endif

                    </div>
                    </div>
                    <div class="themecontainer duration-200">

                    <div class="flex-grow overflow-hidden h-full flex flex-col  duration-200">
                        <div class="sm:p-7 p-4 overflow-y-auto h-screen  duration-200">

                            <div class="pb-20">
                                @yield("content")
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<script>

    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement; // selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
        sidebarBtn.classList.toggle("translated");
    });


</script>


</body>
</html>
