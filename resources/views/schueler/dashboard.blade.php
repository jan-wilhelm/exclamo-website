@extends('layouts/app')

@section('content')

	@exclamoflexsection
		<h3>
			@lang('messages.dashboard')
		</h3>
		<div class="w-100 d-flex flex-column text-center">
			<p>
				@lang('messages.welcome_messages', ['name'=> auth()->user()->full_name])
			</p>
			<a class="d-block mx-auto my-2 cta cta-primary" href="{{ route('incidents.report')}}">
				@lang('messages.createcase')
			</a>
			<div class="d-block mx-auto my-2 cta cta-primary">@lang('messages.nummer_gegen_kummer')</div>
			<a class="d-block mx-auto my-2 cta cta-primary" href="https://www.kbv.de/html/terminservicestellen.php">
				@lang('messages.termin_service_stelle')
			</a>
		</div>
	@endexclamoflexsection
@endsection