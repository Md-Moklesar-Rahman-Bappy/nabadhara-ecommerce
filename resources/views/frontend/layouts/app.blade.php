<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
    <!-- Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

    @if(!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ get_setting('meta_title') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ get_setting('meta_title') }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ get_setting('meta_title') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
    <meta property="og:description" content="{{ get_setting('meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/animate.css') }}">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/simple-line-icons.css') }}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ static_asset('assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/magnific-popup.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/slick-theme.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/responsive.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_found: '{{ translate('Nothing Found') }}'
        }
    </script>

    <style>
        :root{
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }
    </style>

    @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ env('TRACKING_ID') }}');
        </script>
    @endif

    @if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    @endif

    @php
        echo get_setting('header_script');
    @endphp
</head>
<style>
    .bootstrap-select .dropdown-menu .notify {
    width: calc(100% - 20px);
    margin: 0 10px;
    min-height: 26px;
    padding: 8px 12px;
    background: #f2f3f8;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    opacity: 1;
}
.bootstrap-select .notify.fadeOut {
    -webkit-animation: bs-notify-fadeOut 2s linear 0.2s;
    -o-animation: bs-notify-fadeOut 2s linear 0.2s;
    animation: bs-notify-fadeOut 2s linear 0.2s;
}

/*notify*/
.aiz-notify {
    min-width: 350px;
    max-width: 350px;
    padding-right: 50px;
    border-radius: 0.25rem;
    overflow: hidden;
    border: 0;
    color: var(--white);
    box-shadow: 0 5px 20px 0 rgba(38, 45, 58, 0.2);
    -webkit-box-shadow: 0 5px 20px 0 rgba(38, 45, 58, 0.2);
    padding: 1.25rem 1.25rem;
    font-size: 0.875rem;
}
[dir="rtl"] .aiz-notify {
    text-align: right !important;
}
.aiz-notify .close {
    top: 50% !important;
    height: 20px;
    width: 20px;
    margin-top: -10px;
    font-size: 20px;
    line-height: 20px;
    color: var(--white);
    opacity: 0.7;
    right: 15px !important;
    text-shadow: none;
}
[dir="rtl"] .aiz-notify .close {
    right: auto !important;
    left: 15px !important;
}
.aiz-notify .close:before {
    content: "";
    position: absolute;
    border-radius: 50%;
    background-color: #fff;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    z-index: -1;
    opacity: 0;
}
.aiz-notify .close:hover {
    color: var(--dark);
    opacity: 1;
}
.aiz-notify .close:hover:before {
    opacity: 1;
    background-color: #fff;
    width: 170%;
    height: 170%;
    top: -35%;
    left: -35%;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.aiz-notify .progress {
    height: 3px;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    border-radius: 0;
    background-color: transparent;
}
.aiz-notify .progress-bar {
    background-color: var(--white);
}
.aiz-notify.alert-success {
    background-color: var(--success);
}
.aiz-notify.alert-danger {
    background-color: var(--danger);
}
.aiz-notify.alert-primary {
    background-color: var(--primary);
}
.aiz-notify.alert-warning {
    background-color: var(--warning);
}
.aiz-notify.alert-info {
    background-color: var(--info);
}
.aiz-notify.alert-dark {
    background-color: var(--dark);
}
.aiz-notify.alert-secondary {
    background-color: var(--secondary);
}
.aiz-notify.alert-light,
.aiz-notify.alert-light .close {
    background-color: var(--light);
    color: var(--dark);
}
.aiz-notify.alert-light .progress-bar {
    background-color: var(--primary);
}
@media (max-width: 575px) {
    .aiz-notify {
        width: calc(100% - 40px);
        min-width: auto;
    }
}
</style>
<body>
    @include('frontend.inc.nav')

    @yield('content')

    @include('frontend.inc.footer')

    <div class="modal" id="addToCart">
        
        <div class="modal-dialog modal-xl modal-dialog-centered product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="fa fa-spinner fa-spin" style="font-size: 35px;"></i>
                </div>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>
    
    <!-- END FOOTER -->

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

    <!-- SCRIPTS -->
    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>

    <!-- Latest jQuery --> 
    <script src="{{ static_asset('assets/js/jquery-1.12.4.min.js') }}"></script> 
    <!-- popper min js -->
    <script src="{{ static_asset('assets/js/popper.min.js') }}"></script>
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="{{ static_asset('assets/bootstrap/js/bootstrap.min.js') }}"></script> 
    <!-- owl-carousel min js  --> 
    <script src="{{ static_asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script> 
    <!-- magnific-popup min js  --> 
    <script src="{{ static_asset('assets/js/magnific-popup.min.js') }}"></script> 
    <!-- waypoints min js  --> 
    <script src="{{ static_asset('assets/js/waypoints.min.js') }}"></script> 
    <!-- parallax js  --> 
    <script src="{{ static_asset('assets/js/parallax.js') }}"></script> 
    <!-- countdown js  --> 
    <script src="{{ static_asset('assets/js/jquery.countdown.min.js') }}"></script> 
    <!-- imagesloaded js --> 
    <script src="{{ static_asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- isotope min js --> 
    <script src="{{ static_asset('assets/js/isotope.min.js') }}"></script>
    <!-- jquery.dd.min js -->
    <script src="{{ static_asset('assets/js/jquery.dd.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ static_asset('assets/js/slick.min.js') }}"></script>
    <!-- elevatezoom js -->
    <script src="{{ static_asset('assets/js/jquery.elevatezoom.js') }}"></script>
    <!-- scripts js --> 
    <script src="{{ static_asset('assets/js/scripts.js') }}"></script>

    @if (get_setting('facebook_chat') == 1)
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  xfbml            : true,
                  version          : 'v3.3'
                });
              };

              (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif

    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    </script>

    <script>

        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function(){
                    if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                        $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('{{ route('currency.change') }}',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
                            location.reload();
                        });

                    });
                });
            }
        });

        $('#search').on('keyup', function(){
            search();
        });

        $('#search').on('focus', function(){
            search();
        });

        function search(){
            var searchKey = $('#search').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart(){
            $.post('{{ route('cart.nav_cart') }}', {_token: AIZ.data.csrf }, function(data){
                $('#cart_items').html(data);
            });
        }

        function removeFromCart(key){
            $.post('{{ route('cart.removeFromCart') }}', {_token: AIZ.data.csrf, key:key}, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
                AIZ.plugins.notify('success', 'Item has been removed from cart');
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }

        function addToCompare(id){
            $.post('{{ route('compare.addToCompare') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#compare').html(data);
                AIZ.plugins.notify('success', "{{ translate('Item has been added to compare list') }}");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        }

        function addToWishList(id){
            @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
                $.post('{{ route('wishlists.store') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                    if(data != 0){
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "{{ translate('Item has been added to wishlist') }}");
                    }
                    else{
                        AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
                    }
                });
            @else
                AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
            @endif
        }

        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function(){
            getVariantPrice();
        });

        function getVariantPrice(){
            if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
                $.ajax({
                   type:"POST",
                   url: '{{ route('products.variant_price') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){

                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                       $('#option-choice-form #chosen_price_div').removeClass('d-none');
                       $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                       $('#available-quantity').html(data.quantity);
                       $('.input-number').prop('max', data.quantity);
                       if(parseInt(data.quantity) < 1 && data.digital  == 0){
                           $('.buy-now').hide();
                           $('.add-to-cart').hide();
                       }
                       else{
                           $('.buy-now').show();
                           $('.add-to-cart').show();
                       }
                   }
               });
            }
        }

        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                  names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                  count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function addToCart(){
            if(checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{ route('cart.addToCart') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.view);
                       updateNavCart();
                       $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function buyNow(){
            if(checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{ route('cart.addToCart') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       if(data.status == 1){
                            updateNavCart();
                            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                            window.location.replace("{{ route('cart') }}");
                       }
                       else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.view);
                       }
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function show_purchase_history_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('purchase_history.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function show_order_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function cartQuantityInitialize(){
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

         function imageInputInitialize(){
             $('.custom-input-file').each(function() {
                 var $input = $(this),
                     $label = $input.next('label'),
                     labelVal = $label.html();

                 $input.on('change', function(e) {
                     var fileName = '';

                     if (this.files && this.files.length > 1)
                         fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                     else if (e.target.value)
                         fileName = e.target.value.split('\\').pop();

                     if (fileName)
                         $label.find('span').html(fileName);
                     else
                         $label.html(labelVal);
                 });

                 // Firefox bug fix
                 $input
                     .on('focus', function() {
                         $input.addClass('has-focus');
                     })
                     .on('blur', function() {
                         $input.removeClass('has-focus');
                     });
             });
         }

    </script>

    @yield('script')

    @php
        echo get_setting('footer_script');
    @endphp
</body>
</html>