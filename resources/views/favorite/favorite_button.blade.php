@if (Auth::check())
        @if (Auth::user()->is_favorites($micropost->id))
            <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
               @csrf
               @method('DELETE')
               <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-full" 
                onclick="return confirm('id = {{ $micropost->id }} お気に入りを外します。よろしいですか？')">Unfavorite</button>
            </form>
        @else
            <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full">Favorite</button>
            </form>
　　　　@endif   
@endif