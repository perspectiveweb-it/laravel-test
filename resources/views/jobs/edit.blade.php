<x-layout>
    <h1 class="ma-auto text-[6rem]">{{ $title }}</h1>
    <form class="bg-white p-20" method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Modifica questo lavoro.</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Aggiungi i dettagli che vuoi cambiare</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="title" id="title"
                                    class="block min-w-0 grow py-1.5 pr-3 px-4 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="Shift leader"
                                    value="{{ $job->title}}"
                                    required>
                            </div>
                            @error('title')
                                <p class="text-red-500 font-light italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salary</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="salary" id="salary"
                                    class="block min-w-0 grow py-1.5 pr-3 px-4 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="$50,000 per year"
                                    value="{{ $job->salary}}"
                                    >
                            </div>
                            @error('salary')
                                <p class="text-red-500 font-light italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- @if($errors->any())
                    <div class="mt-10 text-red-500 font-italic space-y-3">
                        @foreach ($errors->all() as $error )
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif --}}
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <button form="form-delete"
                class="block rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                Delete
            </button>
            <div class="flex items-center justify-end gap-x-6">
                <a href="/jobs/{{$job->id}}" class="text-sm/6 font-semibold text-gray-900">Torna Indietro</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Uptade
                </button>
            </div>
        </div>
    </form>
    {{-- Per cancellare un record devo creare un form però non posso avere un form all'interno del form
    quindi uso <button form="form-delete"> e fuori dal form creo questo form  --}}
        <form class="hidden" method="POST" action="/jobs/{{ $job->id }}" id="form-delete">
            @csrf
            @method('DELETE')
        </form>

</x-layout>
