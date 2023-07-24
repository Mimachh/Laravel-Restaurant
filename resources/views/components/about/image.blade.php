@props([
'src' => "images/salade.jpg", 
"class" => "", 
"backdrop" => "backdrop-filter bg-primary/70",
"id" => ""])

<div class="relative {{$class}}" id="{{ $id }}">
<img src="{{ asset($src) }}" 
    width="100%" height="auto" alt="Image"
    class="mx-auto rounded-xl 
    
    "
>
<span
class="absolute inset-0
backdrop-filter 
w-full rounded-xl max-auto 
{{ $backdrop }}
"
></span>
</div>
