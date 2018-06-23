<nav class="navbar navbar-expand-lg navbar-light">
	<div class="container">
		  <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('img/logo_small.png') }}" width="50px"><span class="color-secondary-2-4">Exclamo</span></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					@navlink(["url"=>"/", "route"=>"home"])
						@lang('messages.home')
					@endnavlink

					@role('schueler')
						@include('navlinks.schueler')
					@endrole

					@role('lehrer')
						@include('navlinks.lehrer')
					@endrole

					@role('schulleiter')
						@include('navlinks.schulleiter')
					@endrole
					
					@role('admin')
						@include('navlinks.admin')
					@endrole

				</ul>

				<ul class="navbar-nav ml-auto nav-inline">
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				        	<img src="
					        	@if ( app()->getLocale() == 'de')
					        		{{ asset('img/germany_small.png') }}
					        	@else
									{{ asset('img/uk_small.png') }}
					        	@endif
				        	" height="24px" width="40px">
				        </a>
				        <div class="dropdown-menu" aria-labelledby="languageDropdown">
				        	<form action="{{ route('language') }}" method="post">
				        		@csrf
								@langoption(["locale"=>"de"])
									Deutsch
								@endlangoption
					        	<div class="dropdown-divider"></div>
								@langoption(["locale"=>"en"])
									English
								@endlangoption
							</form>
				        </div>
					</li>
					@guest
						<li class="nav-item">
							<div class="shadow-sm form-inline button-div  bg-color-primary-0 px-4 hover-white">
								<a href="{{ {{ url('login') }} }}" class="text-white">@lang('messages.login')</a>
							</div>
						</li>
					@else
						<li class="nav-item">
							<div class="shadow-sm form-inline button-div white mr-3 px-4 hover">
								<a href="{{ {{ url('logout') }} }}">@lang('messages.logout')</a>
							</div>
						</li>
					@endguest
				</ul>
		  </div>
	</div>
</nav>