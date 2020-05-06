
<div class="relative md:mt-0">
  <input wire:model="search" class="search-livewire-style" name="search" type="text">
    @if(strlen($search) >= 2)
        <div class="absolute">
            @if ($searchResult->count()>0)
            <ul>
                @foreach ($searchResult as $result)
                    <li>
                        <a href="{{route('movies.showMovie', $result['id'])}}">
                            @if($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/92x92" alt="poster">
                            @endif
                                <span>{{$result['title']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul> 
            @else 
                <ul>
                    <li>No results for "{{$search}}"</li>
                </ul>
            @endif
        </div>
    @endif
</div>