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
							<a class="news-article mb-2 d-flex col-12 color-secondary" href="canisius.de">
								Testphase mit dem Canisius Kolleg in Berlin
							</a>
							<a class="news-article mb-2 d-flex col-12 color-secondary" href="canisius.de">
								Crowdfunding durch GoFundMe
							</a>
						</div>
					</div>
				</section>

				<h1 class="underlined mb-3">Was ist exclamo?</h1>
				<section class="back-gradient back-borders p-3 py-md-4 p-lg-5 d-flex flex-column">
					<div class="advantage">
						<h5 class="advantage-heading">
							<i class="fas fa-shield-alt"></i>
							Anonyme Nachrichten
						</h5>
						<p>
							Der Schüler kann, auch anonym, Nachrichten an Lehrer, Schüler-Mentoren oder
							Schulsozialarbeiter senden.
						</p>
					</div>
					<div class="advantage">
						<h5 class="advantage-heading">
							<i class="fas fa-file-alt"></i>
							Anonyme Nachrichten
						</h5>
						<p>
							Der Schüler kann in einem eigenen Notizbereiche Vorfälle für sich persönlich festhalten um die Ereignisse zu dokumentieren und reflektieren.
						</p>
					</div>
					<div class="advantage">
						<h5 class="advantage-heading">
							<i class="fas fa-users"></i>
							Professionelle Unterstützung
						</h5>
						<p>
							Wenn die betroffenen Person seelische Unterstützung benötigt, stehen außerdem die Nummer von Sorgentelefonen, sowie der Kontakt zur psychotherapeutischen KV-Terminservicestelle zur Verfügung.
						</p>
					</div>
					<div class="advantage">
						<h5 class="advantage-heading">
							<i class="fas fa-comments"></i>
							Material für Schüler und Lehrer
						</h5>
						<p>
							exclamo bietet Zugang zu Materialien zum Umgang mit Mobbing, die in ihrer gebündelter Form effektive Hilfsangebote für Lehrer und Schüler darstellen!
						</p>
					</div>
					<div class="advantage">
						<h5 class="advantage-heading">
							<i class="fas fa-check-circle"></i>
							Mobbingprävention
						</h5>
						<p>
							Durch eine so einfach Möglichkeit für Betroffene, Mobbing zu melden, wird die Hemmschwelle für Täter deutlich größer!	
						</p>
					</div>
					<div class="mx-auto">
						<span class="pr-3">Wir konnten Sie überzeugen?</span>
						<a href="#forschools" class="cta cta-primary">
							Melden Sie sich jetzt an!
						</a>
					</div>
				</section>

				<h1 class="underlined mb-3">Wer sind wir?</h1>
				<p class="font-weight-medium">
					Wir, das Team, sind Berliner Schüler und haben uns überlegt, wie man Mobbing am besten bekämpfen kann. Da das Handy eines der Alltagsgegenstände schlechthin ist, schien außer Frage, dass eine App das beste Format ist. Wir sind derzeit in unserem letzten Schuljahr und möchten anderen Schülern und ihren Schulen helfen, Mobbing zu bekämpfen.
				</p>
				<section class="row">
					<div class="col-md-4 px-3 mt-2">
						<img src="/img/kai.jpg" class="back-borders-small w-100 mb-3">
						<h3>Kai Lanz</h3>
					</div>
					<div class="col-md-4 px-3 mt-2">
						<img src="/img/jan.jpg" class="back-borders-one w-100 mb-3">
						<h3>Jan Wilhelm</h3>
					</div>
					<div class="col-md-4 px-3 mt-2">
						<img src="/img/julius.jpg" class="back-borders-two w-100 mb-3">
						<h3>Julius de Gruyter</h3>
					</div>
				</section>

				<section>
					<h1><i class="far fa-newspaper"></i> Bekannt aus</h1>
				</section>

				<section class="back-gradient-accent back-borders p-3 p-md-4 text-white">
					<h1 class="underlined mb-5">exclamo nutzen</h1>
					<form>
						<div class="form-group row">
							<label for="name-of-school" class="col-md-3 col-form-label">Name Ihrer Schule</label>
							<div class="col-md-9 col-lg-6">
								<input type="text" class="form-control" id="name-of-school" placeholder="Goethe-Gymnasium">
							</div>
						</div>
						<div class="form-group row">
							<label for="contact-name" class="col-md-3 col-form-label">Ansprechpartner</label>
							<div class="col-md-9 col-lg-6">
								<input type="text" class="form-control" id="contact-name" placeholder="Frau Schulze">
							</div>
						</div>
						<div class="form-group row">
							<label for="school-email" class="col-md-3 col-form-label">E-Mail-Adresse</label>
							<div class="col-md-9 col-lg-6">
								<input type="email" class="form-control" id="school-email" placeholder="schulleiter@gymnasium.de">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="cta cta-primary">Jetzt Ihre Schule anmelden!</button>
							</div>
						</div>
					</form>
				</section>
			</div>

		</div>
		@include('layouts.footer')
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush