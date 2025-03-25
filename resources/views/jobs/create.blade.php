<x-layout>
    <h1 class="ma-auto text-[6rem]">{{ $title }}</h1>
    <form class="bg-white p-20" method="POST" action="/jobs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Crea un nuovo lavoro.</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Aggiungi i dettagli</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form.field>
                       <x-form.label for="title">Title</x-form.label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <x-form.input type="text" name="title" id="title" placeholder="Ceo" required></x-form.input>
                            </div>
                            <x-form.error name="title"></x-form.error>
                        </div>
                    </x-form.field>
                    <x-form.field>
                        <x-form.label for="salary">Salary</x-form.label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <x-form.input type="text" name="salary" id="salary" placeholder="$50,000 per yearr" required></x-form.input>
                            </div>
                            <x-form.error name="salary"></x-form.error>
                        </div>
                    </x-form.field>
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

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <x-form.button>Save</x-form.button>
        </div>
    </form>

</x-layout>
