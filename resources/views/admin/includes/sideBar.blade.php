@php
$notifiction_unread = App\Models\Transaction::where('status','unread')->count();
$application_logo = App\Models\Setting::where('code','application_logo')->where('hidden','0')->first();
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    @if(!empty(@$application_logo->value))
                    <img src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}" alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important">
                    @else
                    <img src="{!! asset('storage/setting/default.png') !!}" alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important">
                    @endif
                    <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    @if(!empty(@$application_logo->value))
                    <img alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important" src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}">
                    @else
                    <img alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important" src="{!! asset('storage/setting/default.png') !!}">
                    @endif
                </div>
            </li>
            <li class="@if(Request::segment('2') == 'dashboard') active @endif" data-toggle="tooltip" title="Dashboard">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'promotions') active @endif" data-toggle="tooltip" title="Promotion">
                <a href="{{ route('admin.promotions.index') }}">
                    <i class="fa fa-bullhorn"></i>
                    <span class="nav-label">Promotion </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'exclusiveoffer') active @endif" data-toggle="tooltip" title="Exclusive Offer">
                <a href="{{ route('admin.exclusiveoffer.index') }}">
                    <i class="fa fa-gift"></i>
                    <span class="nav-label">Exclusive Offer </span>
                </a>
            </li>


            <li class="@if(Request::segment('2') == 'location') active @endif" data-toggle="tooltip" title="Location">
                <a href="{{ route('admin.location.index') }}">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-label">Location </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'token') active @endif" data-toggle="tooltip" title="Token">
                <a href="{{ route('admin.token.index') }}">
                    <i class="fa fa-arrows"></i>
                    <span class="nav-label">Token </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'notification') active @endif" data-toggle="tooltip" title="Notification">
                <a href="{{ route('admin.notification.index') }}">
                    <i class="fa fa-bell"></i>
                    <span class="nav-label">Notification </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'transaction') active @endif" data-toggle="tooltip" title="User Notification">
                <a href="{{ route('admin.transaction.index') }}">
                    <i class="fa fa-users"></i>
                    <span class="label label-warning float-right" style="border-radius: 10px;">{{@$notifiction_unread}}</span>
                    <span class="nav-label">User Notification </span>
                </a>
            </li>
            
           <li class="@if(Request::segment('2') == 'setting') active @endif" data-toggle="tooltip" title="Setting">
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-cog"></i>
                    <span class="nav-label">Setting </span>
                </a>
            </li>
            
        </ul>
    </div>
</nav>