<div class="navbar-menu-wrapper d-flex flex-row align-items-center bg-primary">
    <button class="navbar-toggler" type="button"> <i class="fa fa-ellipsis-v"></i></button>
    <div class="navbar-search ml-lg-4">
        <form class="navbar-search-form" onsubmit="return false;">
            <div class="input-group align-items-center">
                <div class="search-icon"><span class="fa fa-search"></span></div>
                <input type="search" name="navbar_search" id="navbar_search" placeholder="Search any settings"
                    autocomplete="off">
            </div>
            <div id="navbar_search_result_area">
                <ul class="navbar_search_result"></ul>
            </div>
        </form>
    </div>

    <ul class="navbar-nav ml-auto flex-row">
        <div id="ex4">
            <a href="{{route('user.cart')}}" class="text-white">
                <span id="cart_count" class="p1 fa-stack fa-2x has-badge" data-count="0">
                    <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse"></i>
                </span>
            </a>
        </div>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="userProfileDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}"
                    alt="user-image">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userProfileDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i>
                    @lang('Profile')</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="{{ url('/') }}"><i class="fa fa-reply"></i>@lang('Home')</a>
                <a class="dropdown-item" href="{{ route('user.logout') }}"> <i
                        class="fa fa-sign-out"></i>@lang('Logout')</a>
            </div>
        </li>
    </ul>
</div>
