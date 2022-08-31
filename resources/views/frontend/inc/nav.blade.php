<style>
    .all_categories{
        padding: 12px 15px;
        display: block;
        font-size: 16px;
        color: #FF324D;
        border-top: 1px solid #ddd;
        margin-top: 5px;
        position: relative;
        cursor: pointer;
        width: 100%;
    }
    .cart_list li{
        border: none;
        padding: 4px 30px;
        font-weight: normal;
        font-size: 16px;
    }
    .cart_list li a{
        font-weight: normal;
        font-size: 16px;
    }
</style>
@if(Route::currentRouteName() == 'home')
<header class="header_wrap">
	<div class="top-header light_skin bg_dark d-none d-md-block">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                	<div class="header_topbar_info">
                    	<div class="header_offer">
                    		<span>Free Ground Shipping Over $250</span>
                        </div>
                        <div class="download_wrap">
                            <span class="mr-3">Download App</span>
                            <ul class="icon_list text-center text-lg-left">
                                <li><a href="javascript:void(0)"><i class="fab fa-apple"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fab fa-android"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fab fa-windows"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-end">
                        @if(get_setting('show_language_switcher') == 'on')
                            <li class="list-inline-item dropdown cart_dropdown mr-3" id="lang-change">
                                @php
                                    if(Session::has('locale')){
                                        $locale = Session::get('locale', Config::get('app.locale'));
                                    }
                                    else{
                                        $locale = 'en';
                                    }
                                @endphp
                                <a href="javascript:void(0)" class="dropdown-toggle text-white" data-toggle="dropdown" data-display="static">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-1 lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                                    <span class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left dm_custom" style="width: auto; padding: 10px 0px;">
                                    @foreach (\App\Language::all() as $key => $language)
                                        <li>
                                            <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                                <span class="language" style="color: black;">{{ $language->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        
                        
                        @if(get_setting('show_currency_switcher') == 'on')
                            <li class="list-inline-item dropdown cart_dropdown" id="currency-change">
                                @php
                                    if(Session::has('currency_code')){
                                        $currency_code = Session::get('currency_code');
                                    }
                                    else{
                                        $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                                    }
                                @endphp
                                <a href="javascript:void(0)" class="dropdown-toggle text-white" data-toggle="dropdown" data-display="static">
                                    {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }} {{ \App\Currency::where('code', $currency_code)->first()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" style="width: auto; padding: 10px 0px;">
                                    @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                        <li>
                                            <a href="javascript:void(0)" data-currency="{{ $currency->code }}" class="dropdown-item @if($currency_code == $currency->code) active @endif">
                                                @if($currency_code == $currency->code) <i class="fa fa-check text-success"></i> @endif
                                                <span class="language" style="color: black;">{{ $currency->symbol }} {{ $currency->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-header dark_skin">
    	<div class="custom-container">
        	<div class="nav_block">
                <a class="navbar-brand" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                    @endif
                </a>
                <div class="product_search_form rounded_input">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="custom_select">
                                    <select class="search_category" disabled>
                                        <option value="">All Category</option>
                                        @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                                            <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input class="form-control" id="search" name="q" placeholder="Search Product..." required=""  type="text" autocomplete="off">
                            <button type="submit" class="search_btn2"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    @auth
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="fas fa-user-check"></i></a>
                            <div class="cart_box dropdown-menu dropdown-menu-right" style="margin-right: -100px; max-width: 50px;">
                                <ul class="cart_list">
                                    @if(isAdmin())
                                        <li>
                                            <div class="row">
                                                <div class="col-2"><i class="fa fa-th-large"></i></div>
                                                <div class="col-9"><a href="{{ route('admin.dashboard') }}"> {{ translate('My Panel')}}</a></div>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="row">
                                                <div class="col-2"><i class="fa fa-th-large"></i></div>
                                                <div class="col-9"><a href="{{ route('dashboard') }}"> {{ translate('My Panel')}}</a></div>
                                            </div>
                                        </li>
                                    @endif
                                    <li>
                                        <div class="row">
                                            <div class="col-2"><i class="fa fa-power-off"></i></div>
                                            <div class="col-9"><a href="{{ route('logout') }}"> {{ translate('Logout')}}</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li><a href="{{route('user.login')}}" class="nav-link"><i class="linearicons-user"></i></a></li>
                    @endauth
                    <div id="compare">
                        @include('frontend.partials.compare')
                    </div>
                    <div id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                    <div id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase border-top border-bottom">
    	<div class="custom-container">
            <div class="row"> 
                @if(Route::currentRouteName() == 'home')
            	<div class="col-lg-3 col-md-4 col-sm-6 col-3">
                	<div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn">
                            <i class="linearicons-menu"></i><span>All Categories </span>
                        </button>
                        <div id="navCatContent" class="nav_cat navbar collapse">
                            <ul> 
                                @include('frontend.partials.category_menu')
                            </ul>
                            <a href="{{ route('categories.all') }}" class="all_categories">See All <i class="fa fa-arrow-right" style="float: right;"></i></a>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-lg-3 col-md-4 col-sm-6 col-3"></div>
                @endif
                
                @if ( get_setting('header_menu_labels') !=  null )
                    <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false"> 
                                <span class="ion-android-menu"></span>
                            </button>
                            <div class="pr_search_icon">
                                <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                            </div> 
                            <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                                <ul class="navbar-nav">
                                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                        <li class="">
                                            <a class="nav-link" href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}">
                                                {{ translate($value) }}
                                            </a>
                                        </li>
                                    @endforeach 
                                </ul>
                            </div>
                            <div class="contact_phone contact_support">
                                <i class="linearicons-phone-wave"></i>
                                <span>{{ get_setting('contact_phone') }}</span>
                            </div>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
@else
<header class="header_wrap fixed-top header_with_topbar">
	<div class="top-header p-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        @if(get_setting('show_language_switcher') == 'on')
                        <ul class="p-0 m-0">
                            <li class="list-inline-item dropdown cart_dropdown mr-3" id="lang-change">
                                @php
                                    if(Session::has('locale')){
                                        $locale = Session::get('locale', Config::get('app.locale'));
                                    }
                                    else{
                                        $locale = 'en';
                                    }
                                @endphp
                                <a href="javascript:void(0)" class="dropdown-toggle text-dark" data-toggle="dropdown" data-display="static">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                                    <span class="opacity-60 text-dark ml-2">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left dm_custom" style="width: auto; padding: 10px 0px;">
                                    @foreach (\App\Language::all() as $key => $language)
                                        <li>
                                            <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                                <span class="language" style="color: black;">{{ $language->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        @endif
                        
                        
                        @if(get_setting('show_currency_switcher') == 'on')
                        <ul class="p-0 m-0">
                            <li class="list-inline-item dropdown cart_dropdown" id="currency-change">
                                @php
                                    if(Session::has('currency_code')){
                                        $currency_code = Session::get('currency_code');
                                    }
                                    else{
                                        $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                                    }
                                @endphp
                                <a href="javascript:void(0)" class="dropdown-toggle text-dark mr-2" data-toggle="dropdown" data-display="static">
                                    {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }} {{ \App\Currency::where('code', $currency_code)->first()->name }} 
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" style="padding: 10px 0px; max-height: 70vh; overflow-y: scroll;">
                                    @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                        <li>
                                            <a href="javascript:void(0)" data-currency="{{ $currency->code }}" class="dropdown-item @if($currency_code == $currency->code) active @endif">
                                                @if($currency_code == $currency->code) <i class="fa fa-check text-success"></i> @endif
                                                <span class="language" style="color: black;">{{ $currency->symbol }} {{ $currency->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        @endif
                        <ul class="contact_detail text-center text-lg-left p-0 m-0">
                            <li><i class="ti-mobile"></i><span>{{ get_setting('contact_phone') }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="text-center text-md-right">
                       	<ul class="header_list p-0 m-0">
                        	<li><a href="{{ route('compare') }}"><i class="ti-control-shuffle"></i><span>Compare</span></a></li>
                            <li><a href="{{ route('wishlists.index') }}"><i class="ti-heart"></i><span>Wishlist</span></a></li>
                            @auth
                                @if(isAdmin())
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="text-reset py-2 d-inline-block opacity-60"><i class="fa fa-th-large"></i> {{ translate('My Panel')}}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="text-reset py-2 d-inline-block opacity-60"><i class="fa fa-th-large"></i> {{ translate('My Panel')}}</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}" class="text-reset py-2 d-inline-block opacity-60"><i class="fa fa-power-off"></i> {{ translate('Logout')}}</a>
                                </li>
                            @else
                                <li><a href="{{ route('user.login') }}"><i class="ti-user"></i><span>{{ translate('Login')}}</span></a></li>
                            @endauth
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav">
                        @if ( get_setting('header_menu_labels') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                <li>
                                    <a class="nav-link" href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}">
                                        {{ translate($value) }}
                                    </a>
                                </li>
                            @endforeach 
                        @endif
                    </ul>
                </div>

                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                <input type="text" placeholder="Search" class="form-control" id="search" name="q" autocomplete="off">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                    <div id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </ul>
            </nav>
        </div>
    </div>
</header>
@endif