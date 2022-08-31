<li>
    <a href="{{ route('compare') }}" class="nav-link">
        <i class="icon-shuffle"></i>
        @if(Session::has('compare'))
            <span class="wishlist_count">{{ count(Session::get('compare'))}}</span>
        @else
            <span class="wishlist_count">0</span>
        @endif
    </a>
</li>