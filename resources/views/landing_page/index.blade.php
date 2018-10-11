@extends("layouts/html")

@section('head')
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
    <link rel="stylesheet" href="css/aos.css" />
@endsection

@section("body")
	<div class="w-100 h-100" id="app" >
	<div id="app-content" class="h-100" v-cloak>

		<section class="landing-section full d-flex flex-column white" id="first-section">
			<b-navbar toggleable="xl" class="white fixed-lg-top">
				<b-container fluid class="px-xl-5 px-lg-2 px-md-1 px-0 py-3">
					<b-navbar-brand href="{{ route('home') }}" class="mr-md-5">
						<img src="{{ asset('img/logo/logo_text_rounded.png') }}" height="45px">
					</b-navbar-brand>
					<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

					<b-collapse is-nav id="nav_collapse">

						<b-navbar-nav class="mr-auto" id="nav-links">
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#vision">Unsere Vision</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#what">Was?</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#team">Wer?</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#forschools">Für Schulen</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="{{ route('faq') }}">FAQ</a>
							</li>
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
									Anmelden
								</a>
							</li>
							<li class="nav-item cta cta-primary">
								<a href="#forschools" class="text-white mx-auto">
									exclamo nutzen!
								</a>
							</li>
							@else
							<li class="nav-item">
								<a href="{{ route('dashboard') }}" class="nav-link color-primary-0 mx-auto">
									Zum Dashboard
								</a>
							</li>
							@endguest
						</b-navbar-nav>
					</b-collapse>
				</b-container>
			</b-navbar>
			<div class="my-auto container-fluid row pt-5">
				<div class="offset-md-2 offset-1 col-10 col-md-7 col-lg-6">
					<h1 class=" display-4 my-5 py-1 color-primary-0 font-weight-bold ">
						@lang('landing_page.slogan')
					</h1>
					<p class="color-primary-4">
						Mit einem einzigartigen Ansatz helfen wir Schulen, Mobbing zu bekämpfen: Ihre Schüler wenden sich per exclamo an ausgewählte Lehrer und professionelle Mobbing-Experten und erhalten so schnelle und anonyme Hilfe!
					</p>
					<a class="cta cta-primary cta-large mb-3 d-lg-inline-block" href="#forschools">
						@lang('landing_page.protect_your_students')
					</a>
					<a class="ml-lg-5 ml-sm-3 d-block d-lg-inline-block" href="#what">
						&#9658 Warum exclamo?
					</a>
				</div>
			</div>
		</section>

		<section class="landing-section" id="vision">
			<img src="img/lower_background.svg" />
			<div class="container margin">
				<h1 class="text-center promo-question">
					<i class="color-secondary-1-0 far fa-lightbulb fa-sm mr-1"></i>
					@lang('landing_page.vision')
				</h1>
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-10 col-lg-8 promo-text" data-aos="fade-up">
						@if (app()->getLocale() == "de")
							@include('landing_page.de.vision')
						@else
							@include('landing_page.en.vision')
						@endif
					</div>
				</div>
			</div>
		</section>

		<section class="landing-section margin" id="what">
			<div class="container">
				<h1 class="text-center promo-question">
					Warum Exclamo?
				</h1>
				<div class="row advantage">
					<div class="col-lg-9 text-div" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.anonymous_heading')
						</h1>
						@if (app()->getLocale() == "de")
							@include('landing_page.de.advantages.anonymous')
						@else
							@include('landing_page.en.advantages.anonymous')
						@endif
					</div>
					<div class="col-lg-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/iPhoneMessages.png') }}" class="advantage-img align-middle">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-sm-9 text-div order-sm-1" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.easy_access')
						</h1>
						@if (app()->getLocale() == "de")
							@include('landing_page.de.advantages.app')
						@else
							@include('landing_page.en.advantages.app')
						@endif
					</div>
					<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/iPhoneCases.png') }}" class="advantage-img">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-sm-9 text-div" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.experts_heading')
						</h1>
						@if (app()->getLocale() == "de")
							@include('landing_page.de.advantages.experts')
						@else
							@include('landing_page.en.advantages.experts')
						@endif
					</div>
					<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<i class="fas fa-users color-primary-1 fa-10x"></i>
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-sm-9 text-div order-sm-1" data-aos="fade-up">
						<h1 class="heading">
							Hohe Datensicherheit
						</h1>
						<p>
							Alle kritischen Daten sind mit einer AES-256 Verschlüsselung auf Top-Secret-Niveau gesichert! Wir wissen, dass Datenschutz und -sicherheit Faktoren sind, bei denen man Qualität nicht vernachlässigen darf - insbesondere bei privaten Nachrichten an Vertrauenspersonen.
						</p>
						<p>
							Exclamo setzt sich zum Ziel, eine sichere Plattform als Grundlage zur Mobbinghilfe zu bieten. Dadurch gehört auch Datenschutz zu unserer obersten Priorität!
						</p>
					</div>
					<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/lock.svg') }}" class="advantage-img">
					</div>
				</div>
			</div>
		</section>

		<!--<section class="landing-section margin" id="timeline">
			<img src="img/timeline_border.svg" id="timeline-top" />
			<div class="wrapper w-100">
				<div class="container px-md-5">
					<h1 class="text-center promo-question text-white">
						<i class="color-secondary-1-0 fas fa-chart-line fa-sm mr-1"></i>
						Timeline - Die nächsten Schritte
					</h1>
					<div class="row timeline-wrapper px-sm-5 px-1 px-lg-0">
						<div class="col-lg-4 col-12 timeline-div timeline-past">
							<h4 class="timeline-quarter">Q1</h4>
							<h4 class="timeline-year">2018</h4>
							<div class="timeline-content">
								<ul>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-12 timeline-div timeline-past">
							<h4 class="timeline-quarter">Q1</h4>
							<h4 class="timeline-year">2018</h4>
							<div class="timeline-content">
								<ul>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-12 timeline-div timeline-last">
							<h4 class="timeline-quarter">Q2</h4>
							<h4 class="timeline-year">2018</h4>
							<div class="timeline-content">
								<ul>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-12 timeline-div">
							<h4 class="timeline-quarter">Q3</h4>
							<h4 class="timeline-year">2018</h4>
							<div class="timeline-content">
								<ul>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-12 timeline-div">
							<h4 class="timeline-quarter">Q4</h4>
							<h4 class="timeline-year">2018</h4>
							<div class="timeline-content">
								<ul>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
									<li>Dies ist ein Stichpunkt</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<img src="img/timeline_border.svg" id="timeline-bottom" />
		</section>
		-->

		<section class="landing-section" id="team">
			<div class="container margin">
				<h1 class="text-center promo-question">
					<i class="color-secondary-1-0 far fa-lightbulb fa-sm mr-1"></i>
					Das Team
				</h1>
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-10 col-lg-8 promo-text" data-aos="fade-up">
						@if (app()->getLocale() == "de")
							@include('landing_page.de.who')
						@else
							@include('landing_page.en.who')
						@endif
					</div>
				</div>

				<div class="row align-content-center mt-5" data-aos="fade-up">
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/kai.jpg') }}" class="rounded-circle">
						<div class="avatar-name">Kai Lanz</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/jan.jpg') }}" class="rounded-circle">
						<div class="avatar-name">Jan Wilhelm</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/julius.jpg') }}" class="rounded-circle">
						<div class="avatar-name">Julius de Gruyter</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/margaretha.jpg') }}" class="rounded-circle">
						<div class="avatar-name">Margaretha Raffauf</div>
					</div>
				</div>
			</div>
		</section>

		<hr>

		<section class="landing-section" id="forschools">
			<div class="container margin">
				<h1 class="text-center promo-question">
					<i class="color-secondary-1-0 far fa-lightbulb fa-sm mr-1"></i>
					@lang('landing_page.for_schools')
				</h1>
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-10 col-lg-8 promo-text" data-aos="fade-up">
						@if (app()->getLocale() == "de")
							@include('landing_page.de.schools')
						@else
							@include('landing_page.en.schools')
						@endif
					</div>
				</div>
				<div class="row justify-content-center">
					<ul class="mt-5 col-md-8 col-12 list-unstyled font-weight-bold">
						<li>
							<i class="color-secondary-1-0 mr-3 far fa-lg fa-check-circle"></i>
							Erstellen Sie einfach Accounts für Schüler und Lehrer
						</li>
						<li>
							<i class="color-secondary-1-0 mr-3 far fa-lg fa-check-circle"></i>
							Direkter Zugang zur Nummer-gegen-Kummer
						</li>
						<li>
							<i class="color-secondary-1-0 mr-3 far fa-lg fa-check-circle"></i>
							Übersichtliche Hilfsmaterialien für Lehrkräfte
						</li>
						<li>
							<i class="color-secondary-1-0 mr-3 far fa-lg fa-check-circle"></i>
							Jährliches Lizenzierungsmodell
						</li>
					</ul>
					<h5 class="mt-4 col-sm-6 col-10 text-center color-secondary-1-0">
						Bei Interesse schreiben Sie uns doch eine unverbindliche E-Mail!
					</h5>
				</div>
			</div>
		</section>

		<hr>

		<section class="landing-section" id="contact">
			<div class="container margin">
				<h1 class="text-center promo-question">
					Kontakt
				</h1>
				<div class="row pt-md-5 justify-content-center text-center">
					<a href="mailto:info@exclamo.org" target="_blank" class="col-md-4">
						<i class="fas fa-envelope fa-5x"></i>
						<p>Mail</p>
					</a>
					<a href="https://twitter.com/exclamo_org" target="_blank" class="col-md-4">
						<i class="fab fa-twitter-square fa-5x"></i>
						<p>Twitter</p>
					</a>
					<a href="https://www.instagram.com/exclamo_org/" target="_blank" class="col-md-4">
						<i class="fab fa-instagram fa-5x"></i>
						<p>Instagram</p>
					</a>
				</div>
			</div>
		</section>

		<br class="my-5 py-5">

{{-- 
		<section class="landing-section" id="forschools">
			<div class="wrapper">
				<div class="container">
					<div class="row pb-sm-5">
						<h2 class="col-md-auto promo-question">
							@lang('landing_page.for_schools')
						</h2>
						<div class="col-md promo-text" data-aos="fade-up">
							@if (app()->getLocale() == "de")
								@include('landing_page.de.schools')
							@else
								@include('landing_page.en.schools')
							@endif
						</div>
					</div>
					<hr class="my-5 bg-color-white">
					<div class="row pt-md-5 justify-content-center">
						<!--<h2 class="mb-4 col-12 text-center">Kontakt aufnehmen</h2>-->
						<form class="col-sm-10 col-12 signup-form bg-color-white" data-aos="slide-up" data-aos-duration="800">
							<div class="form-group row">
								<label for="school-name" class="col-md-4 col-form-label">Name der Schule</label>
								<div class="input-group col-md-8">
									<input type="text" class="form-control" id="school-name" name="school-name">
								</div>
							</div>
							<div class="form-group row">
								<label for="contact-email" class="col-md-4 col-form-label">Email</label>
								<div class="input-group col-md-8">
							        <div class="input-group-prepend">
							        	<div class="input-group-text">@</div>
							        </div>
									<input type="email" class="form-control" id="contact-email" name="contact-email">
								</div>
							</div>
							<fieldset class="form-group">
								<div class="row">
							    	<legend class="col-form-label col-md-4 pt-0">Ihre Schule ist</legend>
							    	<div class="col-md-8">
							    		<div class="form-check">
							    			<input class="form-check-input" type="radio" name="school-type" id="public-school" value="0" checked>
							    			<label class="form-check-label" for="public-school">
							    				eine staatliche Schule
							    			</label>
							    		</div>
							    		<div class="form-check">
								    		<input class="form-check-input" type="radio" name="school-type" id="private-school" value="1">
								    		<label class="form-check-label" for="private-school">
								    			privat geführt
								    		</label>
							    		</div>
									</div>
								</div>
							</fieldset>
							<button type="submit" class="w-100 cta cta-large cta-primary">Jetzt Ihre Schüler schützen!</button>
						</form>
					</div>
					<div class="row pt-md-5 justify-content-center text-center">
						<a href="mailto:info@exclamo.org" target="_blank" class="col-md-4">
							<i class="fas fa-envelope fa-5x"></i>
							<p>Mail</p>
						</a>
						<a href="https://twitter.com/exclamo_org" target="_blank" class="col-md-4">
							<i class="fab fa-twitter-square fa-5x"></i>
							<p>Twitter</p>
						</a>
						<a href="https://www.instagram.com/exclamo_org/" target="_blank" class="col-md-4">
							<i class="fab fa-instagram fa-5x"></i>
							<p>Instagram</p>
						</a>
					</div>
				</div>
			</div>
		</section> --}}
		@include('layouts.footer')
	</div>
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush