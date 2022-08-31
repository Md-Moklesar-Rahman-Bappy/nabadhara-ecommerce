@foreach (\App\Category::where('level', 0)->get()->take(10) as $key => $category)
    
    @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
        <li class="dropdown dropdown-mega-menu">
            <a class="dropdown-item nav-link dropdown-toggler" href="#" data-toggle="dropdown"><i class="flaticon-tv"></i> <span>{{ $category->getTranslation('name') }}</span></a>
            <div class="dropdown-menu">
                <ul class="mega-menu d-lg-flex">
                    <li class="mega-menu-col col-lg-12">
                        <ul class="d-lg-flex">
                            @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                <li class="mega-menu-col col-lg-4">
                                    <ul> 
                                        <li class="dropdown-header"><a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a></li>
                                        @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                                            <li>
                                                <a class="dropdown-item nav-link nav_item" href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}">{{ \App\Category::find($second_level_id)->getTranslation('name') }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </li>
    @else
        <li data-id="{{ $category->id }}">
            <a class="dropdown-item nav-link nav_item" href="{{ route('products.category', $category->slug) }}"><i><img class="cat-image" width="25" src="{{ uploaded_asset($category->icon) }}" alt="{{ $category->getTranslation('name') }}"></i>
            <span>{{ $category->getTranslation('name') }}</span></a>
        </li>
    @endif

    
    
    {{-- <li class="category-nav-element" data-id="{{ $category->id }}">
        <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-reset py-2 px-3 d-block">
            <img
                class="cat-image lazyload mr-2 opacity-60"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($category->icon) }}"
                width="16"
                alt="{{ $category->getTranslation('name') }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
            <span class="cat-name">{{ $category->getTranslation('name') }}</span>
        </a>
        @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
            <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4">
                <div class="c-preloader text-center absolute-center">
                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                </div>
            </div>
        @endif
    </li> --}}
@endforeach