@extends("layouts/html")

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
    <link rel="stylesheet" href="css/aos.css" />
@endsection

@section("body")
	<div id="app" class="h-100">


		<b-navbar toggleable="lg" style="position: fixed; z-index: 10000000; top:0; width: 100%;">
			<b-container fluid>
				<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
				<b-collapse is-nav id="nav_collapse">

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
					</b-navbar-nav>
				</b-collapse>
			</b-container>
		</b-navbar>


		<section class="landing-section full d-flex flex-column">

			<div class="brand my-auto text-center">
				<div class="d-flex justify-content-center">
					<img src="{{ asset('img/logo/logo_text_rounded_dark.png') }}" class="">
				</div>
				<h2 class="my-5 py-3 font-weight-bold">Die App für Schulen gegen Mobbing</h2>
				<a class="cta cta-primary cta-large mb-3" href="#forschools">Jetzt Ihre Schüler schützen!</a>
				<br>
				<span>oder <a href="{{ route('login') }}">hier anmelden</a></span>
				
			</div>
			<div class="py-5 my-5 p-lg-0 m-lg-0"></div>
			<div class="container mt-auto mb-5" id="#page-links">
				<ul class="nav w-100 justify-content-center nav-fill flex-column flex-md-row">
					<li class="nav-item">
						<a class="nav-link" href="#what">Was?</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#team">Wer?</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#forschools">Für Schulen</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">FAQ</a>
					</li>
				</ul>
			</div>
		</section>

		<section class="landing-section" id="what">
			<div class="wrapper">
				<div class="container-fluid">
					<div class="row">
						<h2 class="col-sm-3 promo-question">
							Was?
						</h2>
						<div class="col-sm-9 promo-text" data-aos="fade-up">
							@if (app()->getLocale() == "de")
								@include('landing_page.de.what')
							@else
								@include('landing_page.en.what')
							@endif
						</div>
					</div>
				</div>

				<div class="container-fluid pt-0">
					<div class="row advantage">
						<div class="col-sm-9 text-div" data-aos="fade-up">
							<h2>Niedrige Hemmschwelle durch Anonymität</h2>
							@if (app()->getLocale() == "de")
								@include('landing_page.de.advantages.anonymous')
							@else
								@include('landing_page.en.advantages.anonymous')
							@endif
						</div>
						<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
							<img src="{{ asset('img/lock.png') }}" class="advantage-img align-middle">
						</div>
					</div>
					<div class="row advantage text-div">
						<div class="col-sm-9 text-div order-sm-1" data-aos="fade-up">
							<h2>Einfacher Zugang durch App und Webapp</h2>
							@if (app()->getLocale() == "de")
								@include('landing_page.de.advantages.app')
							@else
								@include('landing_page.en.advantages.app')
							@endif
						</div>
						<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
							<img src="{{ asset('img/devices.png') }}" class="advantage-img-big">
						</div>
					</div>
					<div class="row advantage text-div">
						<div class="col-sm-9 text-div" data-aos="fade-up">
							<h2>Unterstützung von Mobbing-Experten</h2>
							@if (app()->getLocale() == "de")
								@include('landing_page.de.advantages.experts')
							@else
								@include('landing_page.en.advantages.experts')
							@endif
						</div>
						<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
							<img src="{{ asset('img/talking.png') }}" class="advantage-img">
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="landing-section" id="team">
			<div class="wrapper">
				<div class="container-fluid">
					<div class="row">
						<h2 class="col-sm-3 promo-question">
							Wer?
						</h2>
						<div class="col-sm-9 promo-text" data-aos="fade-up">
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
							<img src="{{ asset('img/margaretha.jpg') }}" class="rounded-circle">
							<div class="avatar-name">Margaretha Raffauf</div>
						</div>
						<div class="col-md-3 col-12 text-center avatar">
							<img src="{{ asset('img/julius.jpg') }}" class="rounded-circle">
							<div class="avatar-name">Julius de Gruyter</div>
						</div>
						<div class="col-md-3 col-12 text-center avatar">
							<img src="{{ asset('img/jan.jpg') }}" class="rounded-circle">
							<div class="avatar-name">Jan Wilhelm</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="landing-section" id="forschools">
			<div class="wrapper">
				<div class="container-fluid">
					<div class="row pb-sm-5">
						<h2 class="col-md-3 promo-question">
							Für Schulen
						</h2>
						<div class="col-sm-9 promo-text" data-aos="fade-up">
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
				</div>
			</div>
		</section>
		<div class="bg-color-black text-white">
			<div class="container bg-color-black py-md-5">
				<footer class="py-5">
					<div class="row">
						<div class="col-12 col-md">
							<img class="mb-2" src="{{ asset('img/logo/logo_text_rounded.png') }}" alt="" width="150px">
							<small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
						</div>
						<div class="col-6 col-md">
							<h5>Features</h5>
							<ul class="list-unstyled text-small">
								<li><a class="text-muted" href="{{ route('login') }}">Login</a></li>
								<li><a class="text-muted" href="{{ route('incidents') }}">Cases</a></li>
								<li><a class="text-muted" href="{{ route('incidents.report') }}">Report Incident</a></li>
							</ul>
						</div>
						<div class="col-6 col-md">
							<h5>Resources</h5>
							<ul class="list-unstyled text-small">
								<li><a class="text-muted" href="{{ route('impressum') }}">Impressum</a></li>
								<li><a class="text-muted" href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
							</ul>
						</div>
						<div class="col-6 col-md">
							<h5>About</h5>
							<ul class="list-unstyled text-small">
								<li><a class="text-muted" href="#team">Team</a></li>
								<li><a class="text-muted" href="#">Privacy</a></li>
								<li><a class="text-muted" href="#">Terms</a></li>
							</ul>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush