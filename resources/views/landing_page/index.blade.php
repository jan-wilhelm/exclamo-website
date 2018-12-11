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
				<b-container fluid class="py-2">
					<b-navbar-brand href="{{ route('home') }}" class="mr-md-5">
						<img src="{{ asset('img/logo/logo_text_rounded.png') }}" height="35px">
					</b-navbar-brand>
					<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

					<b-collapse is-nav id="nav_collapse">

						<b-navbar-nav class="mx-auto" id="nav-links">
							<li class="nav-item"><a class="nav-link" href="#vision">@lang('landing_page.vision')</a></li>
							<li class="nav-item"><a class="nav-link" href="#what">@lang('landing_page.what')</a></li>
							<li class="nav-item"><a class="nav-link" href="#forschools">@lang('landing_page.for_schools')</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">@lang('landing_page.faq')</a></li>
							<li class="nav-item"><a class="nav-link" href="#team">@lang('landing_page.who')</a></li>
						</b-navbar-nav>

						<!-- Right aligned nav items -->
						<b-navbar-nav>
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
							<li class="nav-item">
								<a href="#forschools" class="nav-link cta cta-primary">
									@lang('landing_page.use_exclamo')
								</a>
							</li>
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
				<section class="mt-5 back-gradient back-borders row">
					<div class="col-lg-7 p-md-5 my-auto">
						<div class="col-12 pl-1 py-4 pr-0">
							<h1 class="mt-lg-4">Die App für Schulen gegen Mobbing</h1>
							<div class="mt-4 font-weight-medium">
								Mit einem einzigartigen Ansatz helfen wir Schulen, Mobbing zu
								bekämpfen: Ihre Schüler wenden sich per exclamo an
								ausgewählte Lehrer und professionelle Mobbing-Experten und
								erhalten so schnelle und anonyme Hilfe!
							</div>
							<div>
								<a href="#forschools" class="cta cta-primary">
									Jetzt Ihre Schule anmelden!
								</a>
								<a href="#what" class="d-inline-block p-3">&#9658 Warum exclamo?</a>
							</div>
						</div>
					</div>
					<div class="col-lg-5 p-0 m-0" id="image-placeholder">
						<img src="/img/iPhoneCases.png">
					</div>
				</section>
				<section class="row">
					<div class="pt-5 col-lg-6">
						<h1><i class="far fa-lightbulb"></i> Unsere Vision</h1>
						<div class="font-weight-medium d-flex flex-column align-items-start">
							Wir haben die Vision von Schulen, in denen jeder Schüler jeden anderen
							Schüler gleichwertig und respektvoll behandelt. Deshalb kämpfen wir
							gegen Rassismus, Sexismus, Antisemitismus und alle anderen Formen der
							Diskriminierung.
							Wir hoffen, dass wir auch Sie für den Kampf gegen Mobbing begeistern
							können!
							<a href="#forschools" class="mt-2 cta cta-primary">
								Jetzt Ihre Schule anmelden!
							</a>
						</div>
					</div>
					<div class="pt-5 col-lg-6">
						<h1><i class="far fa-newspaper"></i> Aktuelles</h1>
						<div class="font-weight-medium d-flex flex-column align-items-stretch">
							<div class="news-article col-12">
								Testphase mit dem Canisius Kolleg in Berlin
							</div>
						</div>
					</div>
				</section>
				<h1 class="underlined mb-3">Was ist exclamo?</h1>
				<section class="row back-gradient back-borders p-md-5">
					<div class="col-12">
						
					</div>
				</section>
			</div>

		</div>
		@include('layouts.footer')
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush