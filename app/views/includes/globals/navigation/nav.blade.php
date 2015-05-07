<a class="item">
    <img src="{{ asset('images/logo_transparent.png') }}" class="brand" >
</a>
<div class="ui menu">
    {{ HTML::linkClass('dashboard', '<i class="home icon"></i> Dashboard', 'item') }}
    {{ HTML::linkClass('settings', '<i class="configure icon"></i> Settings', 'item') }}
    {{ HTML::linkClass('logout', '<i class="external icon"></i> Logout', 'right item') }}
</div>