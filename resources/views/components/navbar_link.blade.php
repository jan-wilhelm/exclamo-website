<li class="nav-item {{ explode('.', Route::currentRouteName() )[0] == $route ? 'active' : '' }}">
	<a class="nav-link" href="{{ route($route) }}">{{ $slot }}</a>
 </li>