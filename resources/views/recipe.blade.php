<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recetas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-teal-50 flex flex-col h-screen">
    @component('components.recipes.header') @endcomponent
    <main class="grow">
        <section id="receta">
            <div class="flex flex-col items-center justify-center gap-3 rounded-lg w-full my-8">
                @component('components.recipes.recipe', ['recipe' => $recipe]) @endcomponent
            </div>
        </section>
    </main>
    @component('components.recipes.footer') @endcomponent
</body>

</html>