<b-navbar toggleable="lg">
	<b-container>
		<b-navbar-brand href="{{ route('home') }}">
			<img src="{{ asset('img/logo_small.png') }}" width="50px">
			<span class="color-secondary-2-4">Exclamo</span>
		</b-navbar-brand>
		<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

		<b-collapse is-nav id="nav_collapse">

			<b-navbar-nav class="mr-auto">
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
			</b-navbar-nav>

			<!-- Right aligned nav items -->
			<b-navbar-nav class="ml-auto">
				<b-nav-item-dropdown right>
					<!-- Using button-content slot -->
					<template slot="button-content">
			        	<img src="
				        	@if ( app()->getLocale() == 'de')
				        		{{ asset('img/germany_small.png') }}
				        	@else
								{{ asset('img/uk_small.png') }}
				        	@endif
			        	" height="24px" width="40px">
					</template>
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
				</b-nav-item-dropdown>
				
				<li class="nav-item">
				@guest
					<div class="shadow-sm form-inline button-div  bg-color-primary-0 px-3 hover-white">
						<a href="{{ url('login') }}" class="text-white mx-auto">
							@lang('messages.login')
						</a>
					</div>
				@else
					<div class="shadow-sm form-inline button-div white mr-3 px-3 hover">
						<a href="{{ url('logout') }}" class="mx-auto">
							@lang('messages.logout')
						</a>
					</div>
				@endguest
				</li>
			</b-navbar-nav>
		</b-collapse>
	</b-container>
</b-navbar>