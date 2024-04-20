@if(\Illuminate\Support\Facades\Auth::check())
    {{\Illuminate\Support\Facades\Redirect::route('/placowki')}}
@endif
<title>Zaloguj się</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements"></script>
<link href="/dist/tailwind.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

<style>

</style>
<div class="min-h-screen bg-purple-800 flex justify-start items-center">
    <div class="h-screen py-12 px-16 bg-white z-20 w-100 flex flex-col justify-center">
        <div>
            <h1 class="text-3xl font-bold text-left mb-14 cursor-pointer">Hulajnogi!</h1>

            <h1 class="w-80 text-4xl font-bold text-left mb-4 cursor-pointer">Witamy ponownie</h1>
            <p id="newUserLabel" class="w-80 text-start text-sm mb-8 font-semibold text-gray-700 tracking-wide cursor-pointer">Jesteś tu nowy? <a href="#" class="text-purple-800 font-bold">Stwórz konto.</a></p>
        </div>
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <label for="email" class="block
             text-sm font-bold text-gray-700 tracking-wide mb-1">Email</label>
                <input id="email" type="text" placeholder="Email Addres" class=" form-control @error('email') is-invalid @enderror block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <label for="password" class="block text-sm font-bold text-gray-700 tracking-wide mb-1">Password</label>
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="password" required autocomplete="current-password"/>

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>                    <label for="remember" class="pl-2 text-sm font-bold text-gray-700">Zapamiętaj mnie</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-sm font-bold  text-purple-800" href="{{ route('password.request') }}">
                            {{ __('Zapomniałeś hasła?') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="text-center mt-6 space-y-2">
                <button type="submit" class="w-full" onclick="animateRouteTransition(event)">
                    <a class="relative inline-flex items-center justify-center w-full p-4 px-5 py-3 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out rounded-full shadow-xl group hover:ring-1 hover:ring-purple-500">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-blue-600 via-purple-600 to-pink-700"></span>
                        <span class="absolute bottom-20 right-5 block w-80 h-80 mb-10 mr-30 transition duration-500 origin-bottom-left transform rotate-45 translate-x-0 bg-pink-500 rounded-full opacity-30 group-hover:rotate-90 group-hover:scale-125 ease"></span>
                        <span class="relative text-white"> {{ __('Zaloguj') }}</span>
                    </a>
                </button>
            </div>
        </form>
        <form id="register-form" method="POST" action="{{ route('register') }}" style="display: none;">
            @csrf

            <div class="row mb-3">
                <label for="name" class="block
             text-sm font-bold text-gray-700 tracking-wide mb-1">{{ __('Nazwa') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="block
             text-sm font-bold text-gray-700 tracking-wide mb-1">{{ __('Adres Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="block
             text-sm font-bold text-gray-700 tracking-wide mb-1">{{ __('Hasło') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="block
             text-sm font-bold text-gray-700 tracking-wide mb-1">{{ __('Powtórz hasło') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control mb-8 block text-sm py-3 px-4 rounded-lg w-full border outline-none" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>


            <button id="register-submit" type="submit" class="w-full">
                <a class="relative inline-flex items-center justify-center w-full p-4 px-5 py-3 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out rounded-full shadow-xl group hover:ring-1 hover:ring-purple-500">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-blue-600 via-purple-600 to-pink-700"></span>
                    <span class="absolute bottom-20 right-5 block w-80 h-80 mb-10 mr-30 transition duration-500 origin-bottom-left transform rotate-45 translate-x-0 bg-pink-500 rounded-full opacity-30 group-hover:rotate-90 group-hover:scale-125 ease"></span>
                    <span class="relative text-white"> {{ __('Stwórz konto!') }}</span>
                </a>
            </button>
        </form>

        <button id="register-button" class="py-2 w-full text-xl text-black bg-white border border-black rounded-2xl">Zarejestruj</button>

        <p id="signin-link" class="mt-4 text-sm" style="display: none;">Masz już konto? <span class="underline cursor-pointer">Zaloguj się</span></p>

    </div>


    <div id="default-carousel" class="h-auto max-h-screen relative w-full border-8 border-white overflow-y-hidden" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/unsplash1.jpg" class="absolute block w-full h-full object-cover" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/unsplash2.jpg" class="absolute block w-full h-full object-cover" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/unsplash6.jpg" class="absolute block w-full h-full object-cover" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/unsplash4.jpg" class="absolute block w-full h-full object-cover" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/unsplash5.jpg" class="absolute block w-full h-full object-cover" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
    </div>


</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get form elements
        const loginForm = document.getElementById("login-form");
        const registerForm = document.getElementById("register-form");

        // Get button elements
        const registerButton = document.getElementById("register-button");
        const registerSubmit = document.getElementById("register-submit");

        // Get "Sign In" link element
        const signInLink = document.getElementById("signin-link");
        const newUserLabel = document.getElementById("newUserLabel");
        const welcomeText = document.querySelector(".text-4xl.font-bold.text-left.mb-4.cursor-pointer");
        // Add event listener to register button

        newUserLabel.addEventListener("click", function() {
            // Toggle form display
            loginForm.style.display = "none";
            registerForm.style.display = "block";

            signInLink.style.display = "block";
            newUserLabel.style.opacity = "0"
            registerSubmit.style.display = "block";
            registerButton.style.display = "none";

            // Animate form switch
            registerForm.style.opacity = "0";
            registerForm.style.transform = "translateY(-20px)";
            registerForm.style.transition = "opacity 0.3s ease, transform 0.3s ease";

            setTimeout(function() {
                registerForm.style.opacity = "1";
                registerForm.style.transform = "translateY(0)";
            }, 50);

            welcomeText.textContent = "Stwórz konto";
        });
        registerButton.addEventListener("click", function() {
            // Toggle form display
            loginForm.style.display = "none";
            registerForm.style.display = "block";

            signInLink.style.display = "block";
            newUserLabel.style.display = "none"
            registerSubmit.style.display = "block";
            registerButton.style.display = "none";

            // Animate form switch
            registerForm.style.opacity = "0";
            registerForm.style.transform = "translateY(-20px)";
            registerForm.style.transition = "opacity 0.3s ease, transform 0.3s ease";
            setTimeout(function() {
                registerForm.style.opacity = "1";
                registerForm.style.transform = "translateY(0)";
            }, 50);
            welcomeText.textContent = "Stwórz konto";
        });

        // Add event listener to "Sign In" link
        signInLink.addEventListener("click", function() {
            // Toggle form display
            loginForm.style.display = "block";
            registerForm.style.display = "none";
            signInLink.style.display = "none";
            newUserLabel.style.display = "block"

            // animate login form switch
            loginForm.style.opacity = "0";
            loginForm.style.transform = "translateY(-20px)";
            loginForm.style.transition = "opacity 0.3s ease, transform 0.3s ease";
            setTimeout(function() {
                loginForm.style.opacity = "1";
                loginForm.style.transform = "translateY(0)";
            }, 50);

            // Animate register button
            registerButton.style.opacity = "0";
            registerButton.style.transform = "translateY(-20px)";
            registerButton.style.transition = "opacity 0.3s ease, transform 0.3s ease";

            setTimeout(function() {
                registerButton.style.opacity = "1";
                registerButton.style.transform = "translateY(0)";
            }, 50);

            registerSubmit.style.display = "none";
            registerButton.style.display = "block";
            welcomeText.textContent = "Witamy ponownie";

        });
    });

</script>

</div>
