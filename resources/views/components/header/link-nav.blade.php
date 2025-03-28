@props(['active'=> false])
<a {{$attributes}}
    aria-current="{{ $active ? 'page' : 'false'}}"
    class="{{ $active ? 'underline' : ''}} rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
    >
        {{$slot}}
</a>
