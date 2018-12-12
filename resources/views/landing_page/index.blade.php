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
						<img src="{{ asset('img/logo/logo.svg') }}" height="50px">
					</b-navbar-brand>
					<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

					<b-collapse is-nav id="nav_collapse">

						<b-navbar-nav class="mx-auto" id="nav-links">
							<li class="nav-item"><a class="nav-link" href="#vision">@lang('landing_page.vision')</a></li>
							<li class="nav-item"><a class="nav-link" href="#news">@lang('landing_page.news')</a></li>
							<li class="nav-item"><a class="nav-link" href="#what">@lang('landing_page.what')</a></li>
							<li class="nav-item"><a class="nav-link" href="#team">@lang('landing_page.who')</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">@lang('landing_page.faq')</a></li>
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
								<a href="#get_exclamo" class="nav-link cta cta-primary">
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

			<div class="container mt-lg-5 pt-lg-5">
				<section class="mt-5 back-gradient back-borders row">
					<div class="col-lg-7 p-md-5 my-auto" data-aos="zoom-in">
						<div class="col-12 pl-1 py-4 pr-0">
							<h1 class="mt-lg-4">
								@lang('landing_page.slogan')
							</h1>
							<div class="mt-4 font-weight-medium">
								@include('landing_page.' . app()->getLocale() . '.slogan')
							</div>
							<div>
								<a href="#get_exclamo" class="cta cta-primary">
									@lang('landing_page.protect_your_students')
								</a>
								<a href="#what" class="d-inline-block p-3">&#9658
									@lang('landing_page.why_choose_exclamo')
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-5 p-0 m-0" id="image-placeholder" data-aos="fade-left">
						<img src="/img/iPhoneCases.png">
					</div>
				</section>
				<section class="row" data-aos="fade" id="vision">
					<div class="pt-5 col-lg-6">
						<h1><i class="far fa-lightbulb"></i>
							@lang('landing_page.vision')
						</h1>
						<div class="font-weight-medium d-flex flex-column align-items-start">
							@include('landing_page.' . app()->getLocale() . '.vision')
							<a href="#get_exclamo" class="mt-2 cta cta-primary">
								@lang('landing_page.signup_your_school')
							</a>
						</div>
					</div>
					<div class="pt-5 col-lg-6" id="news">
						<h1><i class="far fa-newspaper"></i>
							@lang('landing_page.news')
						</h1>
						<div class="font-weight-medium d-flex flex-column align-items-stretch">
							<a target="_blank" class="news-article mb-2 d-flex col-12 color-secondary" href="https://www.canisius.de">
								Testphase mit dem Canisius Kolleg in Berlin
							</a>
							<a target="_blank" class="back-gradient-accent news-article mb-2 d-flex col-12 text-white"
								href="https://www.gofundme.com/manage/anti-mobbing-app">
								Crowdfunding durch GoFundMe
							</a>
						</div>
					</div>
				</section>

				<h1 class="underlined mb-3">
					@lang('landing_page.what_is_exclamo')
				</h1>
				<section class="row back-gradient back-borders py-4 px-1  d-flex flex-column" id="what">
					<div class="col-12 advantage" data-aos="fade">
						<h5 class="advantage-heading">
							<i class="fas fa-shield-alt"></i>
							@lang('landing_page.anonymous_messages')
						</h5>
						<p>
							@include('landing_page.' . app()->getLocale() . '.advantages.anonymous')
						</p>
					</div>
					<div class="col-12 advantage" data-aos="fade">
						<h5 class="advantage-heading">
							<i class="fas fa-file-alt"></i>
							@lang('landing_page.bullying_diary')
						</h5>
						<p>
							@include('landing_page.' . app()->getLocale() . '.advantages.diary')
						</p>
					</div>
					<div class="col-12 advantage" data-aos="fade">
						<h5 class="advantage-heading">
							<i class="fas fa-users"></i>
							@lang('landing_page.professional_support')
						</h5>
						<p>
							@include('landing_page.' . app()->getLocale() . '.advantages.experts')
						</p>
					</div>
					<div class="col-12 advantage" data-aos="fade">
						<h5 class="advantage-heading">
							<i class="fas fa-comments"></i>
							@lang('landing_page.material')
						</h5>
						<p>
							@include('landing_page.' . app()->getLocale() . '.advantages.materials')
						</p>
					</div>
					<div class="col-12 advantage" data-aos="fade">
						<h5 class="advantage-heading">
							<i class="fas fa-check-circle"></i>
							@lang('landing_page.prevention')
						</h5>
						<p>
							@include('landing_page.' . app()->getLocale() . '.advantages.prevention')
						</p>
					</div>
					<div class="mx-auto"
						data-aos="zoom-in"
						data-aos-delay="300"
					>
						<span class="pr-3">
							@lang('landing_page.could_we_convince_you')
						</span>
						<a href="#get_exclamo" class="cta cta-primary">
							@lang('landing_page.protect_your_students')
						</a>
					</div>
				</section>

				<h1 class="underlined mb-3">
					@lang('landing_page.who_are_we')
				</h1>
				<p class="font-weight-medium" data-aos="fade">
					@include('landing_page.' . app()->getLocale() . '.who')
				</p>
				<section class="row" data-aos="zoom-in" id="team">
					<div class="col-6 col-lg-4 px-3 mt-2">
						<div class="avatar">
							<img src="/img/kai.jpg" class="back-borders-small w-100">
							<div class="description">
								<span class="m-0 p-0">
									<strong>E-Mail: </strong> <a href="mailto:kai.lanz@exclamo.org">kai.lanz@exclamo.org</a>
								</span>
							</div>
						</div>
						<h3 class="mt-3">Kai Lanz</h3>
					</div>
					<div class="col-6 col-lg-4 px-3 mt-2">
						<div class="avatar">
							<img src="/img/jan.jpg" class="back-borders-one w-100">
							<div class="description">
								<span class="m-0 p-0">
									<strong>E-Mail: </strong> <a href="mailto:jan.wilhelm@exclamo.org">jan.wilhelm@exclamo.org</a>
								</span>
							</div>
						</div>
						<h3 class="mt-3">Jan Wilhelm</h3>
					</div>
					<div class="col-6 col-lg-4 px-3 mt-2">
						<div class="avatar">
							<img src="/img/julius.jpg" class="back-borders-two w-100">
							<div class="description">
								<span class="m-0 p-0">
									<strong>E-Mail: </strong> <a href="mailto:julius.degruyter@exclamo.org">julius.degruyter@exclamo.org</a>
								</span>
							</div>
						</div>
						<h3 class="mt-3">Julius de Gruyter</h3>
					</div>
				</section>

				<section>
					<h1><i class="far fa-newspaper"></i>
						@lang('landing_page.as_seen_in')
					</h1>
					<div class="known-from row d-flex flex-row">
						<a data-aos="fade" class="col-4 p-1 align-items-center justify-content-center d-flex" target="_blank" href="https://www.business-at-school.net/">
							<img src="img/media/business_at_school.png">
						</a>
						<a data-aos="fade" class="col-4 p-1 align-items-center justify-content-center d-flex" target="_blank" href="https://www.faz.net/aktuell/gesellschaft/menschen/berliner-schueler-arbeiten-an-app-gegen-mobbing-15936418.html">
							<img src="img/media/faz.png">
						</a>
						<a data-aos="fade" class="col-4 p-1 align-items-center justify-content-center d-flex" target="_blank" href="https://www.handelsblatt.com/unternehmen/mittelstand/start-up-100-000-deutsche-spenden-fuenf-millionen-euro-ueber-gofundme/23716676.html">
							<img src="img/media/handelsblatt.png">
						</a>
						<a data-aos="fade" class="col-4 p-1 align-items-center justify-content-center d-flex" target="_blank" href="https://www.huffingtonpost.de/entry/aufschrei-gegen-mobbing-wie-die-generation-z-die-digitalisierung_de_5b266806e4b08e7f7dea01ca">
							<img src="img/media/huffpost.png">
						</a>
						<a data-aos="fade" class="col-4 p-1 align-items-center justify-content-center d-flex" target="_blank" href="https://www.jetzt.de/digital/ein-aufschrei-fuer-mehr-aufmerksamkeit">
							<img src="img/media/jetzt.png">
						</a>
					</div>
				</section>

				<section id="get_exclamo" class="back-gradient-accent back-borders p-3 p-md-4 text-white" data-aos="fade-right">
					<h1 class="underlined mb-2">
						@lang('landing_page.use_exclamo_heading')
					</h1>
					@if(!session('school_sign_up'))
						<em class="d-block my-3">
							@lang('landing_page.contact_disclaimer')
						</em>

						@foreach ($errors->all() as $message)
							<div class="alert alert-warning text-black" role="alert">	
						   		{{ $message }}
							</div>
						@endforeach
						<form action="{{ route('schools.signup') }}" method="POST">
							@csrf
							<div class="form-group row">
								<label for="school" class="col-md-3 col-form-label">
									@lang('landing_page.name_of_your_school')
								</label>
								<div class="col-md-9 col-lg-6">
									<input
										type="text" 
										class="form-control"
										name="school"
										id="school"
										placeholder="@lang('landing_page.name_of_your_school_placeholder')"
										value={{ old('school') }}
									>
								</div>
							</div>
							<div class="form-group row">
								<label for="contact-person" class="col-md-3 col-form-label">
									@lang('landing_page.contact_person')
								</label>
								<div class="col-md-9 col-lg-6">
									<input
										type="text" 
										class="form-control"
										name="contact_person"
										id="contact-person"
										placeholder="@lang('landing_page.contact_person_placeholder')"
										value={{ old('contact_person') }}
									>
								</div>
							</div>
							<div class="form-group row">
								<label for="email" class="col-md-3 col-form-label">
									@lang('landing_page.email')
								</label>
								<div class="col-md-9 col-lg-6">
									<input
										type="email"
										class="form-control"
										name="email"
										id="email"
										placeholder="@lang('landing_page.email_placeholder')"
									>
								</div>
							</div>
							<div class="form-group row">
								<label for="email" class="col-md-3 col-form-label">
									@lang('landing_page.email_confirmation')
								</label>
								<div class="col-md-9 col-lg-6">
									<input
										type="email"
										class="form-control"
										name="email_confirmation"
										id="email"
										placeholder="@lang('landing_page.email_placeholder')"
									>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-10">
									<button type="submit" class="cta cta-primary">
										@lang('landing_page.signup_your_school')
									</button>
								</div>
							</div>
						</form>
					@else
						<strong class="text-center d-block">
							@lang('landing_page.thank_your_for_your_interest')
						</strong>
					@endif
				</section>

				<section id="contact" class="">
					<h1 class="underlined mb-3 row">
						@lang('landing_page.contact')
					</h1>
					<div class="row font-weight-medium d-flex align-items-stretch">
						<a
							target="_blank"
							class="news-article mb-2 d-flex col-12 col-md-6 col-lg-4 color-secondary"
							href="http://instagram.com/exclamo_org/"
						>
							<i class="fab fa-instagram fa-2x mr-2"></i><h4>Instagram</h4>
						</a>
						<a
							target="_blank"
							class="news-article mb-2 d-flex col-12 col-md-6 col-lg-4 color-secondary"
							href="http://twitter.com/exclamo_org"
						>
							<i class="fab fa-twitter fa-2x mr-2"></i><h4>Twitter</h4>
						</a>
						<a
							target="_blank"
							class="news-article mb-2 d-flex col-12 col-md-6 col-lg-4 color-secondary"
							href="mailto:info@exclamo.org"
						>
							<i class="far fa-envelope fa-2x mr-2"></i><h4>E-Mail</h4>
						</a>
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