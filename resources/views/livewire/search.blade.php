<div class="relative mt-3 md:mt-0">
  <input wire:model.debounce.400ms="search" class="search-livewire-style " name="search" type="text">
    @if(strlen($search) >= 2)
        <div class="absolute bg-white-800 text-sm">
            @if ($searchResult->count()>0)
            <ul class="movie-search-list">
                @foreach ($searchResult as $result)
                    <li class="border-b border-white-700">
                        <a class="block hover:bg-white-700 transition ease-in-out duration-150" href="{{route('movies.showMovie', $result['id'])}}">
                            @if($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/92x138" alt="poster">
                            @endif
                                <span class="ml-4">{{$result['title']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul> 
            @else 
                <ul>
                    <li class="border-b border-white-700">No results for "{{$search}}"</li>
                </ul>
            @endif
        </div>
    @endif
</div>
