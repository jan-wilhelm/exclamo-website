<li class="nav-item {{ explode('.', Request::route()->getName() )[0] == $route ? 'active' : '' }}">
	<a class="nav-link" href="{{ route($route) }}">{{ $slot }}</a>
 </li>