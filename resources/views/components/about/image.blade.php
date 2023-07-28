@props([
'src' => "images/salade.jpg", 
"class" => "", 
"backdrop" => "backdrop-filter bg-primary/70",
"id" => ""])

<div class="relative {{$class}}" id="{{ $id }}">
<img src="{{ asset($src) }}"  alt="Image"
    class="mx-auto rounded-xl 
    "
    loading="lazy"
    width="640" height="360"
>
<span
class="absolute inset-0
backdrop-filter 
w-full rounded-xl max-auto 
{{ $backdrop }}
"
></span>
</div>
