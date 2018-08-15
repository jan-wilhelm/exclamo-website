@extends("layouts/html")

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="{{ asset('css/colors_2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/aos.css" />
@endsection

@section("body")
	<section class="landing-section full">
		<div class="col-12 brand justify-content-center d-flex">
			<img src="{{ asset('img/logo_with_text.png') }}">
		</div>
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<h2 class="col-sm-3 promo-question">
						Was?
					</h2>
					<div class="col-sm-9 promo-text" data-aos="fade-up">
						exclamo hilft Schülern, die Opfer von Mobbing sind, über ihre Probleme zu sprechen und sie zu lösen. Schüler einer exclamo-Schule bekommen einen Account für die App exclamo, über die sie sich auch anonym an ihre Lehrer und externe Mobbing-Experten wenden können. Zudem gibt es hilfreiche Tipps, die im Umgang mit Mobbing helfen und den Schüler unterstützen, mit Vorfällen fertig zu werden. Damit verbindet exclamo eine niedrige Hemmschwelle mit einer einfachen Lösung von Vorfällen, durch Lehrer, die direkt in der Schule Maßnahmen ergreifen können. Mit dem Format einer App und Web-App ist exclamo in dem Medium, das Schüler am meisten Nutzen – dem Smartphone - und bieten so für den Betroffenen eine native Nutzung.
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="landing-section no-bullet">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row advantage">
					<div class="col-sm-9 text-div" data-aos="fade-up">
						<h2>Niedrige Hemmschwelle durch Anonymität</h2>
						<p>
							Der Schüler darf entscheiden, ob betreuende Lehrer seinen Namen sehen dürfen. Dadurch wird vollständige Anonymität geleistet, die nicht zurückverfolgt werden kann.</p>
						<p>
							Mit unserer AES-256 Verschlüsselung sind alle Daten nur für die betroffenen Personen zugänglich.
						</p>
					</div>
					<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/lock.png') }}" class="advantage-img align-middle">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-sm-9 text-div order-sm-1" data-aos="fade-up">
						<h2>Einfacher Zugang durch App und Webapp</h2>
						<p>
							Mithilfe unserer nativen App für iOS und Android , sowohl dem ausgereiften und übersichtlichem Webportal können Schüler und Lehrer immer kommunizieren - wir setzen keine Grenzen!
						</p>
					</div>
					<div class="col-sm-3 img-div d-flex justify-content-center align-items-center" data-aos="fade-in">
						<img src="{{ asset('img/devices.jpg') }}" class="advantage-img">
					</div>
				</div>
				<div class="row advantage text-div">
					<div class="col-sm-9 text-div" data-aos="fade-up">
						<h2>Unterstützung von Mobbing-Experten</h2>
						<p>
							Schüler können sich nicht nur direkt an ihre Lehrer, sondern auch an professionelle Mobbing-Experten und die Nummer-gegen-Kummer wenden. Alles eingebaut in unserer App!
						</p>
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
						Wir, das Team, sind Berliner Schüler und haben uns überlegt, wie man Mobbing am besten bekämpfen kann. Da das Handy einer der Alltagsgestände schlechthin ist, schien außer Frage, dass eine App das beste Format ist.
					</div>
				</div>
				<div class="row align-content-center mt-5" data-aos="fade-up">
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/avatar.png') }}" class="rounded-circle">
						<div class="avatar-name">Kai Lanz</div>
						<div class="avatar-title">CEO</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/avatar.png') }}" class="rounded-circle">
						<div class="avatar-name">Julius de Gruyter</div>
						<div class="avatar-title">CFO</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/avatar.png') }}" class="rounded-circle">
						<div class="avatar-name">undefined</div>
						<div class="avatar-title">CMO</div>
					</div>
					<div class="col-md-3 col-12 text-center avatar">
						<img src="{{ asset('img/avatar.png') }}" class="rounded-circle">
						<div class="avatar-name">Jan Wilhelm</div>
						<div class="avatar-title">CTO</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="landing-section full">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<h2 class="col-sm-3 promo-question">
						Für Schulen
					</h2>
					<div class="col-sm-9 promo-text" data-aos="fade-up">
						Sie sind in der Schulleitung einer Schule oder in einem Schulträger tätig und ihnen gefällt das Konzept hinter exclamo? exclamo-Schulen bekommen von uns einen Administrator-Account und einen definiertes Kontingent an Lehrer- und Schüler-Accounts. Die Schüler haben dann direkt die Möglichkeit über die Website oder Android-/iOS-App bestimmten Lehrern oder externen Mobbing-Experten unter psychotherapeutischer Aufsicht von ihren Mobbingfällen zu berichten. Lehrer und Schüler erhalten Zugang zu exklusiven Anti-Mobbing-Materialien, die ihnen im Umgang mit Mobbing im Alltag helfen. Die Materialien für Lehrer beinhalten Anweisung, wie sie mit bekannten Fällen umgehen sollten. Die Schüler können zudem per Knopfdruck bei Sorgentelefonen wie der Nummer gegen Kummer anrufen um seelische Unterstützung und Mut zu bekommen. exclamo basiert auf einem jährlichen Lizenzierungsmodell, die Kosten werden nach Schulgröße berechnet.
						Haben wir Ihr Interesse geweckt? Füllen Sie doch gerne das unverbindliche Formular unten aus und wir werden uns bei Ihnen melden!
					</div>
				</div>
				<hr class="my-5 bg-color-white">
				<div class="row justify-content-center">
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
						<button type="submit" class="btn btn-primary btn-lg w-100">Jetzt Ihre Schüler schützen!</button>
					</form>
				</div>
			</div>
		</div>
	</section>
<div class="container">
	<footer class="pt-4 my-md-5 pt-md-5 border-top">
		<div class="row">
			<div class="col-12 col-md">
				<img class="mb-2" src="{{ asset('img/logo_with_text_dark.png') }}" alt="" width="150px">
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
					<li><a class="text-muted" href="#">Resource</a></li>
					<li><a class="text-muted" href="#">Resource name</a></li>
					<li><a class="text-muted" href="#">Another resource</a></li>
					<li><a class="text-muted" href="#">Final resource</a></li>
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


@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}" type="text/javascript"></script>
@endpush