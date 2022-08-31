@if(Route::currentRouteName() == 'home')
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <div class="section bg_default small_pt small_pb">
        <div class="custom-container">	
            <div class="row align-items-center">	
                <div class="col-md-6">
                    <div class="newsletter_text text_white">
                        <h3>{{ translate('Join Our Newsletter Now') }}</h3>
                        <p> {{ translate('Register now to get updates on promotions.') }} </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter_form2 rounded_input">
                        <form method="POST" action="{{ route('subscribers.store') }}">
                            @csrf
                            <input type="email" name="email" required="" class="form-control" placeholder="{{ translate('Your Email Address') }}">
                            <button type="submit" class="btn btn-dark btn-radius" name="submit" value="Submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->

    <footer class="bg_gray">
        <div class="footer_top small_pt pb_20">
            <div class="custom-container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="widget">
                            <div class="footer_logo">
                                @if(get_setting('footer_logo') != null)
                                    <a href="{{ route('home') }}"><img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44" /></a>
                                @else
                                    <a href="{{ route('home') }}"><img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44" /></a>
                                @endif
                            </div>
                            <p class="mb-3">
                                @php
                                    echo get_setting('about_us_description');
                                @endphp
                            </p>

                            <ul class="contact_info">
                                <li>
                                    <i class="ti-location-pin"></i>
                                    <p>{{ get_setting('contact_address') }}</p>
                                </li>
                                <li>
                                    <i class="ti-email"></i>
                                    <a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email') }}</a>
                                </li>
                                <li>
                                    <i class="ti-mobile"></i>
                                    <p>{{ get_setting('contact_phone') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">{{ get_setting('widget_one') }}</h6>
                            <ul class="widget_links">
                                @if ( get_setting('widget_one_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                    <li>
                                        <a target="_blank" href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">{{ translate('My Account') }}</h6>
                            <ul class="widget_links">
                                @if (Auth::check())
                                    <li>
                                        <a  href="{{ route('logout') }}">
                                            {{ translate('Logout') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('user.login') }}">
                                            {{ translate('Login') }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a target="_blank" href="{{ route('purchase_history.index') }}">
                                        {{ translate('Order History') }}
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{ route('wishlists.index') }}">
                                        {{ translate('My Wishlist') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.track') }}">
                                        {{ translate('Track Order') }}
                                    </a>
                                </li>
                                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                                    <li>
                                        <a href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="widget">
                            @if (get_setting('vendor_system_activation') == 1)
                                <div>
                                    <h6 class="widget_title">{{ translate('Be a Seller') }}</h6>
                                    <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                                        {{ translate('Apply Now') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="middle_footer">
            <div class="custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="shopping_info">
                            <div class="row justify-content-center">
                                <div class="col-md-4">	
                                    <div class="icon_box icon_box_style2">
                                        <div class="icon">
                                            <i class="flaticon-shipped"></i>
                                        </div>
                                        <div class="icon_box_content">
                                            <h5>Free Delivery</h5>
                                            <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">	
                                    <div class="icon_box icon_box_style2">
                                        <div class="icon">
                                            <i class="flaticon-money-back"></i>
                                        </div>
                                        <div class="icon_box_content">
                                            <h5>30 Day Returns Guarantee</h5>
                                            <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">	
                                    <div class="icon_box icon_box_style2">
                                        <div class="icon">
                                            <i class="flaticon-support"></i>
                                        </div>
                                        <div class="icon_box_content">
                                            <h5>27/4 Online Support</h5>
                                            <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom_footer border-top-tran">
            <div class="custom-container">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="mb-lg-0 text-center">
                            @php
                                echo get_setting('frontend_copyright_text');
                            @endphp
                        </p>
                    </div>
                    
                    <div class="col-lg-4 order-lg-first">
                        <div class="widget mb-lg-0">
                            <ul class="social_icons text-center text-lg-left">
                                @if ( get_setting('facebook_link') !=  null )
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank" class="sc_facebook"><i class="ion-social-facebook"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('twitter_link') !=  null )
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('twitter_link') }}" target="_blank" class="sc_twitter"><i class="ion-social-twitter"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('instagram_link') !=  null )
                                <li class="list-inline-item">
                                    <a target="_blank" href="{{ get_setting('instagram_link') }}" target="_blank" class="sc_instagram"><i class="ion-social-instagram"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('youtube_link') !=  null )
                                <li class="list-inline-item">
                                    <a target="_blank" href="{{ get_setting('youtube_link') }}" target="_blank" class="sc_youtube"><i class="ion-social-youtube"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('linkedin_link') !=  null )
                                <li class="list-inline-item">
                                    <a target="_blank" href="{{ get_setting('linkedin_link') }}" target="_blank" class="sc_linkedin"><i class="ion-social-linkedin"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <ul class="footer_payment text-center text-lg-right">
                            @if ( get_setting('payment_method_images') !=  null )
                                @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                    <li>
                                        <img src="{{ uploaded_asset($value) }}" height="30" style="max-height: 30px">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@else
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <div class="section bg_default small_pt small_pb">
        <div class="container">	
            <div class="row align-items-center">	
                <div class="col-md-6">
                    <div class="heading_s1 mb-md-0 heading_light">
                        <h3>{{ translate('Subscribe Our Newsletter') }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter_form">
                        <form method="POST" action="{{ route('subscribers.store') }}">
                            @csrf
                            <input type="email" name="email" required="" class="form-control rounded-0" placeholder="{{ translate('Enter Email Address') }}">
                            <button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">{{ translate('Subscribe') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <!-- START FOOTER -->
    <footer class="footer_dark">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="widget">
                            <div class="footer_logo">
                                @if(get_setting('footer_logo') != null)
                                    <a href="{{ route('home') }}"><img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44" /></a>
                                @else
                                    <a href="{{ route('home') }}"><img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44" /></a>
                                @endif
                            </div>
                            <p class="mb-3">
                                @php
                                    echo get_setting('about_us_description');
                                @endphp
                            </p>
                        </div>

                        <div class="widget">
                            <ul class="social_icons social_white">
                                @if ( get_setting('facebook_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="ion-social-facebook"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('twitter_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="ion-social-twitter"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('instagram_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('instagram_link') }}" target="_blank"><i class="ion-social-instagram-outline"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('youtube_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="ion-social-youtube-outline"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('linkedin_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="ion-social-linkedin-outline"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">{{ get_setting('widget_one') }}</h6>
                            <ul class="widget_links">
                                @if ( get_setting('widget_one_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                    <li>
                                        <a target="_blank" href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">{{ translate('My Account') }}</h6>
                            <ul class="widget_links">
                                @if (Auth::check())
                                    <li>
                                        <a  href="{{ route('logout') }}">
                                            {{ translate('Logout') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('user.login') }}">
                                            {{ translate('Login') }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a target="_blank" href="{{ route('purchase_history.index') }}">
                                        {{ translate('Order History') }}
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{ route('wishlists.index') }}">
                                        {{ translate('My Wishlist') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.track') }}">
                                        {{ translate('Track Order') }}
                                    </a>
                                </li>
                                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                                    <li>
                                        <a href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">Contact Info</h6>
                            <ul class="contact_info contact_info_light">
                                <li>
                                    <i class="ti-location-pin"></i>
                                    <p>{{ get_setting('contact_address') }}</p>
                                </li>
                                <li>
                                    <i class="ti-email"></i>
                                    <a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email') }}</a>
                                </li>
                                <li>
                                    <i class="ti-mobile"></i>
                                    <p>{{ get_setting('contact_phone') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="widget">
                            @if (get_setting('vendor_system_activation') == 1)
                                <div>
                                    <h6 class="widget_title">{{ translate('Be a Seller') }}</h6>
                                    <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md text-white">
                                        {{ translate('Apply Now') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_footer border-top-tran">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-md-0 text-center text-md-left">
                            @php
                                echo get_setting('frontend_copyright_text');
                            @endphp
                        </p>
                    </div>
                    <div class="col-md-6">
                        <ul class="footer_payment text-center text-lg-right">
                            @if ( get_setting('payment_method_images') !=  null )
                                @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                    <li>
                                        <img src="{{ uploaded_asset($value) }}" height="30" style="max-height: 30px">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
@endif

