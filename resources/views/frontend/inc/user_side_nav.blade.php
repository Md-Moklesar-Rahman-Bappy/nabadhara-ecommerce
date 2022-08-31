<!-- CSS Files -->
<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">

<link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
<link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />

<style>
    a {
        color: #292b2c;
        text-decoration: none;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all .3s ease-in-out;
    }
    a:hover {
        color: #046a70;
        text-decoration: none;
    }
    a:focus {
        outline: none;
    }

    #aizUploaderModal{
        margin-top: 30px;
        height: 95vh; 
    }

    
    /*===================================*
    15.START BREADCRUMB STYLE
    *===================================*/
    .breadcrumb_section {
        padding: 150px 0;
        width: 100%;
    }
    .breadcrumb_section.page-title-mini {
        padding: 70px 0;
    }
    .page-title-mini .page-title h1 {
        font-size: 28px;
    }
    .page-title-mini .breadcrumb li {
        font-size: 14px;
    }
    .header_wrap.transparent_header  + .breadcrumb_section {
        padding-top: 200px;
    }
    .header_wrap.transparent_header.header_with_topbar + .breadcrumb_section {
        padding-top: 250px;
    }
    .page-title h1 {
        margin: 0;
        text-transform: capitalize;
        font-weight: bold;
        line-height: normal;
    }
    .page_title_light *, .page_title_light .breadcrumb-item, .page_title_light .breadcrumb-item::before {
        color: #fff;
    }
    .breadcrumb {
        background-color: transparent;
        margin: 0;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\f3d1";
        font-family: "Ionicons";
        vertical-align: middle;
    }
    .page-title + .breadcrumb {
        margin-top: 15px;
    }
    .page-title + span {
        margin-top: 15px;
        display: inline-block;
        width: 100%;
    }
    .page_title_video {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        z-index: -1;
        overflow: hidden;
    }
    .page_title_video video {
        object-fit: cover;
        width: 100%;
    }
    .breadcrumb-item a i {
        font-size: 26px;
        line-height: 1;
        vertical-align: middle;
        margin-right: 5px;
        margin-top: -5px;
        display: inline-block;
    }
    .page-title-video {
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: -3;
    }
    .page-title-video video {
        object-fit: cover;
        width: 100%;
    }
    /*===================================*
    15.END BREADCRUMB STYLE
    *===================================*/

    /*===================================*
    02.START HEADER STYLE
    *===================================*/
    .navbar-brand {
        padding: 10px 0;
        vertical-align: top;
        margin: 0;
    }
    .dark_skin .logo_light, .dark_skin .logo_default,
    .light_skin .logo_default, .light_skin .logo_dark,
    .logo_light,.logo_dark {
        display: none;
    }
    .dark_skin .logo_dark,
    .light_skin .logo_light {
        display: block;
    }
    .light_skin .navbar-nav a,
    .light_skin .navbar-toggler,
    .light_skin .navbar a.pr_search_trigger {
        color: #ffffff;
    }
    .middle-header {
        padding: 10px 0;
        position: relative;
    }
    .navbar {
        padding: 0;
    }
    .header_wrap {
        transition: all 0.5s ease 0s;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]) {
        background-color: #fff;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header {
        background-color: transparent;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header.nav-fixed {
        background-color: #fff;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header.light_skin.nav-fixed,
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header.nav-fixed .light_skin {
        background-color: #1D2224;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header.sticky_dark_skin.nav-fixed,
    .light_skin .sidetoggle_icon::after,
    .light_skin .sidetoggle_icon::before,
    .light_skin .toggle_center_line {
        background-color: #fff;
    }
    .navbar .navbar-nav li {
        position: relative;
        list-style: none;
        transition: all 0.3s ease 0s;
    }
    .navbar-nav .dropdown-menu {
        border: 0;
        border-radius: 0;
        margin: 0;
        padding: 0;
        min-width: 14rem;
    }
    .navbar-nav .dropdown-menu {
        background-color: #252A2C;
    }
    .light_skin .navbar-nav .dropdown-menu .mega-menu .dropdown-menu, 
    .light_skin .navbar-nav .dropdown-menu .dropdown-menu {
        background-color: #303537;
    }
    .dark_skin .navbar-nav .dropdown-menu {
        background-color: #fff;
        box-shadow: 0 13px 42px 11px rgba(0,0,0,.05);
    }
    .dark_skin .mega-menu-col,
    .dark_skin .cart_list li {
        border-color: #ddd;
    }
    .dark_skin .navbar .navbar-nav .dropdown-menu li a.active, 
    .dark_skin .navbar .navbar-nav .dropdown-menu li a:hover, 
    .dark_skin .navbar .navbar-nav .dropdown-menu > ul > li:hover > a, 
    .dark_skin .navbar .navbar-nav .dropdown-menu > ul > .mega-menu-col ul > li:hover > a {
        color: #046a70;
    }
    .dark_skin .navbar .navbar-nav li > .dropdown-item, 
    .dark_skin .navbar .navbar-nav .dropdown-header,
    .dark_skin .cart_quantity,
    .dark_skin .cart_total {
        color: #333333;
    }
    .dropdown-toggle::after, .dropdown-toggler::after {
        border: 0 none;
        content: "\f3d0";
        font-family: "Ionicons";
        margin-left: 5px;
        vertical-align: middle;
    }
    .dropdown-toggler::after {
        -moz-transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    .dropdown-menu .dropdown-toggler::after {
        position: absolute;
        right: 15px;
        top: 10px;
    }
    .navbar .navbar-nav > li > .nav-link {
        font-weight: 500;
        padding: 22px 10px;
        text-transform: capitalize;
        font-size: 14px;
    }
    .navbar .navbar-nav > li > a.active, 
    .navbar .navbar-nav > li:hover > a,
    .light_skin.transparent_header.nav-fixed .navbar .navbar-nav > li > a.active,
    .light_skin.transparent_header.nav-fixed .navbar .navbar-nav > li:hover > a,
    .transparent_header.nav-fixed .light_skin .navbar .navbar-nav > li > a.active,
    .transparent_header.nav-fixed .light_skin .navbar .navbar-nav > li:hover > a {
        color: #046a70;
    }
    .light_skin .navbar .navbar-nav .dropdown-item,
    .light_skin .navbar .navbar-nav .dropdown-header {
        color: #fff;
    }
    .light_skin .item_remove {
        color: #fff !important;
    }
    .light_skin .mega-menu-col {
        border-right: 1px solid #3f3f3f;
    }
    .navbar .navbar-nav .dropdown-item {
        padding: 8px 20px 8px 20px;
        color: #333;
        font-size: 14px;
        text-transform: capitalize;
    }
    .navbar .navbar-nav .dropdown-item.dropdown-toggler {
        padding-right: 30px;
    }
    .navbar .navbar-nav .dropdown-header {
        color: #333;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
    }
    .navbar-nav.attr-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .navbar-nav.attr-nav li .nav-link {
        padding: 20px 10px;
        position: relative;
        white-space: nowrap;
    }
    .navbar .attr-nav li.nav-btn {
        margin-left: 10px;
    }
    .navbar-nav.attr-nav li .nav-link i {
        font-size: 20px;
    }
    .hover_menu_style2 .navbar .navbar-nav.attr-nav > li > .nav-link {
        margin: 0;
        padding: 20px 10px;
    }
    .dropdown-item:focus, .dropdown-item:hover,
    .dropdown-item.active, .dropdown-item:active {
        background-color: transparent;
    }
    .navbar .navbar-nav.attr-nav .dropdown-menu li a.active, 
    .navbar .navbar-nav.attr-nav .dropdown-menu li a:hover, 
    .navbar .navbar-nav.attr-nav .dropdown-menu > ul > li:hover > a {
        background-color: rgba(0,0,0,0);
    }
    .navbar .navbar-nav .dropdown-menu li a.active, 
    .navbar .navbar-nav .dropdown-menu li a:hover, 
    .navbar .navbar-nav .dropdown-menu > ul > li:hover > a, 
    .navbar .navbar-nav .dropdown-menu > ul > .mega-menu-col ul > li:hover > a, 
    .sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-item:hover {
        color: #046a70;
    }
    .sticky_dark_skin.nav-fixed .logo_light {
        display: none;
    }
    .sticky_dark_skin.nav-fixed .logo_dark {
        display: block;
    }
    .sticky_dark_skin.nav-fixed .navbar-nav li > a,
    .sticky_dark_skin.nav-fixed .navbar-toggler,
    .sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-item,
    .sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-header,
    .sticky_dark_skin.nav-fixed .cart_quantity, .sticky_dark_skin.nav-fixed .cart_total {
        color: #333;
    }
    .sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-item.active {
        color: #046a70;
    }
    .sticky_dark_skin.nav-fixed .item_remove {
        color: #333 !important;
    }
    .sticky_dark_skin.nav-fixed .navbar-nav .dropdown-menu, 
    .sticky_dark_skin.nav-fixed .navbar-nav .dropdown-menu .dropdown-menu {
        background-color: #fff;
        box-shadow: 0 13px 42px 11px rgba(0,0,0,.05);
    }
    .sticky_dark_skin.nav-fixed .mega-menu-col,
    .sticky_dark_skin.nav-fixed .cart_list li {
        border-color: #ddd;
    }
    .sticky_dark_skin.nav-fixed.header_wrap[class*="bg_"], .sticky_dark_skin.nav-fixed.header_wrap[class*="bg-"] {
        background-color: #fff !important;
    }
    .sticky_light_skin.nav-fixed .logo_dark {
        display: none;
    }
    .sticky_light_skin.nav-fixed .logo_light {
        display: block;
    }
    .sticky_light_skin.nav-fixed.header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header,
    .sticky_light_skin.nav-fixed.header_wrap:not([class*="bg_"]):not([class*="bg-"]) {
        background-color: #1D2224;
    }
    .sticky_light_skin.nav-fixed.header_wrap[class*="bg_"], .sticky_light_skin.nav-fixed.header_wrap[class*="bg-"] {
        background-color: #1D2224 !important;
    }
    .sticky_light_skin.nav-fixed .navbar-nav a,
    .sticky_light_skin.nav-fixed .navbar-toggler,
    .sticky_light_skin.nav-fixed .navbar .navbar-nav .dropdown-item,
    .sticky_light_skin.nav-fixed .navbar .navbar-nav .dropdown-header,
    .sticky_light_skin.nav-fixed .cart_quantity, .sticky_light_skin.nav-fixed .cart_total {
        color: #fff;
    }
    .sticky_light_skin.nav-fixed .item_remove {
        color: #fff !important;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).sticky_light_skin.nav-fixed .navbar-nav .dropdown-menu {
        background-color: #252A2C;
        border-color: #252A2C;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).sticky_light_skin.nav-fixed .navbar-nav .dropdown-menu .mega-menu .dropdown-menu, 
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).sticky_light_skin.nav-fixed .navbar-nav .dropdown-menu .dropdown-menu {
        background-color: #303537;
    }
    .sticky_light_skin.nav-fixed .mega-menu-col {
        border-right: 1px solid #3f3f3f;
    }
    .sticky_light_skin.nav-fixed .cart_list li {
        border-color: #3f3f3f;
    }
    .sticky_dark_skin.nav-fixed .btn-tran-light {
        background-color: #333;
        color: #fff !important;
    }
    .sticky_dark_skin.nav-fixed .btn-tran-light:hover {
        background-color: transparent;
        color: #333 !important;
        border-color: #333;
    }
    .search_overlay {
        content: "";
        background-color: #000;
        height: 100%;
        top: 0;
        position: fixed;
        text-align: center;
        opacity: 0.5;
        right: 0;
        transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
        width: 0;
        z-index: 99;
    }
    .search_overlay.open {
        left: 0;
        right: auto;
        width: 100%;
    }
    .search-overlay.open {
        visibility: visible;
        opacity: 1;
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }
    .search_trigger.open i::before {
        content: "\f129";
        font-family: "Ionicons";
    }
    .search_wrap {
        position: fixed;
        left: 0;
        right: 0;
        max-width: 800px;
        margin: 0 auto;
        padding: 80px 0;
        z-index: 9999;
        bottom: 0;
        opacity: 0;
        visibility: hidden;
        display: -ms-flexbox;
        display: flex;
        height: 100%;
        -ms-flex-align: center;
        align-items: center;
    }
    .search_wrap.open {
        opacity: 1;
        visibility: visible;
        -webkit-animation: slideInLeft 1s both;
        animation: slideInLeft 1s both;
    }
    .search_wrap form {
        position: relative;
        width: 100%;
    }
    .search_wrap .form-control:focus {
        color: #fff;
    }
    .search_icon {
        font-size: 24px;
        position: absolute;
        right: 5px;
        top: 5px;
        border: 0;
        background-color: transparent;
        cursor: pointer;
        padding: 0;
        color: #fff;
    }
    .search_wrap .form-control {
        background-color: transparent;
        border-bottom: 2px solid #fff;
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-radius: 0;
        padding: 10px 0;
        color: #fff;
    }
    .search_wrap .form-control::-webkit-input-placeholder {
        color:#ffffff;
    }
    .search_wrap .form-control::-moz-placeholder {
        color:#ffffff;
    }
    .search_wrap .form-control:-ms-input-placeholder {
        color:#ffffff;
    }
    .search_wrap .form-control::-ms-input-placeholder {
        color:#ffffff;
    }
    .search_wrap .form-control::placeholder {
        color:#ffffff;
    }
    .close-search {
        font-size: 40px;
        color: #fff;
        cursor: pointer;
        position: absolute;
        right: 0;
        top: 25%;
    }
    .navbar .attr-nav li .search_trigger i {
        font-size: 20px;
        vertical-align: middle;
        line-height: normal;
    }
    .navbar .attr-nav li.cart_wrap .nav-link i {
        font-size: 20px;
    }
    .navbar .attr-nav li.cart_wrap .nav-link {
        padding: 35px 5px;
    }
    .navbar .attr-nav li .nav-link.sidetoggle i {
        font-size: 28px;
    }
    .pr_search_icon {
        float: right;
    }
    .pr_search_trigger.show i::before {
        content: "\ec2a";
    }
    .pr_search_trigger {
        padding: 17px 10px;
        font-size: 20px;
    }
    .header_wrap.fixed-top {
        position: relative;
        padding-right: 0 !important;
    }
    .header_wrap.transparent_header {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        z-index: 1030;
    }
    .header_wrap.nav-fixed {
        box-shadow:  0 0 5px rgba(0,0,0,0.15);
        position: fixed;
        right: 0;
        left: 0;
        top: 0;
        z-index: 1041;
        -webkit-animation: slideInDown 0.65s cubic-bezier(0.23, 1, 0.32, 1);
        -moz-animation: slideInDown 0.65s cubic-bezier(0.23, 1, 0.32, 1);
        -o-animation: slideInDown 0.65s cubic-bezier(0.23, 1, 0.32, 1);
        animation: slideInDown 0.65s cubic-bezier(0.23, 1, 0.32, 1);
        -webkit-animation-fill-mode: none;
        -moz-animation-fill-mode: none;
        -o-animation-fill-mode: none;
        animation-fill-mode: none;
    }
    .nav-fixed.border_bottom_tran {
        border: 0;
    }
    .header_wrap.fixed-top.transparent_header.nav-fixed.no-sticky {
        position: absolute;
    }
    .header_wrap.fixed-top.nav-fixed.no-sticky {
        position: relative;
    }
    .header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header.nav-fixed.no-sticky {
        background-color: transparent;
        box-shadow: none;
    }
    .mega-menu {
        display: table;
        padding: 15px 0;
        width: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .mega-menu ul {
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .navbar .navbar-nav li.dropdown-mega-menu {
        position: static;
    }
    .navbar .navbar-nav li.dropdown-mega-menu .dropdown-menu {
        right: 0;
        padding-left: 0;
        padding-right: 0;
    }
    .mega-menu-col {
        border-right: 1px solid #ddd;
        padding: 0;
    }
    .mega-menu-col:last-child {
        border-right: 0 !important;
    }
    .dropdown-menu li a i {
        font-size: 14px;
        width: 20px;
        display: inline-block;
        vertical-align: middle;
    }
    .navbar .navbar-nav > li > .nav-link.cart_trigger i {
        font-size: 20px;
    }
    .cart_list li {
        list-style: outside none none;
    }
    .cart_count, .wishlist_count {
        position: relative;
        top: -3px;
        left: 0;
        font-size: 11px;
        background-color: #046a70;
        border-radius: 50px;
        height: 16px;
        line-height: 16px;
        color: #fff;
        min-width: 16px;
        text-align: center;
        padding: 0 5px;
        display: inline-block;
        vertical-align: top;
        margin-left: -5px;
        margin-right: -5px;
    }
    .cart_trigger .amount {
        margin-left: 8px;
        font-weight: 600;
        vertical-align: top;
        margin-right: -10px;
    }
    .navbar-nav .dropdown-menu.cart_box {
        width: 320px;
        position: absolute !important;
        -webkit-transform: scale(0) !important;
        transform: scale(0) !important;
        -webkit-transform-origin: -webkit-calc(100% - 30px) 0;
        transform-origin: calc(100% - 30px) 0;
        display: block;
        transition: all 0.25s ease-in-out;
        padding: 0;
        top: 100% !important;
        left: auto !important;
        right: 0;
    }
    .navbar-nav .dropdown-menu.cart_box.show {
        -webkit-transform: scale(1) !important;
        transform: scale(1) !important;
    }
    .cart_list li {
        border-bottom: 1px solid #3f3f3f;
        padding: 15px;
        width: 100%;
    }
    .item_remove {
        float: right;
        margin-left: 5px;
        color: #333 !important;
    }
    .cart_list img {
        border: 1px solid #ddd
        background-color: #ffffff;
        float: left;
        margin-right: 10px;
        max-width: 80px;
    }
    .cart_list a {
        font-size: 14px;
        vertical-align: top;
        padding: 0 !important;
        text-transform: capitalize;
        font-weight: 600;
    }
    .cart_quantity {
        color: #ffffff;
        display: table;
        margin-top: 5px;
        font-weight: 500;
    }
    .cart_total .cart_amount {
        float: right;
        color: #F32B56;
    }
    .cart_box .cart_list {
        width: 100%;
        padding: 0 !important;
        max-height: 242px;
        overflow-y: auto;
    }
    .cart_list li {
        display: inline-block;
        width: 100%;
    }
    .dropdown-menu .cart_list li a i {
        width: auto;
    }
    .cart_total {
        color: #ffffff;
        margin: 0;
        padding: 10px 15px;
        font-weight: 600;
        text-align: right;
    }
    .cart_total strong {
        float: left;
        font-weight: 600;
    }
    .cart_buttons {
        margin: 0;
        padding: 10px 15px 20px;
        text-align: center;
    }
    .cart_buttons .view-cart, .cart_buttons .checkout {
        padding: 8px 20px !important;
    }
    .top-header {
        border-bottom: 1px solid #eee;
    }
    .top-header.light_skin {
        border-color: rgba(255,255,255,0.2);
    }
    .top-header {
        padding: 10px 0;
        transition: all 0.5s ease-in-out;
    }
    .top-header[class*="bg_"], .top-header[class*="bg-"] {
        border: 0;
    }
    .top-header span {
        font-size: 14px;
        vertical-align: middle;
    }
    .header_wrap .social_icons li {
        padding-bottom: 0;
    }
    .social_icons, .contact_detail {
        font-size: 0;
    }
    .contact_detail > li:last-child,
    .header_list > li:last-child {
        padding-right: 0;
    }
    .social_icons li {
        display: inline-block;
        padding: 0px 5px 5px 0;
    }
    .social_icons li a {
        font-size: 18px;
        color: #687188;
        height: 36px;
        width: 36px;
        line-height: 36px;
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        overflow: hidden;
    }
    .social_icons li a:hover, 
    .header_wrap .social_icons li a:hover {
        color: #046a70;
    }
    .social_icons.social_small li a {
        height: 25px;
        width: 25px;
        line-height: 26px;
        font-size: 16px;
    }
    .social_white .social_icons li a, .social_white.social_icons li a,
    .header_wrap .social_white .social_icons li a, .header_wrap .social_white.social_icons li a {
        color: #fff;
        border-color: #fff;
    }
    .social_white .social_icons li a:hover, .social_white.social_icons li a:hover {
        color: #046a70;
    }
    .border_social .social_icons li a:hover, .border_social.social_icons li a:hover {
        background-color: #046a70;
        border-color: #046a70;
        color: #fff;
    }
    .border_social.social_white .social_icons li a:hover, .social_white.border_social.social_icons li a:hover {
        color: #fff;
    }
    .border_social li a {
        border: 1px solid #687188;
        line-height: 35px;
    }
    .social_icons li:last-child a {
        margin-right: 0px;
    }
    .radius_social li a {
        border-radius: 5px;
    }
    .rounded_social li a {
        border-radius: 50px;
    }
    .social_icons.social_style1 li a {
        background-color: #fff;
        color: #046a70;
    }
    .social_icons.social_style1 li a:hover {
        background-color: #046a70;
        color: #fff !important;
    }
    .social_style2 li a {
        background-color: #FFF;
        box-shadow: 0 0px 2px 0 rgba(0, 0, 0, 0.3);
    }
    .social_style3 li a {
        background-color: #F6F8F9;
        color: #B2B2B7;
        font-size: 20px;
        height: 50px;
        width: 50px;
        line-height: 50px;
    }
    .social_style4 li a {
        background-color: #fff;
        color: #046a70;
    }
    .social_style4 li a:hover {
        background-color: #046a70;
        color: #fff;
    }
    .social_style4 li a:hover {
        background-color: #046a70;
        color: #fff !important;
    }
    .vertical_social li {
        display: block;
    }
    .header_wrap .social_icons li a {
        color: #333;
    }
    .contact_detail i {
        margin-right: 10px;
        vertical-align: middle;
        font-size: 16px;
    }
    .contact_detail span {
        vertical-align: middle;
    }
    .contact_detail > li,
    .header_list > li {
        color: #333;
        font-size: 14px;
        vertical-align: middle;
        display: inline-block;
        padding: 2px 15px 2px 0;
    }
    .header_list > li i {
        margin-right: 6px;
        vertical-align: middle;
    }
    .icon_list > li {
        color: #333;
        vertical-align: middle;
        display: inline-block;
        padding: 2px 10px 2px 0;
    }
    .icon_list > li > i {
        font-size: 16px;
    }
    .icon_list > li a {
        color: #bfbfbf;
    }
    .header_list > li .dropdown-item:hover,
    .custome_dropdown .ddChild li:hover,
    .contact_detail > li a:hover {
        color: #F32B56;
    }
    .header_dropdown .dropdown-menu {
        border-radius: 0;
        padding: 0;
        margin-top: 0px;
        border: 0;
        transform: none !important;
        top: 100% !important;
        will-change: auto !important;
    }
    .header_dropdown .dropdown-menu[x-placement^="bottom"], .dropdown-menu[x-placement^="left"], .dropdown-menu[x-placement^="right"], .dropdown-menu[x-placement^="top"] {
        right: 0;
        left: auto !important;
    }
    .header_dropdown .dropdown-item {
        padding: 5px 10px;
        border-bottom: 1px solid #e6e6e6;
        text-transform: capitalize;
    }
    .contact_detail li:first-child {
        margin-left: 0px;
    }
    .contact_detail li a span {
        vertical-align: middle;
    }
    .top-header.light_skin .contact_detail li,
    .top-header.light_skin .contact_detail li a,
    .top-header.light_skin .widget_text span {
        color: #fff;
    }
    .top-header.dark_skin .contact_detail li {
        color: #000;
    }
    .nav-fixed .top-header,
    .nav-fixed .middle-header {
        display: none !important;
    }
    .navbar-toggler {
        float: right;
        margin: 13px 0 0 3px;
        font-size: 28px;
        color: #333;
        transition: all 0.5s ease 0s;
        border-radius: 0;
        height: 35px;
        width: 35px;
        padding: 0;
        line-height: 36px;
        transition: none;
    }
    .navbar-toggler[aria-expanded="true"] span::before {
        content: "\f129";
        font-size: 16px;
    }
    .navbar-toggler[aria-expanded="true"] {
        line-height: 32px;
        font-size: 20px;
    }
    header .attr-nav + .social_icons {
        border-left: 1px solid #333;
        margin-left: 5px;
        padding-left: 5px;
    }
    header .attr-nav + .social_icons li {
        padding: 0;
    }
    header.light_skin .attr-nav + .social_icons {
        border-color: #fff;
    }
    header.light_skin.nav-fixed .attr-nav + .social_icons {
        border-color: #333;
    }
    header.light_skin.nav-fixed .social_icons li a {
        color: #000;
    }
    header.light_skin.nav-fixed .social_icons li a:hover {
        color: #0E93D8;
    }
    .search_box {
        position: relative;
    }
    .search_box input {
        padding-right: 30px;
    }
    .search_box button {
        border: 0;
        padding: 0 10px;
        background-color: transparent;
        font-size: 22px;
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        cursor: pointer;
    }
    .top-header.light_skin .header_list li a,
    .top-header.light_skin .ddArrow::before,
    .top-header.light_skin .ddcommon .ddTitle .ddlabel,
    .light_skin.top-header span,
    .light_skin .icon_list > li a {
        color: #fff;
    }
    .top-header.light_skin .header_list > li::before {
        background-color: #fff;
    }
    .top-header .custome_dropdown .ddChild {
        background-color: #fff;
        border: 0 !important;
        min-width: 10rem;
        left: -10px;
    }
    .top-header.light_skin .header_list li a:hover, 
    .top-header.light_skin .contact_detail li a:hover, 
    .top-header.light_skin .header_list li a:hover span {
        color: #046a70;
    }
    .main_menu_uppercase .navbar-nav > li > .nav-link {
        text-transform: uppercase;
    }
    .main_menu_weight_100 .navbar .navbar-nav > li > .nav-link {
        font-weight: 100;
    }
    .main_menu_weight_200 .navbar .navbar-nav > li > .nav-link {
        font-weight: 200;
    }
    .main_menu_weight_300 .navbar .navbar-nav > li > .nav-link {
        font-weight: 300;
    }
    .main_menu_weight_400 .navbar .navbar-nav > li > .nav-link {
        font-weight: 400;
    }
    .main_menu_weight_500 .navbar .navbar-nav > li > .nav-link {
        font-weight: 500;
    }
    .main_menu_weight_600 .navbar .navbar-nav > li > .nav-link {
        font-weight: 600;
    }
    .main_menu_weight_700 .navbar .navbar-nav > li > .nav-link {
        font-weight: 700;
    }
    .main_menu_weight_800 .navbar .navbar-nav > li > .nav-link {
        font-weight: 800;
    }
    .main_menu_weight_900 .navbar .navbar-nav > li > .nav-link {
        font-weight: 900;
    }
    .main_menu_size_16 .navbar .navbar-nav > li > .nav-link,
    .dd_menu_size_16 .navbar .navbar-nav .dropdown-item,
    .dd_menu_size_16 .cart_list a {
        font-size: 16px;
    }
    .header_banner_wrap {
        padding: 15px;
        height: 100%;
    }
    .header-banner2 {
        margin: 0 15px;
    }
    .header-banner,
    .header-banner2 {
        display: block;
        position: relative;
        margin-bottom: 15px;
    }
    .header-banner img {
        width: 100%;
    }
    .banne_info {
        position: absolute;
        right: 0;
        top: 50%;
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        padding: 15px;
    }
    .banne_info a {
        text-transform: capitalize;
        position: relative;
        padding-bottom: 3px;
        color: #292b2c !important;
    }
    .banne_info a:hover {
        color: #046a70 !important;
    }
    .banne_info a::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 1px;
        width: 50%;
        background-color: #292B2C;
        transition: all 0.5s ease-in-out;
    }
    .banne_info a:hover::before {
        width: 100%;
    }
    .header_banner {
        height: 100%;
        display: -ms-flexbox;
        display: flex;
        padding: 15px;
    }
    .header_banner_wrap .header_banner {
        -ms-flex-align: center;
        align-items: center;
    }
    .header_banner_content {
        position: relative;
    }
    .header_banner_text {
        color: #fff;
    }
    .header_banner_title {
        font-weight: bold;
        color: #fff;
        margin-bottom: 15px;
    }
    .banner_img {
        position: relative;
    }
    .shop_bn_content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        z-index: 1; 
    }
    .shop_bn_content2 {
        position: absolute;
        bottom: 20px;
        left: 20px;
    }
    .shop_bn_content * {
        color: #fff;
    }
    .shop_title {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .shop_banner {
        position: relative;
        display: table;
        margin: 0 auto;
    }
    .shop_banner2 {
        margin-bottom: 30px;
        height: 235px;
        overflow: hidden;
    }
    .el_banner1 {
        background-color: #FDBB99;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }
    .el_img {
        text-align: center;
        width: 100%;
    }
    .shop_banner2 a {
        position: relative;
        z-index: 9;
        padding: 15px;
        height: 100%;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-line-pack: justify;
        align-content: space-between;
    }
    .el_title {
        width: 100%;
    }
    .el_banner1::before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -80px;
        background-color: rgba(255,255,255,0.2);
        width: 250px;
        height: 250px;
        border-radius: 100%;
        z-index: -1;
        -moz-transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    .el_banner2::before {
        content: "";
        position: absolute;
        right: -50px;
        bottom: -50px;
        background-color: rgba(255,255,255,0.15);
        width: 250px;
        height: 250px;
        border-radius: 100%;
        z-index: -1;
    }
    .el_banner2 .el_title h6 {
        font-weight: 600;
        font-size: 18px;
    }
    .el_banner1 .el_title span {
        font-size: 20px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .el_banner1 .el_img img {
        max-width: 180px;
        margin-top: 20px;
        width: 100%;
    }
    .el_banner2 {
        background-color: #53C0E9;
        text-align: right;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .shop_banner2:last-child {
        margin-bottom: 0;
    }
    .el_banner2 .el_img img {
        max-width: 165px;
        width: 100%;
    }
    .sidebar_menu {
        padding: 50px 30px 30px;
        position: fixed;
        top: 0;
        z-index: 99;
        background-color: #fff;
        box-shadow: -3px 0 3px rgba(0,0,0,.04);
        bottom: 0;
        width: 400px;
        overflow-y: auto;
        right: -400px;
        visibility: hidden;
        height: 100vh;
        transition: all 0.5s ease;
        z-index: 99999;
    }
    .sidebar_menu.active {
        right: 0;
        visibility: visible;
    }
    .side_panel_close {
        position: absolute;
        right: 30px;
        top: 30px;
    }
    .side_panel_close i {
        font-size: 24px;
    }
    .sidebar_menu .widget {
        margin-bottom: 20px;
        display: inline-block;
        width: 100%;
    }
    .sidebar_left .sidebar_menu,
    .sidebar_left_push .sidebar_menu {
        right: auto;
        left: -400px;
    }
    .sidebar_left .sidebar_menu.active,
    .sidebar_left_push .sidebar_menu.active {
        left: 0;
    }
    .sidebar_left_push.sidetoggle_active {
        overflow-y: hidden;
        left: 400px;
    }
    .sidebar_left_push {
        overflow-x: hidden;
        position: relative;
        transition: all 0.5s ease;
        left: 0;
    }
    .sidebar_left_push.sidetoggle_active .header_wrap.nav-fixed {
        left: 400px;
        right: -400px;
    }
    .sidebar_right_push.sidetoggle_active {
        overflow-y: hidden;
        right: 400px;
    }
    .sidebar_right_push {
        overflow-x: hidden;
        position: relative;
        transition: all 0.5s ease;
        right: 0;
    }
    .sidebar_right_push.sidetoggle_active .header_wrap.nav-fixed {
        left: -400px;
        right: 400px;
    }
    .sidebar_dark {
        background-color: #222;
    }
    .sidebar_dark .sidemenu_close,
    .sidebar_dark p {
        color: #fff;
    }
    .header-overlay {
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        top: 0;
        transition: all 0.5s ease-in-out;
        cursor: url("../images/close.png"), pointer;
    }
    body.active {
        overflow: hidden;
        padding-right: 17px;
    }
    .sidetoggle_icon {
        width: 22px;
        display: block;
        margin: 10px 0;
        position: relative;
        transition: all 0.5s ease-in-out;
        height: 1px;
    }
    .sidetoggle_icon::before {
        content: "";
        background-color: #333;
        display: block;
        height: 1px;
        width: 100%;
        position: absolute;
        top: -7px;
        right: 0;
        transition-duration: .3s,.3s;
        transition-delay: .3s,0s;
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    .sidetoggle_icon::after {
        content: "";
        background-color: #333;
        display: block;
        height: 1px;
        width: 15px;
        position: absolute;
        bottom: -7px;
        right: 0;
        transition-duration: .3s,.3s;
        transition-delay: .3s,0s;
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    .sidetoggle.open .sidetoggle_icon::before {
        top: 0;
        -moz-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        transition-property: top,transform;
        transition-delay: 0s,.3s;
    }
    .sidetoggle.open .sidetoggle_icon::after {
        bottom: 0;
        -moz-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        transition-delay: 0s,.3s;
        transition-property: bottom,transform;
        width: 100%;
    }
    .toggle_center_line {
        background-color: #333;
        height: 1px;
        width: 100%;
        display: block;
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        transition: all 0.6s ease-in-out;
    }
    .sidetoggle.open .toggle_center_line {
        opacity: 0;
    }
    .sidetoggle_icon:hover:after {
        width: 22px;
    }
    .widget_text p:last-child {
        margin-bottom: 0;
    }
    .widget_contact_info .contact_wrap li:last-child {
        margin-bottom: 0;
    }
    .hover_menu_style1 .navbar-collapse .navbar-nav > li > a {
        position: relative;
        padding: 30px 0px;
        margin: 0 10px;
    }
    .hover_menu_style1.nav-fixed .navbar .navbar-collapse .navbar-nav > li > .nav-link {
        padding: 20px 0px;
    }
    .hover_menu_style1 .navbar-collapse .navbar-nav > li > a::before {
        display: block;
        position: absolute;
        bottom: 20px;
        right: 0px;
        height: 2px;
        width: 0;
        z-index: 0;
        content: '';
        background-color: #046a70;
        transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
    }
    .hover_menu_style1.nav-fixed .navbar-collapse .navbar-nav > li > a::before {
        bottom: 10px;
    }
    .hover_menu_style1 .navbar-collapse .navbar-nav > li:hover > a::before,
    .hover_menu_style1 .navbar-collapse .navbar-nav > li > a.active::before {
        left: 0;
        right: auto;
        width: 100%;
    }
    input.text {
        display: none;
    }
    .dd.ddcommon {
        cursor: pointer;
        padding-right: 10px;
        position: relative;
        width: auto !important;
        outline: none;
    }
    .ddcommon .ddTitleText img {
        border-radius: 100%;
        height: 16px;
        width: 16px;
        margin-right: 6px;
    }
    .ddcommon .ddTitleText {
        padding: 5px 7px 5px 10px;
        display: inline-block;
        text-transform: uppercase;
    }
    .ddcommon .ddlabel {
        text-transform: capitalize;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
        vertical-align: middle;
    }
    .ddcommon .ddChild li .ddlabel {
        color: #333;
    }
    .ddArrow::before {
        content: "\f3d0";
        color: #878787;
        font-family: ionicons;
        position: absolute;
        right: 0;
        top: 6px;
    }
    .ddcommon .ddChild {
        background-color: #fff;
        height: auto !important;
        -webkit-transform: scale(0.75) translateY(-21px);
        -ms-transform: scale(0.75) translateY(-21px);
        transform: scale(0.75) translateY(-21px);
        -webkit-transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;
        transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;
        display: block !important;
        opacity: 0;
        visibility: hidden !important;
        left: 0;
    }
    .ddcommon.borderRadiusTp .ddChild {
        opacity: 1;
        visibility: visible !important;
        -webkit-transform: scale(1) translateY(0);
        -ms-transform: scale(1) translateY(0);
        transform: scale(1) translateY(0);
    }
    .ddcommon .ddChild li {
        cursor: pointer;
        line-height: normal;
        list-style: outside none none;
        padding: 5px 10px 5px 10px;
        position: relative;
    }
    .lng_dropdown .ddcommon .ddChild li {
        padding-left: 33px;
    }
    .ddcommon .ddChild li img {
        position: absolute;
        left: 10px;
        border-radius: 100%;
        max-width: 16px;
        top: 12px;
    }
    .nav_block {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .categories_wrap {
        position: relative;
    }
    .categories_btn i {
        font-size: 24px;
        vertical-align: middle;
        margin-right: 10px;
    }
    .categories_menu i {
        margin-right: 0;
        float: right;
    }
    .categories_btn.categories_menu {
        padding: 12px 15px;
        border-radius: 4px;
    }
    .categories_btn span {
        vertical-align: middle;
        text-transform: uppercase;
        font-weight: 500;
    }
    .categories_btn {
        background-color: #046a70;
        border: 1px solid #046a70;
        padding: 20px 15px;
        color: #fff;
        text-align: left;
        width: 100%;
    }
    #navCatContent li {
        list-style: none;
    }
    #navCatContent {
        background-color: #fff;
        position: absolute;
        padding: 5px 0px 0;
        top: 100%;
        width: 100%;
        left: 0;
        right: 0;
        box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
        z-index: 99;
    }
    .nav_cat {
        display: block;
        height: auto !important;
    }
    .nav_cat.collapse:not(.show) {
        display: block;
    }
    #navCatContent ul {
        width: 100%;
    }
    #navCatContent li a {
        text-transform: capitalize;
        font-size: 14px;
    }
    #navCatContent li a i {
        font-size: 22px;
        vertical-align: middle;
        margin-right: 10px;
        line-height: 30px;
    }
    #navCatContent li a span {
        vertical-align: middle;
    }
    #navCatContent li a:hover {
        color: #046a70;
    }
    #navCatContent li a.dropdown-toggler::after {
        position: absolute;
        right: 15px;
        top: 15px;
    }
    #navCatContent ul li .dropdown-menu {
        left: 100%;
        top: 0;
        margin: 0;
        border: 0;
        min-width: 800px;
        width: 100%;
        right: 0;
        box-shadow: 10px 16px 49px 0px rgba(38,42,46,0.05);
        border-radius: 0;
        padding: 0;
    }
    #navCatContent ul li .dropdown-menu .dropdown-header {
        color: #333;
        padding: 10px 15px;
        text-transform: uppercase;
        font-weight: bold;
    }
    #navCatContent .mega-menu-col {
        border: 0;
    }
    #navCatContent li {
        position: relative;
    }
    #navCatContent .dropdown-menu li a.dropdown-toggler::after {
        top: 10px;
    }
    #navCatContent ul li .dropdown-menu .dropdown-menu {
        min-width: 12rem;
        width: 100%;
    }
    .more_categories {
        padding: 12px 15px;
        display: block;
        font-size: 16px;
        color: #046a70;
        border-top: 1px solid #ddd;
        margin-top: 5px;
        position: relative;
        cursor: pointer;
        width: 100%;
    }
    .more_categories::before {
        content: "\ec36";
        position: absolute;
        right: 15px;
        top: 50%;
        font-family: Linearicons;
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .more_categories.show::before {
        content: "\ec37";
    }
    .product_search_form {
        position: relative;
        max-width: 600px;
        width: 100%;
    }
    .product_search_form input {
        height: 50px;
        padding-right: 60px !important;
    }
    .search_form_btn .form-control {
        padding-right: 120px !important;
    }
    .search_btn {
        position: absolute;
        right: 1px;
        background-color: #fff;
        border: 0;
        padding: 0px 15px;
        font-size: 20px;
        top: 1px;
        bottom: 1px;
        z-index: 9;
    }
    .search_btn2 {
        position: absolute;
        right: 5px;
        background-color: #046a70;
        border: 0;
        border-radius: 100%;
        font-size: 14px;
        top: 5px;
        color: #fff;
        z-index: 9;
        width: 40px;
        height: 40px;
        z-index: 9;
    }
    .search_btn3 {
        background-color: #046a70;
        color: #fff;
        border: 0;
        padding: 10px 30px;
        position: absolute;
        right: 0;
        bottom: 0;
        top: 0;
        z-index: 9;
    }
    .search_btn3:hover {
        background-color: #333;
    }
    .search_btn:hover {
        color: #046a70;
    }
    .search_btn i {
        vertical-align: middle;
    }
    .product_search_form select {
        max-width: 160px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product_search_form.rounded_input select {
        border-radius: 30px 0 0 30px;
        padding: 8px 35px 8px 15px;
    }
    .product_search_form.rounded_input input {
        border-radius: 0 30px 30px 0 !important;
    }
    .product_search_form.radius_input {
        border-radius: 4px;
        overflow: hidden;
    }
    .product_search_form.radius_input select {
        border-radius: 4px 0 0 4px;
    }
    .product_search_form.radius_input input {
        border-radius: 0 4px 4px 0 !important;
    }
    .header_offer {
        margin-right: 12px;
        padding-right: 12px;
        border-right: 1px solid #ddd;
    }
    .contact_phone span, .contact_phone i {
        vertical-align: middle;
    }
    .contact_phone i {
        font-size: 30px;
        margin-right: 10px;
        color: #046a70;
    }
    .contact_phone span {
        color: #16181b;
    }
    .banner_content_inner {
        padding: 50px;
    }
    .header_topbar_info {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: center;
        align-items: center;
    }
    .download_wrap {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
    }
    /*===================================*
    02.END HEADER STYLE
    *===================================*/
</style>

<div class="aiz-user-sidenav-wrap pt-4 position-relative z-1 shadow-sm">
    <div class="absolute-top-right d-xl-none">
        <button class="btn btn-sm p-2" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <i class="las la-times la-2x"></i>
        </button>
    </div>
    <div class="absolute-top-left d-xl-none">
        <a class="btn btn-sm p-2" href="{{ route('logout') }}">
            <i class="las la-sign-out-alt la-2x"></i>
        </a>
    </div>
    <div class="aiz-user-sidenav rounded overflow-hidden  c-scrollbar-light">
        <div class="px-4 text-center mb-4">
            <span class="avatar avatar-md mb-3">
                @if (Auth::user()->avatar_original != null)
                    <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif
            </span>

            @if(Auth::user()->user_type == 'customer')
                <h4 class="h5 fw-600">{{ Auth::user()->name }}</h4>
            @else
                <h4 class="h5 fw-600">{{ Auth::user()->name }}
                    <span class="ml-2">
                        @if(Auth::user()->seller->verification_status == 1)
                            <i class="las la-check-circle" style="color:green"></i>
                        @else
                            <i class="las la-times-circle" style="color:red"></i>
                        @endif
                    </span>
                </h4>
            @endif
        </div>

        <div class="sidemnenu mb-3">
            <ul class="aiz-side-nav-list" data-toggle="aiz-side-menu">

                <li class="aiz-side-nav-item">
                    <a href="{{ route('dashboard') }}" class="aiz-side-nav-link {{ areActiveRoutes(['dashboard'])}}">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                @php
                    $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                    $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                @endphp
                <li class="aiz-side-nav-item">
                    <a href="{{ route('purchase_history.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['purchase_history.index'])}}">
                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Purchase History') }}</span>
                        @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="badge badge-inline badge-success">{{ translate('New') }}</span>@endif
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('digital_purchase_history.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['digital_purchase_history.index'])}}">
                        <i class="las la-download aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Downloads') }}</span>
                    </a>
                </li>

                @php
                    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                    $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                @endphp
                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('customer_refund_request') }}" class="aiz-side-nav-link {{ areActiveRoutes(['customer_refund_request'])}}">
                            <i class="las la-backward aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Sent Refund Request') }}</span>
                        </a>
                    </li>
                @endif

                <li class="aiz-side-nav-item">
                    <a href="{{ route('wishlists.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['wishlists.index'])}}">
                        <i class="la la-heart-o aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Wishlist') }}</span>
                    </a>
                </li>

                @if(Auth::user()->user_type == 'seller')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('seller.products') }}" class="aiz-side-nav-link {{ areActiveRoutes(['seller.products', 'seller.products.upload', 'seller.products.edit'])}}">
                            <i class="lab la-sketch aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Products') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{route('product_bulk_upload.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['product_bulk_upload.index'])}}">
                            <i class="las la-upload aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Product Bulk Upload') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('seller.digitalproducts') }}" class="aiz-side-nav-link {{ areActiveRoutes(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit'])}}">
                            <i class="lab la-sketch aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Digital Products') }}</span>
                        </a>
                    </li>
                @endif

                @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('customer_products.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                            <i class="lab la-sketch aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Classified Products') }}</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type == 'seller')
                    @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                        @if (\App\BusinessSetting::where('type', 'pos_activation_for_seller')->first() != null && \App\BusinessSetting::where('type', 'pos_activation_for_seller')->first()->value != 0)
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('poin-of-sales.seller_index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['poin-of-sales.seller_index'])}}">
                                    <i class="las la-fax aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">{{ translate('POS Manager') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php
                        $orders = DB::table('orders')
                                    ->orderBy('code', 'desc')
                                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                    ->where('order_details.seller_id', Auth::user()->id)
                                    ->where('orders.viewed', 0)
                                    ->select('orders.id')
                                    ->distinct()
                                    ->count();
                    @endphp
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('orders.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['orders.index'])}}">
                            <i class="las la-money-bill aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Orders') }}</span>
                            @if($orders > 0)<span class="badge badge-inline badge-success">{{ $orders }}</span>@endif
                        </a>
                    </li>

                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('vendor_refund_request') }}" class="aiz-side-nav-link {{ areActiveRoutes(['vendor_refund_request','reason_show'])}}">
                                <i class="las la-backward aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text">{{ translate('Received Refund Request') }}</span>
                            </a>
                        </li>
                    @endif

                    @php
                        $review_count = DB::table('reviews')
                                    ->orderBy('code', 'desc')
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.user_id', Auth::user()->id)
                                    ->where('reviews.viewed', 0)
                                    ->select('reviews.id')
                                    ->distinct()
                                    ->count();
                    @endphp
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('reviews.seller') }}" class="aiz-side-nav-link {{ areActiveRoutes(['reviews.seller'])}}">
                            <i class="las la-star-half-alt aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Product Reviews') }}</span>
                            @if($review_count > 0)<span class="badge badge-inline badge-success">{{ $review_count }}</span>@endif
                        </a>
                    </li>

                    <li class="aiz-side-nav-item">
                        <a href="{{ route('shops.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['shops.index'])}}">
                            <i class="las la-cog aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Shop Setting') }}</span>
                        </a>
                    </li>

                    <li class="aiz-side-nav-item">
                        <a href="{{ route('payments.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['payments.index'])}}">
                            <i class="las la-history aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Payment History') }}</span>
                        </a>
                    </li>

                    <li class="aiz-side-nav-item">
                        <a href="{{ route('withdraw_requests.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['withdraw_requests.index'])}}">
                            <i class="las la-money-bill-wave-alt aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Money Withdraw') }}</span>
                        </a>
                    </li>
                    
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('commission-log.index') }}" class="aiz-side-nav-link">
                            <i class="las la-file-alt aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Commission History') }}</span>
                        </a>
                    </li>

                @endif

                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                    @php
                        $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                    @endphp
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('conversations.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['conversations.index', 'conversations.show'])}}">
                            <i class="las la-comment aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Conversations') }}</span>
                            @if (count($conversation) > 0)
                                <span class="badge badge-success">({{ count($conversation) }})</span>
                            @endif
                        </a>
                    </li>
                @endif


                @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('wallet.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['wallet.index'])}}">
                            <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('My Wallet')}}</span>
                        </a>
                    </li>
                @endif

                @if ($club_point_addon != null && $club_point_addon->activated == 1)
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('earnng_point_for_user') }}" class="aiz-side-nav-link {{ areActiveRoutes(['earnng_point_for_user'])}}">
                            <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('Earning Points')}}</span>
                        </a>
                    </li>
                @endif

                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                    <li class="aiz-side-nav-item">
                        <a href="javascript:void(0);" class="aiz-side-nav-link {{ areActiveRoutes(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                            <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Affiliate') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.user.index') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Affiliate System') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.user.payment_history') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Payment History') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.user.withdraw_request_history') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Withdraw request history') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @php
                    $support_ticket = DB::table('tickets')
                                ->where('client_viewed', 0)
                                ->where('user_id', Auth::user()->id)
                                ->count();
                @endphp

                <li class="aiz-side-nav-item">
                    <a href="{{ route('support_ticket.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['support_ticket.index'])}}">
                        <i class="las la-atom aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{translate('Support Ticket')}}</span>
                        @if($support_ticket > 0)<span class="badge badge-inline badge-success">{{ $support_ticket }}</span> @endif
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('profile') }}" class="aiz-side-nav-link {{ areActiveRoutes(['profile'])}}">
                        <i class="las la-user aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{translate('Manage Profile')}}</span>
                    </a>
                </li>

            </ul>
        </div>
        @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && Auth::user()->user_type == 'customer')
            <div>
                <a href="{{ route('shops.create') }}" class="btn btn-block btn-soft-primary rounded-0">
                    </i>{{ translate('Be A Seller') }}
                </a>
            </div>
        @endif
        @if(Auth::user()->user_type == 'seller')
          <hr>
          <h4 class="h5 fw-600 text-center">{{ translate('Sold Amount')}}</h4>
          <!-- <div class="sidebar-widget-title py-3">
              <span></span>
          </div> -->
          @php
              $date = date("Y-m-d");
              $days_ago_30 = date('Y-m-d', strtotime('-30 days', strtotime($date)));
              $days_ago_60 = date('Y-m-d', strtotime('-60 days', strtotime($date)));
          @endphp
          <div class="widget-balance pb-3 pt-1">
            <div class="text-center">
                <div class="heading-4 strong-700 mb-4">
                    @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_30)->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                $total += $orderDetail->price;
                            }
                        }
                    @endphp
                    <small class="d-block fs-12 mb-2">{{ translate('Your sold amount (current month)')}}</small>
                    <span class="btn btn-primary fw-600 fs-18">{{ single_price($total) }}</span>
                </div>
                <table class="table table-borderless">
                    <tr>
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                            $total = 0;
                            foreach ($orderDetails as $key => $orderDetail) {
                                if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                    $total += $orderDetail->price;
                                }
                            }
                        @endphp
                        <td class="p-1" width="60%">
                            {{ translate('Total Sold')}}:
                        </td>
                        <td class="p-1 fw-600" width="40%">
                            {{ single_price($total) }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_60)->where('created_at', '<=', $days_ago_30)->get();
                            $total = 0;
                            foreach ($orderDetails as $key => $orderDetail) {
                                if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                    $total += $orderDetail->price;
                                }
                            }
                        @endphp
                        <td class="p-1" width="60%">
                            {{ translate('Last Month Sold')}}:
                        </td>
                        <td class="p-1 fw-600" width="40%">
                            {{ single_price($total) }}
                        </td>
                    </tr>
                </table>
            </div>
            <table>

            </table>
        </div>
        @endif

    </div>
</div>

