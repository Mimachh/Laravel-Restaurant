@props(['title' => "Titre", "class" => "", "clickAction" => ""])

<button
    class=" px-4 md:px-6 py-2 md:py-3 text-md md:text-xl rounded-md font-quicksand font-bold 

    transition-colors ease-in-out duration-150
    {{ $class }}
    "

    onclick="{{ $clickAction }}"
>{{ $title }}</button>