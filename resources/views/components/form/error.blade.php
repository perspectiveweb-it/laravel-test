@props(['name'])
@error($name)
    <p class="text-red-500 font-light italic">{{$message}}</p>
@enderror
