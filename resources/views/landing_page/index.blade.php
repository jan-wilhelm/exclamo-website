@extends("layouts/html")

@section('head')
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
    <link rel="stylesheet" href="css/aos.css" />
@endsection

@section("body")
	<div class="w-100 h-100" id="app">
		<div id="app-content" v-cloak>
			<b-navbar toggleable="xl" class="white fixed-lg-top back-gradient">
				<b-container class="py-2">
					<b-navbar-brand href="{{ route('home') }}" class="mr-md-5">
						<img src="{{ asset('img/logo/logo_text_rounded.png') }}" height="35px">
					</b-navbar-brand>
					<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

					<b-collapse is-nav id="nav_collapse">

						<b-navbar-nav class="mr-auto" id="nav-links">
							<li class="nav-item"><a class="nav-link" href="#vision">@lang('landing_page.vision')</a></li>
							<li class="nav-item"><a class="nav-link" href="#what">@lang('landing_page.what')</a></li>
							<li class="nav-item"><a class="nav-link" href="#forschools">@lang('landing_page.for_schools')</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">@lang('landing_page.faq')</a></li>
							<li class="nav-item"><a class="nav-link" href="#team">@lang('landing_page.who')</a></li>
						</b-navbar-nav>

						<!-- Right aligned nav items -->
						<b-navbar-nav class="ml-auto">
							<b-nav-item-dropdown right>
								<!-- Using button-content slot -->
								<template slot="button-content">
						        	<img 
							        	@if ( app()->getLocale() == 'de')
							        		src="{{ asset('img/germany_small.png') }}"
							        	@else
											src="{{ asset('img/uk_small.png') }}"
							        	@endif
						        	height="24px" width="40px">
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
							
							@guest
							<li class="nav-item">
								<a href="{{ route('login') }}" class="nav-link color-primary-0 mx-auto">
									@lang('messages.login')
								</a>
							</li>
							<a href="#forschools" class="nav-item cta cta-primary">
								@lang('landing_page.use_exclamo')
							</a>
							@else
							<li class="nav-item">
								<a href="{{ route('dashboard') }}" class="nav-item nav-link color-primary-0 mx-auto">
									@lang('landing_page.to_the_dashboard')
								</a>
							</li>
							@endguest
						</b-navbar-nav>
					</b-collapse>
				</b-container>
			</b-navbar>

			<div class="container">
				<section>awdawd</section>
			</div>

			@include('layouts.footer')
		</div>
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush