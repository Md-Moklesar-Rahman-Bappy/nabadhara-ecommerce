<li>
    <a href="{{ route('wishlists.index') }}" class="nav-link">
        <i class="linearicons-heart"></i>
        @if(Auth::check())
            <span class="wishlist_count">{{ count(Auth::user()->wishlists)}}</span>
        @else
            <span class="wishlist_count">0</span>
        @endif
    </a>
</li>