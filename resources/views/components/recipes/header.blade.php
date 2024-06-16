<header>
    <div class="flex flex-row items-center justify-center gap-3 py-6">
        <img src="{{ asset('images/logo.png') }}" height="75" width="75" alt="logo" />
        <h1 class="text-6xl font-bold text-teal-500">Recetas</h1>
    </div>

    <nav>
        <ul class="flex flex-col items-center justify-center gap-5 md:flex-row">
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('api.recipes.all', ['page' => 1]) }}" target="_blank">API_recipes</a>
            </li>
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('api.recipes.id', ['id' => 1]) }}" target="_blank">API_recipe</a>
            </li>
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('api.recipes.category', ['id' => 1, 'page' => 1]) }}" target="_blank">API_category</a>
            </li>
            @if (Route::has('login'))
            @auth
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @else
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('login') }}">Log in</a>
            </li>
            @if (Route::has('register'))
            <li class="p-3 bg-teal-300 font-bold text-teal-800 rounded-md cursor-pointer w-5/6 md:w-auto text-center">
                <a href="{{ route('register') }}">Register</a>
            </li>
            @endif
            @endauth
            @endif
        </ul>
    </nav>
</header>