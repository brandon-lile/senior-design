<?php

HTML::macro('linkClass', function($route, $text, $extra_class = '', $extra_route = '[DEFAULT]', $extra_active_class = '')
{
    $extra_route = ($extra_route == null) ? '[DEFAULT]' : $extra_route;

    return preg_replace('!\s+!', ' ', '<a class="' . (Request::is($route . "*") || (Request::is($extra_route . "*"))  ? 'active ' . $extra_active_class . ' ' : '') . $extra_class .'" href="' . URL::to($route) . '">' . $text . '</a>');
});