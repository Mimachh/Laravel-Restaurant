
@props(['title' => "Titre", "subtitle" => "Sous titre de la section", "class" => ""])

<div class="text-center  {{ $class }} ">
    <h2 class="font-quicksand font-semibold text-3xl md:text-5xl pb-4 md:px-0 px-8">{{ $title }}</h2>
    <p class="inline text-muted text-lg">{{ $subtitle }}</p>
</div>
