<a href="{{ route('recipe', ['id' => $recipe->id]) }}" class="w-5/6 max-w-5xl">
    <div class="receta flex flex-col items-center justify-center gap-3 p-6 bg-rose-100 rounded-lg shadow-lg my-3">
        <h2 class="text-4xl font-bold text-rose-400 text-center">{{$recipe->name}}</h2>
        <p class="text-sm text-gray-600 text-center"><span class="font-bold">Fecha de publicación:</span> {{$recipe->created_at}}</p>
        <hr>
        </hr>
        <p class="text-lg text-center"><span class="font-bold">Categoría(s):</span>
            {{
                implode(', ', array_map(function ($category) {
                    return $category['name'];
                }, $recipe->categories))
            }}
        </p>
        <p class="text-lg text-center"><span class="font-bold">Nivel de dificultad:</span> {{$recipe->difficulty}}</p>
        <hr>
        </hr>
        <img class="h-96 w-full object-cover object-center" src="{{ asset($recipe->image_url) }}" alt="{{$recipe->name}}">
    </div>
</a>