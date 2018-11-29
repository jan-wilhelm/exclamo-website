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
								<a class="nav-link color-primary-0" href="#vision">@lang('landing_page.vision')</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#what">@lang('landing_page.what')</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#team">@lang('landing_page.who')</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="#forschools">@lang('landing_page.for_schools')</a>
							</li>
							<li class="nav-item">
								<a class="nav-link color-primary-0" href="{{ route('faq') }}">@lang('landing_page.faq')</a>
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
									@lang('messages.login')
								</a>
							</li>
							<li class="nav-item cta cta-primary">
								<a href="#forschools" class="text-white mx-auto">
									@lang('landing_page.use_exclamo')
								</a>
							</li>
							@else
							<li class="nav-item">
								<a href="{{ route('dashboard') }}" class="nav-link color-primary-0 mx-auto">
									@lang('landing_page.to_the_dashboard')
								</a>
							</li>
							@endguest
						</b-navbar-nav>
					</b-collapse>
				</b-container>
			</b-navbar>
			<div class="my-2 my-md-auto container-fluid row pt-xl-5 pt-md-4 pt-3">
				<div class="offset-md-2 col-md-7 col-lg-6 flex-column">
					<h1 class="my-lg-5 my-md-3 my-1 py-1 color-primary-0 font-weight-bold" id="slogan">
						@lang('landing_page.slogan')
					</h1>
					<p class="color-primary-4">
						@include('landing_page.' . app()->getLocale() . '.slogan')
					</p>
					<p class="d-flex">
						<a class="cta cta-primary cta-large" href="#forschools">
							@lang('landing_page.protect_your_students')
						</a>
					</p>
					<p class="d-flex">
						<a href="#what">
							&#9658 @lang('landing_page.why_choose_exclamo')
						</a>
					</p>
				</div>
			</div>
			<div class="mt-auto align-text-bottom align-self-end d-lg-none w-100 p-0 m-0">
				<img src="img/small_background.svg" class="w-100">
			</div>
		</section>

		<section class="landing-section" id="vision">
			<div id="vision-image-wrapper">
				<img src="img/lower_background.svg" />
			</div>
			<div class="container" id="vision-container">
				<h1 class="text-center promo-question">
					<i class="color-secondary-1-0 far fa-lightbulb fa-sm mr-1"></i>
					@lang('landing_page.vision')
				</h1>
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-10 col-lg-8 promo-text" data-aos="fade-up">
						@include('landing_page.' . app()->getLocale() . '.vision')
					</div>
				</div>
			</div>
		</section>

		<section class="landing-section margin" id="what">
			<div class="container">
				<h1 class="text-center promo-question">
					@lang('landing_page.why_choose_exclamo')
				</h1>
				<div class="row advantage">
					<div class="col-lg-9 text-div" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.anonymous_heading')
						</h1>
						@include('landing_page.' . app()->getLocale() . '.advantages.anonymous')
					</div>
					<div class="col-lg-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/iPhoneMessages.png') }}" class="advantage-img align-middle">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-lg-9 text-div order-lg-2" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.easy_access')
						</h1>
						@include('landing_page.' . app()->getLocale() . '.advantages.app')
					</div>
					<div class="col-lg-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/iPhoneCases.png') }}" class="advantage-img">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-lg-9 text-div" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.experts_heading')
						</h1>
						@include('landing_page.' . app()->getLocale() . '.advantages.experts')
					</div>
					<div class="col-lg-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<i class="fas fa-users color-primary-1 fa-10x"></i>
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-lg-9 text-div order-lg-2" data-aos="fade-up">
						<h1 class="heading">
							@lang('landing_page.data_security_heading')
						</h1>
						@include('landing_page.' . app()->getLocale() . '.advantages.security')
					</div>
					<div class="col-lg-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
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
					@lang('landing_page.the_team')
				</h1>
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-10 col-lg-8 promo-text" data-aos="fade-up">
						@include('landing_page.' . app()->getLocale() . '.who')
					</div>
				</div>
			</div>
			<div id="avatar-container" class="container-fluid">
				<div class="row align-content-center mt-5" data-aos="fade-up">
					<div class="m-auto col-lg-4 col-md-8 col-12 avatar">
						<div class="avatar-content">
							<img src="{{ asset('img/kai.jpg') }}">
							<div class="description">
								<h3 class="avatar-name">Kai Lanz</h3>
								<span class="m-0 p-0">
									<strong>E-Mail: </strong>
									<a href="mailto:kai.lanz@exclamo.org">kai.lanz@exclamo.org</a>
								</span> 
							</div>
						</div>
					</div>
					<div class="m-auto col-lg-4 col-md-8 col-12 avatar">
						<div class="avatar-content">
							<img src="{{ asset('img/jan.jpg') }}">
							<div class="description">
								<h3 class="avatar-name">Jan Wilhelm</h3>
								<span class="m-0 p-0">
									<strong>E-Mail: </strong>
									<a href="mailto:jan.wilhelm@exclamo.org">jan.wilhelm@exclamo.org</a>
								</span> 
							</div>
						</div>
					</div>
					<div class="m-auto col-lg-4 col-md-8 col-12 avatar">
						<div class="avatar-content">
							<img src="{{ asset('img/julius.jpg') }}">
							<div class="description">
								<h3 class="avatar-name">Julius de Gruyter</h3>
								<span class="m-0 p-0">
									<strong>E-Mail: </strong>
									<a href="mailto:julius.degruyter@exclamo.org">julius.degruyter@exclamo.org</a>
								</span> 
							</div>
						</div>
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
						@include('landing_page.' . app()->getLocale() . '.schools')
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
					@lang('landing_page.contact')
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