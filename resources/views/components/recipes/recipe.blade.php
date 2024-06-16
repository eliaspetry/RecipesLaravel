<div class="receta flex flex-col items-center justify-center gap-3 p-6 bg-violet-100 rounded-lg w-5/6 max-w-5xl shadow-lg my-3">
    <h2 class="text-4xl font-bold text-violet-400 text-center">{{$recipe->name}}</h2>
    <p class="text-sm text-gray-600 text-center"><span class="font-bold">Fecha de publicación:</span> {{$recipe->created_at}}</p>
    <p class="text-sm text-gray-600 text-center"><span class="font-bold">Autor:</span> {{$recipe->author}}</p>
    <hr>
    </hr>
    <p class="text-lg text-center"><span class="font-bold">Tiempo de preparación:</span> {{$recipe->prep_time_minutes}} min</p>
    <p class="text-lg text-center"><span class="font-bold">Nivel de dificultad:</span> {{$recipe->difficulty}}</p>
    <p class="text-lg text-center"><span class="font-bold">Categoría(s):</span>
        {{
            implode(', ', array_map(function ($category) {
                return $category['name'];
            }, $recipe->categories))
        }}
    </p>
    <hr>
    </hr>
    <p class="text-lg w-full">{{$recipe->instructions}}</p>
    <hr>
    </hr>
    <img class="h-96 mt-3 rounded-lg" src="{{ asset($recipe->image_url) }}" alt="{{$recipe->name}}">
</div>