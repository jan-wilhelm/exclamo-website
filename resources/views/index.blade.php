@extends("layouts/html")

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
    <!--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">-->
    <link href="{{ asset('css/colors_2.css') }}" rel="stylesheet">
@endsection

@section("body")
	<section class="landing-section bg-color-primary-0">
		<div class="col-12 brand justify-content-center d-flex">
			<img src="http://localhost/img/logo_small.png">
		</div>
		<div class="container">
			<div class="row">
				<h2 class="col-sm-3 promo-question">
					Was?
				</h2>
				<div class="col-sm-9 promo-text">
					exclamo hilft Schülern, die Opfer von Mobbing sind, über ihre Probleme zu sprechen und sie zu lösen. Schüler einer exclamo-Schule bekommen einen Account für die App exclamo, über die sie sich auch anonym an ihre Lehrer und externe Mobbing-Experten wenden können. Zudem gibt es hilfreiche Tipps, die im Umgang mit Mobbing helfen und den Schüler unterstützen, mit Vorfällen fertig zu werden. Damit verbindet exclamo eine niedrige Hemmschwelle mit einer einfachen Lösung von Vorfällen, durch Lehrer, die direkt in der Schule Maßnahmen ergreifen können. Mit dem Format einer App und Web-App ist exclamo in dem Medium, das Schüler am meisten Nutzen – dem Smartphone - und bieten so für den Betroffenen eine native Nutzung.
				</div>
			</div>
		</div>
	</section>

	<section class="landing-section bg-color-secondary-1-2">
		<div class="container">
			<div class="row">
				<div class="col-3">
					Was?
				</div>
				<div class="col-9">
					exclamo hilft Schülern, die Opfer von Mobbing sind, über ihre Probleme zu sprechen und sie zu lösen. Schüler einer exclamo-Schule bekommen einen Account für die App exclamo, über die sie sich auch anonym an ihre Lehrer und externe Mobbing-Experten wenden können. Zudem gibt es hilfreiche Tipps, die im Umgang mit Mobbing helfen und den Schüler unterstützen, mit Vorfällen fertig zu werden. Damit verbindet exclamo eine niedrige Hemmschwelle mit einer einfachen Lösung von Vorfällen, durch Lehrer, die direkt in der Schule Maßnahmen ergreifen können. Mit dem Format einer App und Web-App ist exclamo in dem Medium, das Schüler am meisten Nutzen – dem Smartphone - und bieten so für den Betroffenen eine native Nutzung.
				</div>
			</div>
		</div>
	</section>

@endsection
