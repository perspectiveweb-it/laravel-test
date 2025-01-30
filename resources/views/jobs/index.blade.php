<x-layout>
    <h1 class="ma-auto text-[6rem]">{{$title}}</h1>
    <x-button href="/jobs/create" class="my-10 mr-auto">Aggiungi un lavoro</x-button>
    <div class="grid grid-cols-3 gap-6">
        @foreach ($jobs as $job)
            <a class="px-6 py-10 bg-slate-400 flex flex-col items-start rounded-md space-y-3" href="/jobs/{{$job['id']}}">
                <div class="flex flex-wrap gap-2">
                    @foreach ($job->tags as $tag)
                        <span class="bg-black py-2 px-3 text-white rounded-full">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <h3 class="font-bold text-[1.25rem]">{{$job['title']}}</h3>
                <p>Azienda is: {{$job->employer->name}}</p>
                <p>Salary is: {{$job['salary']}}</p>
            </a>
        @endforeach
    </div>
    <div class="ml-auto mt-10">{{$jobs->links()}}</div>
</x-layout>
