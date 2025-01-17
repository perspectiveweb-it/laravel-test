<x-layout>
    <h1 class="ma-auto text-[6rem]">{{$title}}</h1>
    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="/jobs/{{$job['id']}}">
                    <strong>{{$job['title']}}:</strong> salary is {{$job['salary']}}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
